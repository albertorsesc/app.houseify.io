<?php

namespace App\Http\Controllers\Web\JobProfiles;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobProfiles\JobProfileResource;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Http\Request;

class JobProfileController extends Controller
{
    public function __invoke (JobProfile $jobProfile)
    {
        return view('job-profiles.show', [
            'jobProfile' => new JobProfileResource(
                $jobProfile->load([
                    'location.state',
                    'user:id',
                    'likes'
                ])
            )
        ]);
    }
}
