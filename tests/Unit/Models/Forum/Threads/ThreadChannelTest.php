<?php

namespace Tests\Unit\Models\Forum\Threads;

use Tests\TestCase;
use Database\Seeders\ThreadChannelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Forum\Threads\{Thread, ThreadChannel};

class ThreadChannelTest extends TestCase
{
    use RefreshDatabase;

   /**
    * @test
    * @throws \Throwable
   */
   public function thread_channel_has_many_threads()
   {
       $this->fakeEvent();
       $this->loadSeeders([ThreadChannelSeeder::class]);

       $channel = ThreadChannel::query()->inRandomOrder()->first();
       $this->create(Thread::class, ['channel_id' => $channel->id]);

       $this->assertInstanceOf(Thread::class, $channel->threads->first());
   }
}
