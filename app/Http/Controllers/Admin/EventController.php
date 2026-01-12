<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Registration;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date_time', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date_time'   => 'required|date|after:now',
            'location'    => 'required|string|max:255',
            'capacity'    => 'required|integer|min:1',
            'price'       => 'nullable|numeric|min:0',
            'status'      => 'required|in:draft,published,cancelled,completed',
        ]);

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date_time'   => 'required|date|after:now',
            'location'    => 'required|string|max:255',
            'capacity'    => 'required|integer|min:1',
            'price'       => 'nullable|numeric|min:0',
            'status'      => 'required|in:draft,published,cancelled,completed',
        ]);

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function registrations(Event $event)
{
    $registrations = $event->registrations()
        ->with('attendee')
        ->orderBy('created_at')
        ->get();

    return view('admin.events.registrations', compact('event', 'registrations'));
}



public function cancelRegistration(Registration $registration)
{
    $registration->update([
        'status' => 'cancelled',
    ]);

    return back()->with('success', 'Registration cancelled successfully.');
}



public function exportRegistrations(Event $event): StreamedResponse
{
    $fileName = 'event_' . $event->id . '_registrations.csv';

    return response()->streamDownload(function () use ($event) {
        $handle = fopen('php://output', 'w');

        // CSV Header
        fputcsv($handle, [
            'Name',
            'Email',
            'Phone',
            'Company',
            'Status',
            'Registered At'
        ]);

        foreach ($event->registrations()->with('attendee')->get() as $registration) {
            fputcsv($handle, [
                $registration->attendee->name,
                $registration->attendee->email,
                $registration->attendee->phone,
                $registration->attendee->company,
                ucfirst($registration->status),
                $registration->created_at->format('Y-m-d H:i'),
            ]);
        }

        fclose($handle);
    }, $fileName, [
        'Content-Type' => 'text/csv',
    ]);
}



}
