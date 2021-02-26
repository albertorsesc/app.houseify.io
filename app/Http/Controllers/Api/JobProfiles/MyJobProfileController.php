<?php

namespace App\Http\Controllers\Api\JobProfiles;

use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;
use App\Http\Resources\JobProfiles\JobProfileResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MyJobProfileController extends Controller
{
    public function __invoke () : AnonymousResourceCollection
    {
        $jobProfile = JobProfile::where('user_id', auth()->id())->with('user')->get();

        return JobProfileResource::collection(
            $jobProfile
        );
    }
}
