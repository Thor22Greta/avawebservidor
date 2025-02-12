<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\User;
use App\Models\Animal;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;


class DonationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // Todos los usuarios pueden ver todas las donaciones
        $donations = Donation::with(['user', 'animal', 'event'])->get();
        return Inertia::render('Donations/Index', ['donations' => $donations]);
    }

    public function create()
{
    return Inertia::render('Donations/Create', [
        // No se envía la lista de usuarios, ya que el usuario autenticado se toma automáticamente
        'animals' => Animal::all(),
        'events' => Event::all(),
    ]);
}

public function store(Request $request)
{
    
    $request->validate([
        // Reglas de validación
        'user_id' => 'required|exists:users,id',
        'animal_id' => 'nullable|exists:animals,id',
        'event_id' => 'nullable|exists:events,id',
        'amount' => 'required|numeric',
        'payment_method' => 'required|string',
        'donante' => 'required|string|max:255',
    ]);

    $data = $request->all();
    // Opcional: sobrescribir user_id con el ID del usuario autenticado
    $data['user_id'] = Auth::id();

    $donation = Donation::create($data);

    return redirect()->route('donations.index')->with('success', 'Donación creada con éxito');
}

    public function edit(Donation $donation)
    {
        // Verifica si el usuario puede editar la donación
        $this->authorize('update', $donation);

        // Muestra el formulario para editar una donación
        return Inertia::render('Donations/Edit', [
            'donation' => $donation->load(['user', 'animal', 'event']),
            'users' => User::all(),
            'animals' => Animal::all(),
            'events' => Event::all(),
            'donante' => 'required|string|max:255',
        ]);
    }

    public function update(Request $request, Donation $donation)
{
    $this->authorize('update', $donation);

    $request->validate([
        'user_id' => 'required|exists:users,id',
        'animal_id' => 'nullable|exists:animals,id',
        'event_id' => 'nullable|exists:events,id',
        'amount' => 'required|numeric|min:1',
        'payment_method' => 'required|string|max:255',
        'donante' => 'required|string|max:255',
    ]);

    $donation->update($request->all());

    return redirect()->route('donations.index')->with('success', 'Donación actualizada correctamente.');
}

    public function destroy(Donation $donation)
    {
        // Verifica si el usuario puede eliminar la donación
        $this->authorize('delete', $donation);

        // Elimina la donación
        $donation->delete();

        return redirect()->route('donations.index')->with('success', 'Donación eliminada correctamente.');
    }

    public function show(Donation $donation)
    {
        // Todos los usuarios pueden ver los detalles de cualquier donación
        return Inertia::render('Donations/Show', ['donation' => $donation->load(['user', 'animal', 'event'])]);
    }
}
