<?php

namespace Tests\Feature\Api\Forum\Threads;

use Tests\TestCase;
use App\Models\Forum\Threads\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.threads.';

    /**
     * @test
     * @throws \Throwable
    */
    public function authorized_user_can_update_a_thread()
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
                'id' => $thread->id,
                'slug' => $newThread->slug,
                'title' => $newThread->title,
                'body' => $newThread->body
            ]
        ]);

        $this->assertDatabaseHas('threads', $newThread->toArray());
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function authorized_user_can_delete_own_thread()
    {
        $this->signIn();

        $thread = $this->create(Thread::class);

        $response = $this->deleteJson(route($this->routePrefix . 'destroy', $thread));
        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', $thread->toArray());
    }
}
