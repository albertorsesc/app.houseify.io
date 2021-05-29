<?php

namespace Tests\Feature\Api\Forum\Threads;

use Tests\TestCase;
use App\Models\Forum\Threads\Reply;
use App\Models\Forum\Threads\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarkBestReplyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
    */
    public function thread_author_can_mark_reply_as_best_reply()
    {
        $this->signIn();

        $thread = $this->create(Thread::class);
        $reply = $this->create(Reply::class, ['thread_id' => $thread->id]);

        $this->assertFalse($reply->isBest());

        $response = $this->putJson(route('api.threads.replies.best.store', [$thread, $reply]));
        $response->assertOk();

        $this->assertTrue($reply->fresh()->isBest());

        $this->signIn();
        $this->putJson(
            route('api.threads.replies.best.store', [$thread, $reply])
        )->assertForbidden();
        $this->assertFalse($reply->isBest());
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function thread_author_can_unmark_a_marked_as_best_reply()
    {
        $this->signIn();

        $thread = $this->create(Thread::class);
        $reply = $this->create(Reply::class, ['thread_id' => $thread->id]);
        $this->assertFalse($reply->isBest());

        $thread->toggleBestReply($reply);
        $this->assertTrue($reply->fresh()->isBest());

        $thread->toggleBestReply($reply);
        $this->assertFalse($reply->fresh()->isBest());
    }
}
