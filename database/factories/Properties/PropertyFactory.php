<?php

namespace Database\Factories\Properties;

use App\Models\Properties\Property;
use App\Models\Properties\PropertyCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $uuid = $this->faker->uuid,
            'title' => $title = $this->faker->word,
            'slug' => Str::slug($title . '-' . $uuid),
            'seller_id' => User::factory(),
            'property_category_id' => PropertyCategory::query()->inRandomOrder()->first(),
            'business_type' => $this->faker->randomElement(\App\Models\Properties\Concerns\BusinessType::all()->toArray()),
            'price' => $this->faker->randomNumber('8'),
            'comments' => $this->faker->paragraph,
            'status' => true,
        ];
    }
}
