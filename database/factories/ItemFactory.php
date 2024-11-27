<?php

namespace Database\Factories;

use App\Models\category;
use App\Models\country;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2,10000,10000),
            'amount' => $this->faker->randomFloat(2,1,100),
            'purchase_date'=> $this->faker->dateTimeThisDecade(),
            'user_id' => User::factory(),
            'country_id' => 1,
            'transaction_id' => transaction::factory(),
            'category_id' => category::factory(),
        ];
    }
}
