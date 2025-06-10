<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FinadoFactory extends Factory
{
    protected $model = \App\Models\Finado::class;

    public function definition(): array
    {
        return [
            'finado_nome' => $this->faker->name(),
            'finado_certidao' => $this->faker->unique()->numerify('########'),
        ];
    }
}

