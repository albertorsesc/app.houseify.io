<?php

namespace Tests\Unit\Models\JobProfiles;

use App\Models\User;
use Tests\TestCase;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
    */
    public function job_profile_belongs_to_a_user()
    {
        $this->signIn();

        $jobProfile = $this->create(JobProfile::class);
        $this->assertInstanceOf(User::class, $jobProfile->user);
    }
}
