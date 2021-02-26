<?php

namespace App\Http\Controllers\Api\JobProfiles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;
use App\Http\Requests\JobProfiles\JobProfileRequest;
use App\Http\Resources\JobProfiles\JobProfileResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class JobProfileController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return JobProfileResource::collection(
            JobProfile
                ::query()
                ->isPublished()
                ->with('user')
                ->get()
        );
    }

    public function store(JobProfileRequest $request) : JobProfileResource
    {
        return new JobProfileResource(
            JobProfile::create(
                $request->all()
            )->load('user')
        );
    }

    public function update(JobProfileRequest $request, JobProfile $jobProfile) : JobProfileResource
    {
//        $this->authorize('update', $jobProfile);

        return new JobProfileResource(
            tap($jobProfile)->update($request->all())
        );
    }

    public function destroy(JobProfile $jobProfile)
    {
//        $this->authorize('update', $jobProfile);

        $jobProfile->delete();

        return response([], 204);
    }
}
