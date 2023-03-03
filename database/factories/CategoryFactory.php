<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Ejemplo de slug
        // Hola mundo como estas
        // hola-mundo-como-estas

        $name = $this->faker->unique()->word(20);

        return [
            // Llenado de datos de prueba
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
