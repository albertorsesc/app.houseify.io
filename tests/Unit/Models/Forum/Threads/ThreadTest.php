<?php

namespace Tests\Unit\Models\Forum\Threads;

use Database\Seeders\ThreadChannelSeeder;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Forum\Threads\{Reply, Thread, ThreadChannel};

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
    */
    public function thread_belongs_to_an_author()
    {
        $this->fakeEvent();

        $thread = $this->create(Thread::class);

        $this->assertInstanceOf(User::class, $thread->author);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function thread_belongs_to_a_channel()
    {
        $this->fakeEvent();
        $this->loadSeeders([ThreadChannelSeeder::class]);

        $thread = $this->create(Thread::class);

        $this->assertInstanceOf(ThreadChannel::class, $thread->channel);
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function thread_has_many_replies()
    {
        $this->fakeEvent();
        $thread = $this->create(Thread::class);
        $this->create(Reply::class, ['thread_id' => $thread->id]);

        $this->assertInstanceOf(Reply::class, $thread->replies->first());
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function thread_has_a_profile()
    {
        $this->fakeEvent();
        $thread = $this->create(Thread::class);

        $this->assertEquals(
            config('app.url') . "/forum/{$thread->channel->slug}/$thread->slug",
            $thread->profile()
        );
    }

    /**
     * @test
     * @throws \Throwable
    */
    public function thread_has_a_unique_slug()
    {
        $this->withoutExceptionHandling()
             ->signIn();

        $thread = $this->create(Thread::class, [
            'title' => 'Foo title',
        ]);
        $this->assertEquals('foo-title', $thread->slug);

        $this->post(
            route('web.threads.store'),
            [
                'title' => $thread->title,
                'body' => $thread->body,
                'channel_id' => $thread->channel_id
            ]
        );
        $this->assertTrue(Thread::where('slug', 'foo-title-2')->exists());

        $this->post(
            route('web.threads.store'),
            [
                'title' => $thread->title,
                'body' => $thread->body,
                'channel_id' => $thread->channel_id
            ]
        );
        $this->assertTrue(Thread::where('slug', 'foo-title-3')->exists());
    }
}
