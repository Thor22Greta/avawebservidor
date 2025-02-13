<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    public function getPreferences()
    {
        $user = Auth::user();

        // Obtener las preferencias del usuario autenticado
        $userPreference = UserPreference::where('user_id', $user->id)->first();

        // Si no existe, devolver el valor por defecto (modo claro)
        return response()->json([
            'dark_mode' => $userPreference ? $userPreference->dark_mode : false,
        ]);
    }

    public function updateDarkMode(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'dark_mode' => 'required|boolean',
        ]);

        // Buscar las preferencias del usuario
        $userPreference = UserPreference::where('user_id', $user->id)->first();

        if ($userPreference) {
            // Si ya existen preferencias, actualizamos
            $userPreference->update([
                'dark_mode' => $request->dark_mode,
            ]);
        } else {
            // Si no existen preferencias, las creamos
            UserPreference::create([
                'user_id' => $user->id,
                'dark_mode' => $request->dark_mode,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
