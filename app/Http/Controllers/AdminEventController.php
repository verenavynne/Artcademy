<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Event;

class AdminEventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->eventStatus && $request->eventStatus != 'Semua') {
            $now = Carbon::now();

            if ($request->eventStatus === 'Akan Datang') {
                $query->whereRaw("STR_TO_DATE(CONCAT(eventDate, ' ', start_time), '%Y-%m-%d %H:%i') > ?", [$now]);
            } elseif ($request->eventStatus === 'Selesai') {
                $query->whereRaw("STR_TO_DATE(CONCAT(eventDate, ' ', start_time), '%Y-%m-%d %H:%i') <= ?", [$now]);
            }
        }

        if ($request->search) {
            $query->where('eventName', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('perPage', 5);

        $events = $query->withCount('eventTransaction')
                        ->orderBy('created_at', 'desc')
                        ->paginate($perPage)
                        ->appends($request->query());

        return view('admin.event.eventManagement', compact('events'));
    }
    
    // create new event
    public function create()
    {
        return view('admin.event.event-create');
    }

    public function createEvent(Request $request)
    {
        $validated = $request->validate([
            'eventCategory' => 'required|string',
            'eventName' => 'required|string|max:255',
            'eventDesc' => 'required|string',
            'eventBanner' => 'required|image|mimes:jpg,png|max:2048',
            'eventPlace' => 'required|string|max:255',
            'eventDate' => 'required|date',
            'eventStartTime' => 'required',
            'eventDuration' => 'required|integer',
            'eventSlot' => 'required|integer',
            'eventPrice' => 'required|integer',
        ]);

        $startTime = Carbon::parse($request->eventStartTime)->format('H:i');;

        $originalName = $request->file('eventBanner')->getClientOriginalName();

        $filePath = $request->file('eventBanner')->storeAs(
            'event_banners',
            time() . '_' . $originalName,
            'public'
        );

        $event = Event::create([
            'eventCategory' => $validated['eventCategory'],
            'eventName' => $validated['eventName'],
            'eventDesc' => $validated['eventDesc'],
            'eventPlace' => $validated['eventPlace'],
            'eventBanner' => $filePath,
            'eventDate' => $validated['eventDate'],
            'start_time'  => $startTime,
            'eventDuration' => $validated['eventDuration'],
            'eventSlot' => $validated['eventSlot'],
            'eventPrice' => $validated['eventPrice'],
        ]);

       return redirect()->route('admin.event.index')->with('success', 'Event berhasil dipublikasikan.');;
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.event-edit', compact('event'));
    }

    public function updateEvent(Request $request, $eventId)
    {
        $validated = $request->validate([
            'eventCategory' => 'required|string',
            'eventName' => 'required|string|max:255',
            'eventDesc' => 'required|string',
            'eventBanner' => 'image|mimes:jpg,png|max:2048',
            'eventPlace' => 'required|string|max:255',
            'eventDate' => 'required|date',
            'eventStartTime' => 'required',
            'eventDuration' => 'required|integer',
            'eventSlot' => 'required|integer',
            'eventPrice' => 'required|integer',
        ]);

        $event = Event::findOrFail($eventId);

        $startTime = Carbon::parse($request->eventStartTime)->format('H:i');

        if ($request->hasFile('eventBanner')) {
            $originalName = $request->file('eventBanner')->getClientOriginalName();

            $filePath = $request->file('eventBanner')->storeAs(
                'event_banners',
                time() . '_' . $originalName,
                'public'
            );
        } else {
            $filePath = $event->eventBanner;
        }

        $event->update([
            'eventCategory' => $validated['eventCategory'],
            'eventName' => $validated['eventName'],
            'eventDesc' => $validated['eventDesc'],
            'eventPlace' => $validated['eventPlace'],
            'eventBanner' => $filePath,
            'eventDate' => $validated['eventDate'],
            'start_time'  => $startTime,
            'eventDuration' => $validated['eventDuration'],
            'eventSlot' => $validated['eventSlot'],
            'eventPrice' => $validated['eventPrice'],
        ]);

       return redirect()->route('admin.event.index')->with('success', 'Event berhasil diperbarui.');;
    }


    // delete event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus.');;
    }
}
