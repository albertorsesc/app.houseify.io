<?php

namespace Tests\Unit\Models\Forum\Threads;

use Tests\TestCase;
use App\Models\User;
use App\Models\Forum\Threads\{Reply, Thread};
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
    */
    public function reply_belongs_to_a_thread()
    {
        $this->fakeEvent();
        $reply = $this->create(Reply::class);

        $this->assertInstanceOf(Thread::class, $reply->thread);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function reply_belongs_to_an_author()
    {
        $this->fakeEvent();
        $reply = $this->create(Reply::class);

        $this->assertInstanceOf(User::class, $reply->author);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function reply_has_is_best_reply_method()
    {
        $this->signIn();
        $reply = $this->create(Reply::class);

        $this->assertFalse($reply->isBest());

        $reply->thread->update(['best_reply_id' => $reply->id]);

        $this->assertTrue($reply->fresh()->isBest());

    }
}
