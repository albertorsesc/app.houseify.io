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
        $jobProfile = JobProfile::query()
                                ->where(
                                    'user_id',
                                    auth()->id()
                                )->with([
                                    'location.state',
                                    'user:id,first_name,last_name',
                                    'likes:id,likeable_type,likeable_id,liked,liked_by'
                                ])->get();

        return JobProfileResource::collection(
            $jobProfile
        );
    }
}
