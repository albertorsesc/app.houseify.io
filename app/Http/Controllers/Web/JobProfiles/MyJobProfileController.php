<?php

namespace App\Http\Controllers\Web\JobProfiles;

use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;
use App\Http\Resources\JobProfiles\JobProfileResource;

class MyJobProfileController extends Controller
{
    public function __invoke (JobProfile $jobProfile)
    {
        return view('job-profiles.show', [
            'jobProfile' => new JobProfileResource(
                $jobProfile->load([
                    'user'
                ])
            )
        ]);
    }
}
