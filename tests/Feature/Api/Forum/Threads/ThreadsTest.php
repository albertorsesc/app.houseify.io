<?php

namespace Tests\Feature\Api\Forum\Threads;

use App\Models\User;
use Tests\TestCase;
use App\Models\Forum\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.threads.';

    /**
     * @test
     * @throws \Throwable
    */
    public function guest_can_get_all_threads()
    {
        $this->signIn();
        $thread = $this->create(Thread::class);
        $this->signOut();

        $response = $this->getJson(route($this->routePrefix . 'index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $thread->id,
                    'author' => ['id' => $thread->author->id],
                    'title' => $thread->title,
                    'body' => $thread->body,
                ]
            ]
        ]);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function authenticated_user_can_create_a_thread()
    {
        $this->signIn();

        $thread = $this->make(Thread::class);

        $response = $this->postJson(route($this->routePrefix . 'store'), $thread->toArray());
        $response->assertCreated();
        $response->assertJson([
            'data' => [
                'title' => $thread->title,
                'body' => $thread->body
            ]
        ]);

        $this->assertDatabaseHas('threads', [
            'title' => $thread->title,
            'body' => $thread->body
        ]);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function authenticated_user_can_update_a_thread()
    {
        $this->signIn();

        $thread = $this->create(Thread::class, ['author_id' => auth()->id()]);
        $newThread = $this->make(Thread::class, ['author_id' => auth()->id()]);

        $response = $this->putJson(
            route($this->routePrefix . 'update', $thread),
            $newThread->toArray()
        );
        $response->assertOk();
        $response->assertJson([
            'data' => [
                'title' => $newThread->title,
                'body' => $newThread->body
            ]
        ]);

        $this->assertDatabaseHas('threads', $newThread->toArray());
    }

}
