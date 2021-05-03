<?php

namespace Tests\Unit\Models\Forum;

use App\Models\Forum\Threads\Reply;
use App\Models\User;
use Tests\TestCase;
use App\Models\Forum\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
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
    public function thread_belongs_to_an_author()
    {
        $thread = $this->create(Thread::class);

        $this->assertInstanceOf(User::class, $thread->author);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function thread_has_many_replies()
    {
        $thread = $this->create(Thread::class);
        $this->create(Reply::class, ['thread_id' => $thread->id]);

        $this->assertInstanceOf(Reply::class, $thread->replies->first());
    }
}
