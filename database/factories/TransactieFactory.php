<?php
use App\Models\User;
use App\Models\Aandeel;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'aandeel_id'=> Aandeel::factory(),
            'aantal' => $this->faker->numberBetween(1, 50),
            'prijs_per_stuk' => $this->faker->randomFloat(2, 5, 10),
        ];
    }
}
