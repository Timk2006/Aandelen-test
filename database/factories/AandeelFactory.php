<?php

namespace Database\Factories;

use App\Models\Aandeel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AandeelFactory extends Factory
{
    protected $model = Aandeel::class;

    public function definition()
    {
        return [
            'naam' => $this->faker->company,
            'prijs' => $this->faker->randomFloat(2, 10, 500),
            'omschrijving' => $this->faker->sentence(10),
        ];
    }
}
