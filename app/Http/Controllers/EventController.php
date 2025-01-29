<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        return Inertia::render('Events/Index', [
            'events' => Event::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Events/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_date' => 'required|date',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Evento creado.');
    }

    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', [
            'event' => $event
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event_date' => 'required|date',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Evento actualizado.');
    }
    public function show(Event $event)
    {
        return Inertia::render('Events/Show', [
            'event' => $event
        ]);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento eliminado.');
    }
}
