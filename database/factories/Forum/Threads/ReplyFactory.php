<?php

namespace Database\Factories\Forum\Threads;

use App\Models\Forum\Thread;
use App\Models\Forum\Threads\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thread_id' => Thread::factory(),
            'author_id' => User::factory(),
            'body' => $this->faker->paragraph(),
        ];
    }
}
