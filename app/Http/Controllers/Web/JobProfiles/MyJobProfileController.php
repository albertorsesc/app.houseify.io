<?php

namespace App\Http\Controllers\Web\JobProfiles;

use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;
use App\Http\Resources\JobProfiles\JobProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MyJobProfileController extends Controller
{
    public function show (JobProfile $jobProfile)
    {
        abort_unless(
            $jobProfile->status ||
            $jobProfile->wasCreatedByAuth('user_id'),
            404,
        );

        return view('job-profiles.show', [
            'jobProfile' => new JobProfileResource(
                $jobProfile->load([
                    'likes',
                    'location.state:id,name',
                    'user:id,first_name,last_name',
                ])
            )
        ]);
    }


}
