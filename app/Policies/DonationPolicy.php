<?php

namespace App\Policies;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DonationPolicy
{
    /**
     * Determina si el usuario puede crear una donación.
     */
    public function create(User $user): bool
    {
        return true; // Todos los usuarios pueden crear una donación
    }

    /**
     * Determina si el usuario puede ver cualquier donación.
     */
    public function viewAny(User $user)
    {
        return true; // Todos los usuarios pueden ver cualquier donación
    }

    /**
     * Determina si el usuario puede ver una donación específica.
     */
    public function view(User $user, Donation $donation)
    {
        return true; // Todos los usuarios pueden ver una donación específica
    }

    /**
     * Determina si el usuario puede actualizar una donación.
     */
    public function update(User $user, Donation $donation)
    {
        return $user->id === $donation->user_id || $user->is_admin; // Solo el creador o admin pueden editar
    }

    /**
     * Determina si el usuario puede eliminar una donación.
     */
    public function delete(User $user, Donation $donation)
    {
        return $user->id === $donation->user_id || $user->is_admin; // Solo el creador o admin pueden eliminar
    }

    /**
     * Determina si el usuario puede restaurar una donación.
     */
    public function restore(User $user, Donation $donation): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente una donación.
     */
    public function forceDelete(User $user, Donation $donation): bool
    {
        return false;
    }
}
