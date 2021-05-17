<?php

namespace Tests\Unit\Http\Requests\Forum\Threads;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\Forum\Threads\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadRequestTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.threads.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function title_is_required()
    {
        $validatedField = 'title';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingThread = $this->create(Thread::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingThread),
            $this->make(Thread::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function title_must_not_exceed_255_characters()
    {
        $validatedField = 'title';
        $brokenRule = Str::random(256);

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingThread = $this->create(Thread::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingThread),
            $this->make(Thread::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function body_is_required()
    {
        $validatedField = 'body';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingThread = $this->create(Thread::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingThread),
            $this->make(Thread::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function channel_is_required()
    {
        $validatedField = 'channel';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingThread = $this->create(Thread::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingThread),
            $this->make(Thread::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function channel_must_exist_in_config_file()
    {
        $validatedField = 'channel';
        $brokenRule = 'Otra Categoría';

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingThread = $this->create(Thread::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingThread),
            $this->make(Thread::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}
