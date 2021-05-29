<?php

namespace Tests\Unit\Http\Requests\Forum\Threads;

use App\Models\Forum\Threads\Reply;
use Tests\TestCase;
use App\Models\Forum\Threads\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyRequestTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.threads.replies.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function body_is_required()
    {
        $validatedField = 'body';
        $brokenRule = null;
        $thread = $this->create(Thread::class);

        $this->postJson(
            route($this->routePrefix . 'store', $thread),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        /*$existingThread = $this->create(Thread::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingThread),
            $this->make(Thread::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);*/
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function replies_that_contain_spam_may_not_be_created()
    {
        $validatedField = 'body';
        $brokenRule = 'jaja';
        $reply = $this->make(Reply::class);

        $this->expectException(\Exception::class);

        $this->postJson(
            route($this->routePrefix . 'store', $reply),
            [$validatedField => $brokenRule]
        );

        /*$existingThread = $this->create(Thread::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingThread),
            $this->make(Thread::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);*/
    }

}
