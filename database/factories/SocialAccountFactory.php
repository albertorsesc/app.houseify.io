<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialAccountFactory extends Factory
{
    protected $model = \App\Models\SocialAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->randomElement(config('services.login_services')),
            'client_id' => $this->faker->uuid,
            'avatar' => $this->faker->imageUrl(),
        ];
    }
}
