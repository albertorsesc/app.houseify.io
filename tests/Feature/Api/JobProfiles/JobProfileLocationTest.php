<?php

namespace Tests\Feature\Api\JobProfiles;

use App\Models\JobProfiles\JobProfile;
use Illuminate\Support\Arr;
use Tests\JobProfileTestCase;
use Database\Seeders\{StateSeeder, CountrySeeder};

class JobProfileLocationTest extends JobProfileTestCase
{
    protected function setUp () : void
    {
        parent::setUp();
        $this->signIn();
        $this->loadSeeders([
            CountrySeeder::class,
            StateSeeder::class
        ]);
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['POST' => '/api/job-profiles/{jobProfile}/location']
     */
    public function store_a_job_profile_location()
    {
        $jobProfile = $this->create(JobProfile::class);
        $jobProfileLocation = $this->makeJobProfileLocation($jobProfile);

        $response = $this->postJson(
            route('api.job-profiles.location.store', $jobProfile),
            Arr::except($jobProfileLocation->toArray(), [
                'locationable_id', 'locationable_type'
            ])
        );
        $response->assertCreated();
        $response->assertJson([
            'data' => [
                'address' => $jobProfile->fresh()->location->address
            ]
        ]);

        $this->assertDatabaseHas('locations', $jobProfile->fresh()->location->toArray());
    }

    /**
     * @test
     * @throws \Throwable
     * @endpoint ['PUT' => '/api/jobProfiles/{jobProfile}/{location}']
     */
    public function update_an_job_profile_location()
    {
        $jobProfile = $this->create(JobProfile::class);
        $jobProfileLocation = $this->createJobProfileLocation($jobProfile);
        $jobProfileLocationData = $this->makeJobProfileLocation($jobProfile);

        $response = $this->putJson(
            route('api.job-profiles.location.update', $jobProfile),
            Arr::except($jobProfileLocationData->toArray(), [
                'locationable_id', 'locationable_type'
            ])
        );
        $response->assertOk();
        $response->assertJson(['data' => ['address' => $jobProfileLocationData->address]]);

        $this->assertDatabaseHas('locations', $jobProfileLocationData->toArray());
    }
}
