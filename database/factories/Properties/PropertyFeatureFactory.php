<?php

namespace Database\Factories\Properties;

use App\Models\Properties\Property;
use App\Models\Properties\PropertyFeature;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PropertyFeature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'property_id' => (fn () => Property::factory()),
            'features' => [
                'property_size' => $this->faker->randomNumber(4),
                'construction_size' => $this->faker->randomNumber(3),
                'level_count' => $this->faker->randomNumber(2),
                'room_count' => $this->faker->randomNumber(2),
                'bathroom_count' => $this->faker->randomNumber(1),
                'half_bathroom_count' => $this->faker->randomNumber(1),
            ]
        ];
    }
}
