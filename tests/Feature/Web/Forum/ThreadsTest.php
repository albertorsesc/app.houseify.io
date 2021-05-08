<?php

namespace Tests\Feature\Web\Forum;

use App\Models\Forum\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadsTest extends TestCase
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
    public function guest_can_visit_forums_threads_page()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('web.forum.threads.index'));
        $response->assertViewIs('forum.threads.index');
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function guest_can_visit_a_thread()
    {
        $this->withoutExceptionHandling();
        $thread = $this->create(Thread::class);

        $response = $this->get(route('web.forum.threads.show', $thread));
        $response->assertViewIs('forum.threads.show');
    }
}
