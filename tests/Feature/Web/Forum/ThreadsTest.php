<?php

namespace Tests\Feature\Web\Forum;

use Tests\TestCase;
use App\Models\Forum\Threads\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'web.threads.';

    /**
     * @test
     * @throws \Throwable
    */
    public function guest_can_visit_forums_threads_page()
    {
        $this->fakeEvent();

        $response = $this->get(route($this->routePrefix . 'index'));
        $response->assertViewIs('forum.threads.index');
        $response->assertViewHas('threads');
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function guest_can_visit_create_thread_page()
    {
        $this->fakeEvent();

        $response = $this->get(route($this->routePrefix . 'create'));
        $response->assertViewIs('forum.threads.create');
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function guest_can_visit_a_thread()
    {
        $this->fakeEvent();

        $thread = $this->create(Thread::class);

        $response = $this->get(route($this->routePrefix . 'show', [$thread->channel, $thread]));
        $response->assertViewIs('forum.threads.show');
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function authenticated_user_can_store_a_thread()
    {
        $this->signIn();

        $newThread = $this->make(Thread::class);

        $response = $this->post(route($this->routePrefix . 'store'), $newThread->toArray());
        $response->assertRedirect(route($this->routePrefix . 'index'));

        $this->assertDatabaseHas('threads', [
            'title' => $newThread->title,
            'body' => $newThread->body,
            'channel_id' => $newThread->channel->id,
            'author_id' => auth()->id(),
        ]);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function threads_can_be_filtered_by_channel()
    {
        $this->fakeEvent();
        $thread1 = $this->create(Thread::class);
        $thread2 = $this->create(Thread::class);

        $response = $this->get(route('web.threads.channels.index', $thread1->channel->slug));
        $response->assertViewIs('forum.threads.index');
        $response->assertViewHas('threads');
    }
}
