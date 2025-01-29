<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Asegúrate de agregar los nuevos campos en el array $fillable
    protected $fillable = ['event_date', 'description', 'poster_image_url', 'user_id', 'location', 'contact_info', 'revenue'];

    /**
     * Relación con 'donations'.
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Relación con 'user'.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
