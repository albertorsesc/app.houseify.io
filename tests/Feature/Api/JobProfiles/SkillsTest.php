<?php

namespace Tests\Feature\Api\JobProfiles;

use Tests\TestCase;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SkillsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
    */
    public function authenticated_user_can_get_all_skills()
    {
        $this->signIn();

        $response = $this->getJson(route('api.skills.index'));
        $response->assertOk();
        $response->assertJson([
            'data' => JobProfile::getSkills()
        ]);
    }
}
