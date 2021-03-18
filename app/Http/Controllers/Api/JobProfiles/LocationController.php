<?php

namespace App\Http\Controllers\Api\JobProfiles;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(LocationRequest $request, JobProfile $jobProfile) : JsonResponse
    {
        $jobProfile->location()->create($request->all());

        $jobProfile->load('location.state');

        return response()->json([
            'data' => new LocationResource($jobProfile->location)
        ], 201);
    }

    public function update(LocationRequest $request, JobProfile $jobProfile) : LocationResource
    {
        $jobProfile->location()->update($request->all());

        $jobProfile->load('location.state');

        return new LocationResource($jobProfile->location);
    }
}
