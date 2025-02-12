<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    // Añadimos el campo 'payment_method' a $fillable
    protected $fillable = ['user_id', 'animal_id', 'event_id', 'amount', 'payment_method', 'donante'];

    /**
     * Relación con 'users'
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con 'animals'
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    /**
     * Relación con 'events'
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
