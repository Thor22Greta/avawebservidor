<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use App\Models\Event;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Pasamos los totales y otros datos a la vista
        return inertia('Admin', [
            'users' => User::all(),
            'user' => Auth::user(),
            'csrfToken' => $csrfToken, // Pasamos el token CSRF al componente
            'totals' => $totals, // Los totales que se van a mostrar en la tabla
        ]);
    }

    // Método para cambiar el estado del usuario
    public function toggleStatus($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Cambiar el estado entre 'activo' y 'bloqueado'
        $user->status = ($user->status === 'activo') ? 'bloqueado' : 'activo';
        $user->save();

        // Redirigir de nuevo al administrador
        return redirect()->route('admin.index')->with('success', 'Estado del usuario actualizado');
    }
}
