<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        // Lógica para determinar si el evento es "próximo" o "ya realizado"
        $isUpcoming = rand(0, 1); // Generar 0 o 1 aleatorio para determinar el tipo de evento

        if ($isUpcoming) {
            // Evento futuro
            return [
                'event_date' => $this->faker->dateTimeBetween('now', '+1 year'), // Fecha futura
                'description' => $this->faker->sentence(), // Descripción del evento
                'poster_image_url' => "https://via.placeholder.com/640x480.png?text=" . $months[array_rand($months)], // Imagen del cartel
                'user_id' => rand(1, 99), // Usuario aleatorio
                'location' => $this->faker->sentence(), // Lugar del evento
                'contact_info' => $this->faker->email(), // Información de contacto (e-mail)
            ];
        } else {
            // Evento pasado
            return [
                'event_date' => $this->faker->dateTimeBetween('-1 year', 'now'), // Fecha pasada
                'description' => $this->faker->sentence(), // Descripción del evento
                'poster_image_url' => "https://via.placeholder.com/640x480.png?text=" . $months[array_rand($months)], // Imagen del cartel
                'user_id' => rand(1, 99), // Usuario aleatorio
                'revenue' => $this->faker->randomFloat(2, 50, 1000), // Recaudación (amount) de 50 a 1000
            ];
        }
    }
}