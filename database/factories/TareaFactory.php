<?php

namespace Database\Factories;

use App\Models\Componente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tarea' => $this->faker->unique()->lexify('????????'),
            'componente_id' => Componente::all()->random()->id,
            'tiempo_estimado' => 30,
        ];
    }
}
