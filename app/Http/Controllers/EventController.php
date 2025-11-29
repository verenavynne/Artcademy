<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTransaction;
use App\Models\Notification;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $workshopSection = request('workshop_section', 1);
        $webinarSection = request('webinar_section', 1);
        $now = Carbon::now();

        $webinars = Event::where('eventCategory', 'webinar')
        ->whereRaw("(eventDate > CURDATE()) 
                OR (eventDate = CURDATE() AND start_time > CURTIME())")
        ->paginate(4, ['*'], 'webinar_section')
        ->appends(['workshop_section' => $workshopSection]);
        $workshops = Event::where('eventCategory', 'workshop')
        ->whereRaw("(eventDate > CURDATE()) 
                OR (eventDate = CURDATE() AND start_time > CURTIME())")
        ->paginate(4,['*'], 'workshop_section')
        ->appends(['webinar_section'=> $webinarSection]);

        $notifications = Notification::where('userId', $user->id)
            ->orderBy('notificationDate', 'desc')
            ->get();
        $unreadCount = Notification::where('status', 'unread')
            ->where('userId', $user->id)
            ->count();

        return view('event.event', compact('webinars', 'workshops', 'notifications','unreadCount'));
    }

    public function showDetail($id)
    {
        $event = Event::findOrFail($id);
        $otherEvents = Event::where('id', '!=', $id)
            ->inRandomOrder()
            ->take(6)
            ->get();
        
        $totalPeserta = EventTransaction::where('eventId', $id)->count();

        $quota = $event->eventSlot;

        $progressPeserta = $quota > 0 ? ($totalPeserta / $quota) * 100 : 0;
        
        $user = Auth::user();
        if ($user->role === 'student') {
            $layout = 'layouts.master';
        } elseif ($user->role === 'admin') {
            $layout = 'layouts.master-admin';
        }

        $isRegistered = EventTransaction::where('eventId', $id)
        ->where('studentId', $user->id)->exists();

        return view('event.event-detail', compact('event', 'otherEvents', 'totalPeserta','quota', 'progressPeserta', 'isRegistered','layout'));
    }

    public function checkoutInfo($eventId)
    {
        $user = Auth::user();
        $event = Event::findOrFail($eventId);
        return view('event.event-checkout-info', compact('user', 'event'));
    }

    public function processPayment(Request $request)
    {
        $event = Event::findOrFail($request->eventId);
        $student = auth()->user()->student;

        $totalPrice = $event->eventPrice * 1.08;

        $payment = Payment::create([
            'studentId'       => $student->id,
            'price'           => $totalPrice,
            'paymentMethod'   => 'midtrans',
            'paymentStatus'   => 'pending',
            'midtransTokenId' => ''
        ]);

        $params = [
            'transaction_details' => [
                'order_id'     => 'PAY-' . $payment->id . '-' . time(),
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $student->user->name,
                'email'      => $student->user->email,
                'phone'      => $student->user->phoneNumber,
            ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $payment->update([
            'midtransTokenId' => $snapToken
        ]);

        $startDate = now();
        $endDate = now()->addMonth();

        return response()->json([
            'snap_token' => $snapToken
        ]);
        
    }

    public function updatePaymentStatus(Request $request)
    {
        try{
            $snapToken = $request->snap_token;
            $transactionStatus = $request->transaction_status ?? $request->status;
            $eventId = (int) $request->eventId;

            $payment = Payment::where('midtransTokenId', $snapToken)->firstOrFail();

            $newStatus = match($transactionStatus) {
                'settlement', 'capture', 'success' => 'paid',
                'deny', 'cancel', 'expire' => 'failed',
                'pending' => 'pending',
                default => 'pending'
            };

            $payment->update(['paymentStatus' => $newStatus]);

             if ($newStatus === 'paid') {
                EventTransaction::firstOrCreate(
                    ['paymentId' => $payment->id],
                    [
                        'eventId' => $eventId,
                        'studentId' => $payment->studentId,
                        'date' => now(),
                    ]
                );
            }

            return response()->json(['success' => true, 'paymentStatus' => $newStatus]);
        }catch(\Throwable $e){
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
