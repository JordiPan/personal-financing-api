<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'recurrence' => 'once',
            'date'=> $this->faker->dateTimeThisDecade(),
            'user_id' => User::factory(),
            'total'=> $this->faker->randomFloat(2,10000,10000)
        ];
    }
}
