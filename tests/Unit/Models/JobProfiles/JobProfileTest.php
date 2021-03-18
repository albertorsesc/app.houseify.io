<?php

namespace Tests\Unit\Models\JobProfiles;

use App\Models\Location;
use App\Models\User;
use Database\Seeders\CountrySeeder;
use Database\Seeders\StateSeeder;
use Tests\JobProfileTestCase;
use Tests\TestCase;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobProfileTest extends JobProfileTestCase
{
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

    /**
     *   @test
     *   @throws \Throwable
     */
    public function job_profile_has_one_location()
    {
        $this->loadSeeders([
            CountrySeeder::class,
            StateSeeder::class,
        ]);
        $this->signIn();
        $jobProfile = $this->create(JobProfile::class);
        $this->createJobProfileLocation($jobProfile);

        $this->assertInstanceOf(Location::class, $jobProfile->fresh()->location);
    }
}
