<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\MembershipTransaction;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::all();
        return view('membership.membership', compact('memberships'));
    }

    public function detail($membershipId)
    {
        $membership = Membership::findOrFail($membershipId);

        $user = Auth::user();
        $membershipTransaction = MembershipTransaction::where('studentId', $user->id)
            ->where('membershipStatus', 'active')
            ->with('membership')
            ->first();

        $membershipStatus = $membershipTransaction?->membershipStatus ?? 'belum berlangganan';

        return view('membership.membership-detail', compact('membership', 'membershipTransaction', 'membershipStatus'));
    }

    public function checkoutInfo($membershipId)
    {
        $user = Auth::user();
        $membership = Membership::findOrFail($membershipId);
        return view('membership.membership-checkout-info', compact('user', 'membership'));
    }

    public function processPayment(Request $request)
    {
        $membership = Membership::findOrFail($request->membershipId);
        $student = auth()->user()->student;

        $totalPrice = $membership->membershipPrice * 1.08;

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
        try {
            $snapToken = $request->snap_token;
            $transactionStatus = $request->transaction_status ?? $request->status;
            $membershipId = (int) $request->membershipId;

            $payment = Payment::where('midtransTokenId', $snapToken)->firstOrFail();

            $newStatus = match($transactionStatus) {
                'settlement', 'capture', 'success' => 'paid',
                'deny', 'cancel', 'expire' => 'failed',
                'pending' => 'pending',
                default => 'pending'
            };

            $payment->update(['paymentStatus' => $newStatus]);

            if ($newStatus === 'paid') {
                MembershipTransaction::firstOrCreate(
                    ['paymentId' => $payment->id],
                    [
                        'membershipId' => $membershipId,
                        'studentId' => $payment->studentId,
                        'startDate' => now(),
                        'endDate' => now()->addMonth(),
                        'membershipStatus' => 'active'
                    ]
                );
            }

            return response()->json(['success' => true, 'paymentStatus' => $newStatus]);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
