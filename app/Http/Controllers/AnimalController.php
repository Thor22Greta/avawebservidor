<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::all();
        return Inertia::render('Animals/Index', ['animals' => $animals]);
    }

    public function create()
    {
        return Inertia::render('Animals/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'chip' => 'nullable|string|max:255',
            'age' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'adopted' => 'nullable|date',
            'poster_image_url' => 'nullable|url',
        ]);

        Animal::create($request->all());

        return redirect()->route('animals.index');
    }

    public function show(Animal $animal)
    {
        return Inertia::render('Animals/Show', ['animal' => $animal]);
    }

    public function edit(Animal $animal)
    {
        return Inertia::render('Animals/Edit', ['animal' => $animal]);
    }

    public function update(Request $request, Animal $animal)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'chip' => 'nullable|string|max:255',
            'age' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'adopted' => 'nullable|date',
            'poster_image_url' => 'nullable|url',
        ]);

        $animal->update($request->all());

        return redirect()->route('animals.index');
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();
        return redirect()->route('animals.index');
    }
}
