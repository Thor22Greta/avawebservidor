<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AnimalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); 
    }
    use AuthorizesRequests;
    public function index()
{
    $animals = Animal::orderBy('updated_at', 'desc')->get();
    return Inertia::render('Animals/Index', ['animals' => $animals]);
}

    public function create()
    {
        return Inertia::render('Animals/Create');
    }


    public function show(Animal $animal)
    {
        return Inertia::render('Animals/Show', ['animal' => $animal]);
    }

    public function edit(Animal $animal)
{
    $this->authorize('update', $animal); 
    return Inertia::render('Animals/Edit', ['animal' => $animal]);
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'raza' => 'required|string|max:255',
        'chip' => 'nullable|string|max:255',
        'age' => 'required|integer',
        'user_id' => 'required|exists:users,id',  // Verifica que el user_id esté presente y sea válido
        'adopted' => 'nullable|date',
        'poster_image_url' => 'nullable|url',
    ]);

    $animal = Animal::create([
        'name' => $request->name,
        'raza' => $request->raza,
        'chip' => $request->chip,
        'age' => $request->age,
        'user_id' => \Illuminate\Support\Facades\Auth::user()->id,  // Asigna el usuario autenticado
        'adopted' => $request->adopted,
        'poster_image_url' => $request->poster_image_url,
    ]);

    return redirect()->route('animals.index');
}

public function update(Request $request, Animal $animal)
{
    $this->authorize('update', $animal);

    $request->validate([
        'name' => 'required|string|max:255',
        'raza' => 'required|string|max:255',
        'chip' => 'nullable|string|max:255',
        'age' => 'required|integer',
        'user_id' => 'required|exists:users,id',
        'adopted' => 'nullable|date',
        'poster_image_url' => 'nullable|url',
    ]);

    // Verifica que solo el usuario autenticado pueda actualizar los animales que le pertenecen
    $animal->update($request->all());

    return redirect()->route('animals.index')->with('success', 'Animal actualizado correctamente.');
}


public function destroy(Animal $animal)
{
    $this->authorize('delete', $animal); 
    $animal->delete();
    
    return redirect()->route('animals.index')->with('success', 'Animal eliminado correctamente.');
}

}
