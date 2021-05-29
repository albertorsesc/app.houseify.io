<?php

namespace Tests\Feature\Api\Forum\Threads;

use App\Models\Forum\Threads\ThreadChannel;
use Database\Seeders\ThreadChannelSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadChannelsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
    */
    public function authenticated_user_can_get_all_thread_channels()
    {
        $this->loadSeeders([ThreadChannelSeeder::class]);
        $this->signIn();

        $this->getJson(
            route('api.thread-channels.index')
        )->assertOk();
    }
}
