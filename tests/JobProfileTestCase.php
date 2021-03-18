<?php

namespace Tests;

use App\Models\Location;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobProfileTestCase extends TestCase
{
    use RefreshDatabase;

    protected function setUp () : void
    {
        parent::setUp();
    }

    public function makeJobProfile($overrides = []) : array
    {
        return array_merge([
            'title' => 'Albanil con 15 anios de experiencia',
            'skills' => collect(config('job-profiles.skills'))->random(3)->toArray(),
            'birthdate_at' => now()->subDecades(rand(1, 4))->toDateTime(),
            'email' => 'albanil@construcciones.com',
            'phone' => '6862894998',
            'site' => 'https://albanil.com',
            'facebook_profile' => 'https://www.facebook.com/albanil',
            'bio' => 'Soy Albanil',
            'status' => true
        ], $overrides);
    }

    public function makeJobProfileLocation(JobProfile $jobProfile)
    {
        return $this->make(Location::class, [
            'locationable_id' => $jobProfile->id,
            'locationable_type' => get_class($jobProfile)
        ]);
    }

    public function createJobProfileLocation(JobProfile $jobProfile)
    {
        return $this->create(Location::class, [
            'locationable_id' => $jobProfile->id,
            'locationable_type' => get_class($jobProfile)
        ]);
    }
}
