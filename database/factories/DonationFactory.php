<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\Animal;
use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 5), // Asigna un usuario aleatorio
            'animal_id' => Animal::factory(), // Relación con un animal
            'event_id' => Event::factory(), // Relación con un evento
            'amount' => rand(1, 1000), // Cantidad aleatoria entre 1 y 1000
            'payment_method' => $this->faker->randomElement(['transaction_id', 'cash']), // Método de pago aleatorio
        ];
    }
}
