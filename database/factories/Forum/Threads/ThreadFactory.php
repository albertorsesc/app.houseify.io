<?php

namespace Database\Factories\Forum\Threads;

use App\Models\User;
use App\Models\Forum\Threads\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => User::factory(),
            'title' => $this->faker->text(255),
            'body' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement(config('houseify.construction_categories')),
        ];
    }
}
