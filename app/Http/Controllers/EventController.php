<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function publicIndex()
    {
        $events = Event::where('status', 'published')
            ->where('date_time', '>=', now())
            ->orderBy('date_time')
            ->get();

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
    abort_if($event->status !== 'published', 404);

    return view('events.show', compact('event'));
    }


}
