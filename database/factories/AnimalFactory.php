<?php

namespace Database\Factories;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $breeds = [
            'Labrador Retriever', 'Golden Retriever', 'Bulldog', 'Beagle', 'Poodle',
            'Chihuahua', 'German Shepherd', 'Pug', 'French Bulldog', 'Dachshund',
            'Boxer', 'Rottweiler', 'Siberian Husky', 'Shih Tzu', 'Cocker Spaniel',
            'Doberman Pinscher', 'Border Collie', 'Yorkshire Terrier', 'Dalmatian', 'Chow Chow'
        ];

        return [
            'name' => $this->faker->word, // Nombre aleatorio de mascota
            'raza' => $breeds[array_rand($breeds)], // Selección aleatoria de raza
            'chip' => $this->faker->optional()->numberBetween(100000000000000, 999999999999999), // Número de chip de 15 dígitos, nullable
            'age' => rand(1, 10), // Edad aleatoria de 1 a 10
            'user_id' => rand(1, 5), // Asigna un usuario aleatorio
            'adopted' => $this->faker->optional()->dateTime(), // Adoptado aleatoriamente (puede ser un timestamp o null)
            'poster_image_url' => "https://via.placeholder.com/640x480.png?text=" . $this->faker->word(), // Imagen placeholder con nombre aleatorio
        ];
    }
}
