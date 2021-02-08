<?php

namespace Tests\Unit\Http\Requests;

use App\Models\Suggestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class SuggestionRequestTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'suggestions.';

    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function subject_is_required()
    {
        $validatedField = 'subject';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Suggestion::class, [
                $validatedField => $brokenRule,
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function suggestion_must_not_exceed_50_characters()
    {
        $validatedField = 'subject';
        $brokenRule = Str::random(101);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(
                Suggestion::class,
                [$validatedField => $brokenRule]
            )->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function body_is_required()
    {
        $validatedField = 'body';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(Suggestion::class, [
                $validatedField => $brokenRule,
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}
