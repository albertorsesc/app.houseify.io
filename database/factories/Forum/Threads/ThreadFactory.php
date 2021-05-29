<?php

namespace Database\Factories\Forum\Threads;

use App\Models\Forum\Threads\ThreadChannel;
use App\Models\User;
use App\Models\Forum\Threads\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        \Artisan::call('db:seed --class=ThreadChannelSeeder');
        $title = $this->faker->sentence;
        return [
            'slug' => Str::slug($title),
            'author_id' => User::factory(),
            'channel_id' => ThreadChannel::query()->inRandomOrder()->first()->id,
            'title' => $title,
            'body' => $this->faker->paragraph(),
        ];
    }
}
