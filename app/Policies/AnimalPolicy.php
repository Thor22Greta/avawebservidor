<?php

namespace App\Policies;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AnimalPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return true; // Permite que todos los usuarios vean animales
    }

    /**
     * Determine whether the user can view the animal.
     */
    public function view(User $user, Animal $animal)
    {
        return true; // Permite que todos los usuarios vean detalles del animal
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false; // Cambiar según si se permite la creación por parte de los usuarios
    }

    /**
     * Determina si el usuario puede actualizar el animal.
     */
    public function update(User $user, Animal $animal): bool
{
    // Permite que el usuario edite si es el dueño o es un administrador
    return $user->id === $animal->user_id || $user->is_admin;
}

public function delete(User $user, Animal $animal): bool
{
    // Permite que el usuario elimine si es el dueño o es un administrador
    return $user->id === $animal->user_id || $user->is_admin;
}

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Animal $animal): bool
    {
        return false; // Se puede permitir restaurar si es necesario, ajustar según lo que se requiera
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Animal $animal): bool
    {
        return false; // Ajustar si es necesario
    }
}
