<?php

namespace App\Http\Controllers\Web\JobProfiles;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;
use App\Http\Resources\JobProfiles\JobProfileResource;

class JobProfileController extends Controller
{
    public function show(JobProfile $jobProfile)
    {
        return view('job-profiles.show', [
            'jobProfile' => new JobProfileResource(
                $jobProfile->load([
                    'likes',
                    'interests',
                    'location.state:id,name',
                    'user:id,first_name,last_name',
                ])
            ),
            'likes' => [
                'like_count' => $likeCount = $jobProfile->likes()->count(),
                'last_like_at' => $likeCount > 0 ? Carbon::parse($jobProfile->likes()->latest()->first()->created_at)->toFormattedDateString() : null,
            ],
            'interests' => [
                'interest_count' => $interestCount = $jobProfile->interests()->count(),
                'last_interest_at' => $interestCount > 0 ? Carbon::parse($jobProfile->interests()->latest()->first()->created_at)->toFormattedDateString() : null,
            ],
        ]);
    }

    public function display (JobProfile $jobProfile)
    {
        return view('job-profiles.guests.show', [
            'jobProfile' => new JobProfileResource(
                $jobProfile->load([
                    'location.state:id,name',
                    'user:id,first_name,last_name',
                ])
            )
        ]);
    }
}
