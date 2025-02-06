<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return true; // Permite que todos los usuarios vean eventos
    }

    /**
     * Determine whether the user can view the event.
     */
    public function view(User $user, Event $event)
    {
        return true; // Permite que todos los usuarios vean eventos
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Event $event): bool
    {
        return $user->id === $event->user_id || $user->is_admin;
    }

    /**
     * Determina si el usuario puede eliminar un evento.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->id === $event->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        return false;
    }
}
