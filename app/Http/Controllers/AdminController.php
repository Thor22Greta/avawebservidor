<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use App\Models\Event;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
{
    $csrfToken = csrf_token(); // Obtener el token CSRF

    // Contamos los registros de cada modelo
    $totals = [
        'users' => User::count(),
        'animals' => Animal::count(),
        'events' => Event::count(),
        'donations' => Donation::count(),
    ];

    // Pasamos los totales, usuarios y animales a la vista
    return Inertia::render('Admin', [
        'users' => User::all(),
        'user' => Auth::user(),
        'csrfToken' => $csrfToken,
        'totals' => $totals,
        'animals' => Animal::orderBy('updated_at', 'desc')->get(), // 🔹 Ahora enviamos los animales
    ]);
}


    public function toggleStatus($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Cambiar el estado entre 'activo' y 'bloqueado'
        $user->status = ($user->status === 'activo') ? 'bloqueado' : 'activo';
        $user->save();

        // Redirigir de nuevo al panel de administración
        return redirect()->route('admin.index')->with('success', 'Estado del usuario actualizado');
    }
}
