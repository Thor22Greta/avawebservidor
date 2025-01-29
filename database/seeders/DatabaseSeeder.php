<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Animal;
use App\Models\Event;
use App\Models\Donation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    User::factory()->create([
        'name'=> 'Test User',
        'email'=> 'test@example.com',
        'password'=> bcrypt("12341234"),
        'is_admin'=> 0,
    ]);

    User::factory()->create([
        'name'=> 'Admin User',
        'email'=> 'admin@example.com',
        'password'=> bcrypt("12341234"),
        'is_admin'=> 1,
    ]);

    // Crear 10 animales, asociando a cada uno un usuario aleatorio
    Animal::factory(10)->create([
        'user_id' => 1, // Asignar un usuario aleatorio de la colección de usuarios creados
    ]);

    // Crear 10 eventos, asociando a cada uno un usuario aleatorio
    Event::factory(10)->create([
        'user_id' => 1, // Asignar un usuario aleatorio de la colección de usuarios creados
    ]);

    // Crear 10 donaciones, asociando aleatoriamente un usuario, un animal y un evento
    Donation::factory(10)->create([
        'user_id' => 1, // Asignar un usuario aleatorio de los usuarios creados
        'animal_id' => Animal::inRandomOrder()->first()->id, // Asignar un animal aleatorio
        'event_id' => Event::inRandomOrder()->first()->id, // Asignar un evento aleatorio
    ]);
}
}

