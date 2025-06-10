<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UrnaFactory extends Factory
{
    protected $model = \App\Models\Urna::class;

    public function definition(): array
    {
        return [
            'urna_nome' => $this->faker->word(),
            'urna_tipo' => $this->faker->randomElement(['Simples', 'Luxo']),
            'urna_material' => $this->faker->randomElement(['Madeira', 'Metal']),
            'urna_preco' => $this->faker->randomFloat(2, 500, 5000),
        ];
    }
}
