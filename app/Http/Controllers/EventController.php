<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{

    public function publicIndex()
{
    // Only show events that are 'published' and in the future [cite: 55, 78]
    $events = \App\Models\Event::where('status', 'published')
        ->where('date_time', '>', now())
        ->orderBy('date_time', 'asc')
        ->get();

    return view('events.public-index', compact('events'));
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all events, ordered by the newest date first
    $events = \App\Models\Event::orderBy('date_time', 'desc')->get();

    return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mandatory Requirement: Validation [cite: 74, 77]
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'date_time' => 'required|date|after:now', // Date must be in the future [cite: 77]
        'location' => 'required|string',
        'capacity' => 'required|integer|min:1',
        'price' => 'nullable|numeric|min:0',
        'status' => 'required|in:draft,published,cancelled,completed',
    ]);

    \App\Models\Event::create($validated);

    return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
