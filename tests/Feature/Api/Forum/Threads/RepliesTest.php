<?php

namespace Tests\Feature\Api\Forum\Threads;

use App\Models\Forum\Thread;
use App\Models\Forum\Threads\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepliesTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.threads.replies.';

    protected function setUp () : void
    {
        parent::setUp();
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function guest_can_get_all_replies_for_a_threads()
    {
        $this->fakeEvent();

        $reply = $this->create(Reply::class);

        $response = $this->getJson(route($this->routePrefix . 'index', $reply->thread));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $reply->id,
                    'author' => ['id' => $reply->author->id],
                    'body' => $reply->body,
                ]
            ]
        ]);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function guests_cannot_reply_to_a_thread()
    {
        $this->fakeEvent();

        $newReply = $this->make(Reply::class);

        $this->postJson(
            route($this->routePrefix . 'store', $newReply->thread),
            $newReply->toArray()
        )->assertUnauthorized();

        $this->assertDatabaseCount('replies', 0);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function authenticated_user_can_reply_to_a_thread()
    {
        $this->signIn();

        $newReply = $this->make(Reply::class);

        $response = $this->postJson(
            route($this->routePrefix . 'store', $newReply->thread),
            $newReply->toArray()
        );
        $response->assertCreated();
        $reply = Reply::first();
        $response->assertJson([
            'data' => [
                'thread' => ['id' => $reply->thread->id],
                'author' => ['id' => auth()->id()],
                'body' => $reply->body
            ]
        ]);

        $this->assertTrue(Reply::first()->author->id === auth()->id());
        $this->assertDatabaseHas('replies', [
            'thread_id' => $newReply->thread->id,
            'author_id' => auth()->id(),
            'body' => $newReply->body
        ]);
    }
}
