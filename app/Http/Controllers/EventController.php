<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventController extends Controller
{
    use AuthorizesRequests;
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
    $this->authorize('update', $event); // 🔒 Verifica si el usuario puede editar
    return Inertia::render('Events/Edit', ['event' => $event]);
}

public function update(Request $request, Event $event)
{
    $this->authorize('update', $event); // 🔒 Verifica si el usuario puede actualizar

    $request->validate([
        'event_date' => 'required|date',
        'description' => 'required|string|max:255',
        'location' => 'required|string|max:255',
    ]);

    $event->update($request->all());

    return redirect()->route('events.index')->with('success', 'Evento actualizado correctamente.');
}

public function destroy(Event $event)
{
    $this->authorize('delete', $event); // 🔒 Verifica si el usuario puede eliminar
    $event->delete();
    
    return redirect()->route('events.index')->with('success', 'Evento eliminado correctamente.');
}
public function show(Event $event)
{
    // Aseguramos que el usuario tiene permiso para ver el evento, si es necesario.
    $this->authorize('view', $event);

    // Retorna la vista con el evento para mostrar sus detalles.
    return Inertia::render('Events/Show', [
        'event' => $event
    ]);
}

}
