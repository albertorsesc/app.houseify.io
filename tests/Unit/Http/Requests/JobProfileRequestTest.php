<?php

namespace Tests\Unit\Http\Requests;

use App\Models\JobProfiles\JobProfile;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobProfileRequestTest extends TestCase
{
    use RefreshDatabase;

    private string $routePrefix = 'api.job-profiles.';

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

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function title_must_not_exceed_100_characters()
    {
        $validatedField = 'title';
        $brokenRule = Str::random(101);

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function skills_is_required()
    {
        $validatedField = 'skills';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(JobProfile::class, [
                $validatedField => $brokenRule
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function skills_must_have_an_array_format()
    {
        $validatedField = 'skills';
        $brokenRule = 'Pintor';

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(JobProfile::class, [
                $validatedField => $brokenRule
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function skills_must_exist_in_job_profile_skills()
    {
        $validatedField = 'skills';
        $brokenRule = ['non-category'];

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(JobProfile::class, [
                $validatedField => $brokenRule
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function email_must_have_a_valid_email_format()
    {
        $validatedField = 'email';
        $brokenRule = 'not-email';

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(JobProfile::class, [
                $validatedField => $brokenRule
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function email_must_not_exceed_150_characters()
    {
        $validatedField = 'email';
        $brokenRule = Str::random(151);

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function email_must_be_required_if_phone_is_empty()
    {
        $validatedField = 'email';
        $brokenRule = null;

        $this->postJson(
            route($this->routePrefix . 'store'),
            $this->make(JobProfile::class, [
                $validatedField => $brokenRule,
                'phone' => null
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [
                $validatedField => $brokenRule,
                'phone' => null
            ])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function phone_must_not_exceed_60_characters()
    {
        $validatedField = 'phone';
        $brokenRule = Str::random(61);

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function facebook_profile_must_not_exceed_255_characters()
    {
        $validatedField = 'facebook_profile';
        $brokenRule = Str::random(256);

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function facebook_profile_must_be_a_valid_url()
    {
        $validatedField = 'facebook_profile';
        $brokenRule = 'www.not-a-valid-url.com';

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function site_must_not_exceed_255_characters()
    {
        $validatedField = 'site';
        $brokenRule = Str::random(256);

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function site_must_be_a_valid_url()
    {
        $validatedField = 'site';
        $brokenRule = 'www.not-a-valid-url.com';

        $this->postJson(
            route($this->routePrefix . 'store'),
            [$validatedField => $brokenRule]
        )->assertJsonValidationErrors($validatedField);

        $existingJobProfile = $this->create(JobProfile::class);
        $this->putJson(
            route($this->routePrefix . 'update', $existingJobProfile),
            $this->make(JobProfile::class, [$validatedField => $brokenRule])->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

}
