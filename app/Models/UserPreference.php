<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'dark_mode'];

    // Relación con el modelo de usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
