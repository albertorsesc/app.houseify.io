<?php

namespace App\Http\Controllers\Api\JobProfiles;

use App\Http\Controllers\Controller;
use App\Http\Resources\JobProfiles\JobProfileResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MyInterestedJobProfileController extends Controller
{
    public function __invoke () : AnonymousResourceCollection
    {
        return JobProfileResource::collection(
            auth()->user()->interestedJobProfiles()->get()
        );
    }
}
