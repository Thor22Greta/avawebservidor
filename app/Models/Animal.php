<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = ['name', 'raza', 'chip', 'age', 'user_id', 'adopted', 'poster_image_url'];

    /**
     * Relació amb donacions
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // Si el campo 'adopted' es un timestamp, asegúrate de que no sea manipulado automáticamente por Eloquent
    protected $casts = [
        'adopted' => 'datetime',  // Convierte 'adopted' en un objeto de fecha y hora
    ];
}
