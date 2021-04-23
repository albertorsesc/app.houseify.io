<?php

namespace Database\Factories\JobProfiles;

use App\Models\JobProfiles\JobProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(50),
            'skills' => $this->faker->randomElements(config('job-profiles.skills')),
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'facebook_profile' => $this->faker->url,
            'site' => $this->faker->url,
            'bio' => $this->faker->paragraph,
            'status' => false,
        ];
    }

    /**
     * Indicate that the user is suspended.
     *
     * @return Factory
     */
    public function published() : Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => true,
            ];
        });
    }
}
