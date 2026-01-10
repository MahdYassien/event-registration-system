<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Attendee;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        // 1️⃣ Prevent registration for past events
        if ($event->date_time < now()) {
            return back()->withErrors('Registration closed for this event.');
        }

        // 2️⃣ Validate input
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string',
            'company' => 'nullable|string',
        ]);

        // 3️⃣ Get or create attendee
        $attendee = Attendee::firstOrCreate(
            ['email' => $validated['email']],
            $validated
        );

        // 4️⃣ Prevent duplicate registration
        $alreadyRegistered = Registration::where('event_id', $event->id)
            ->where('attendee_id', $attendee->id)
            ->exists();

        if ($alreadyRegistered) {
            return back()->withErrors('You are already registered for this event.');
        }

        // 5️⃣ Count confirmed registrations
        $confirmedCount = Registration::where('event_id', $event->id)
            ->where('status', 'confirmed')
            ->count();

        // 6️⃣ Decide status
        $status = $confirmedCount < $event->capacity
            ? 'confirmed'
            : 'waitlisted';

        // 7️⃣ Create registration
        Registration::create([
            'event_id'          => $event->id,
            'attendee_id'       => $attendee->id,
            'registration_date' => now(),
            'status'            => $status,
            'payment_status'    => 'pending',
        ]);

        return back()->with(
            'success',
            $status === 'confirmed'
                ? 'You are registered successfully!'
                : 'Event is full. You have been waitlisted.'
        );
    }
}
