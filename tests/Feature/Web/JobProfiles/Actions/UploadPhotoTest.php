<?php

namespace Tests\Feature\Web\JobProfiles\Actions;

use App\Models\JobProfiles\JobProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadPhotoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     */
    public function job_profile_user_can_upload_a_profile_photo()
    {
        \Storage::fake();
        $this->signIn();

        $jobProfile = $this->create(JobProfile::class);
        $photo = [
            'photo' => UploadedFile::fake()->image('profile-photo.jpeg', 1, 1)
        ];

        $response = $this->putJson(route('job-profiles.photo.store', $jobProfile), $photo);
        $response->assertRedirect(route('web.job-profiles.show', $jobProfile));

        $this->assertTrue(isset($jobProfile->fresh()->photo));
        \Storage::assertExists($jobProfile->photo);
    }
}
