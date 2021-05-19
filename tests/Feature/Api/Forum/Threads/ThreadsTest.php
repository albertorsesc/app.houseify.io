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
                    'channel' => $thread->channel,
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
                'body' => $thread->body,
                'channel' => $thread->channel,
            ]
        ]);

        $this->assertDatabaseHas('threads', [
            'title' => $thread->title,
            'body' => $thread->body,
            'channel' => $thread->channel,
        ]);
    }

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

    /**
     * @test
     * @throws \Throwable
    */
    public function threads_can_be_filtered_by_channel()
    {
        $this->signIn();

        $channels = config('houseify.construction_categories');
        $thread = $this->create(Thread::class, ['channel' => $channels[1]]);
        $thread2 = $this->create(Thread::class, ['channel' => $channels[4]]);

        $response = $this->getJson(route($this->routePrefix . 'index', ['channel' => $thread->channel]));
        $this->assertCount(1, $response->getOriginalContent());
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function threads_can_be_queried_by_title_or_body()
    {
        $this->signIn();

        $thread1 = $this->create(Thread::class, ['title' => 'foo']);
        $thread2 = $this->create(Thread::class, ['body' => 'foobar']);
        $thread3 = $this->create(Thread::class, ['body' => 'something else']);

        $response = $this->getJson(route($this->routePrefix . 'index', ['search' => 'foo']));
        $response->assertOk();

        $this->assertCount(2, $response->getOriginalContent());
    }
}
