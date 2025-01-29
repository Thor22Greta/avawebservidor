<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\User;
use App\Models\Animal;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with(['user', 'animal', 'event'])->get();
        return Inertia::render('Donations/Index', ['donations' => $donations]);
    }

    public function create()
    {
        return Inertia::render('Donations/Create', [
            'users' => User::all(),
            'animals' => Animal::all(),
            'events' => Event::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'animal_id' => 'nullable|exists:animals,id',
            'event_id' => 'nullable|exists:events,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|max:255',
        ]);

        Donation::create($request->all());

        return redirect()->route('donations.index');
    }

    public function show(Donation $donation)
    {
        return Inertia::render('Donations/Show', ['donation' => $donation->load(['user', 'animal', 'event'])]);
    }

    public function edit(Donation $donation)
    {
        return Inertia::render('Donations/Edit', [
            'donation' => $donation->load(['user', 'animal', 'event']),
            'users' => User::all(),
            'animals' => Animal::all(),
            'events' => Event::all(),
        ]);
    }

    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'animal_id' => 'nullable|exists:animals,id',
            'event_id' => 'nullable|exists:events,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|max:255',
        ]);

        $donation->update($request->all());

        return redirect()->route('donations.index');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('donations.index');
    }
}
