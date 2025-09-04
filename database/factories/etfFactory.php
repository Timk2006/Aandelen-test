<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\etf>
 */
class EtfFactory extends Factory
{
    public function definition(): array
    {
        return [
            'naam' => $this->faker->company,
            'prijs' => $this->faker->randomFloat(5, 10, 12),
            'omschrijving' => $this->faker->sentence(5),
            'foto_url' => $this->faker->imageUrl(640, 480, 'business', true, 'stock'),
        ];
    }
    }

