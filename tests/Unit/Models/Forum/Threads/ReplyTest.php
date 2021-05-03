<?php

namespace Tests\Unit\Models\Forum\Threads;

use Tests\TestCase;
use App\Models\User;
use App\Models\Forum\Thread;
use App\Models\Forum\Threads\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp () : void
    {
        parent::setUp();
        $this->fakeEvent();
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function reply_belongs_to_a_thread()
    {
        $reply = $this->create(Reply::class);

        $this->assertInstanceOf(Thread::class, $reply->thread);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function reply_belongs_to_an_author()
    {
        $reply = $this->create(Reply::class);

        $this->assertInstanceOf(User::class, $reply->author);
    }
}
