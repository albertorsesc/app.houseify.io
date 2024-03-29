<?php

namespace Database\Factories\Businesses\Inventory;

use App\Models\Businesses\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'business_id' => Business::factory(),
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph(),
            'in_stock' => $this->faker->randomNumber(rand(1, 2)),
            'storage_unit' => $this->faker->randomElement(config('houseify.storage_units')),
            'unit_price' => $this->faker->randomNumber(rand(1, 2)),
        ];
    }
}
