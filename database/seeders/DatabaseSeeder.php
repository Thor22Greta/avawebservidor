<?php

// database/seeders/DatabaseSeeder.php

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
        // Crear un usuario normal (Test User)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@example.com', // Correo único
            'password' => bcrypt('12341234'),
            'is_admin' => 0, // Usuario normal
        ]);

        // Crear un usuario administrador (Admin User)
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'adminuser@example.com', // Correo único
            'password' => bcrypt('12341234'),
            'is_admin' => 1, // Usuario administrador
        ]);

        // Crear 10 animales, asociando a cada uno un usuario aleatorio
        Animal::factory(10)->create([
            'user_id' => User::inRandomOrder()->first()->id, // Asociar un usuario aleatorio
        ]);

        // Crear 10 eventos, asociando a cada uno un usuario aleatorio
        Event::factory(10)->create([
            'user_id' => User::inRandomOrder()->first()->id, // Asociar un usuario aleatorio
        ]);

        // Crear 10 donaciones, asociando aleatoriamente un usuario, un animal y un evento
        Donation::factory(10)->create([
            'user_id' => User::inRandomOrder()->first()->id, // Asociar un usuario aleatorio
            'animal_id' => Animal::inRandomOrder()->first()->id, // Asociar un animal aleatorio
            'event_id' => Event::inRandomOrder()->first()->id, // Asociar un evento aleatorio
        ]);
    }
}


