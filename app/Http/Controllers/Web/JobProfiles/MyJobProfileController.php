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
        return view('job-profiles.show', [
            'jobProfile' => new JobProfileResource(
                $jobProfile->load([
                    'likes:id,likeable_type,likeable_id',
                    'user:id,first_name,last_name',
                    'location.state:id,name'
                ])
            )
        ]);
    }

    public function display (JobProfile $jobProfile)
    {
        return view('job-profiles.guests.show', [
            'jobProfile' => new JobProfileResource(
                $jobProfile->load([
                    'likes:id,likeable_type,likeable_id',
                    'user:id,first_name,last_name',
                    'location.state:id,name'
                ])
            )
        ]);
    }

}
