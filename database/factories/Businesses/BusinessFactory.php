<?php

namespace Database\Factories\Businesses;

use App\Models\Businesses\Business;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Business::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'name' => $name = $this->faker->unique()->company,
            'slug' => Str::slug($name),
            'owner_id' => User::factory(),
            'categories' => $this->faker->randomElements(
                collect(config('houseify.construction_categories'))->random(3)->toArray()
            ),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'site' => $this->faker->url,
            'facebook_profile' => $this->faker->url,
            'linkedin_profile' => $this->faker->url,
            'comments' => $this->faker->paragraph,
            'status' => true,
        ];
    }
}
