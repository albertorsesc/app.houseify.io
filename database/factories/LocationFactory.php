<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'locationable_id' => null,
            'locationable_type' => null,
            'address' => $this->faker->address,
            'state_id' => State::query()->inRandomOrder()->first(),
            'city' => $this->faker->city,
            'neighborhood' => $this->faker->word,
            'zip_code' => $this->faker->randomNumber(5),
            /*'coordinates' => [
                'latitude' => $this->faker->latitude,
                'longitude' => $this->faker->longitude,
            ]*/
        ];
    }
}
