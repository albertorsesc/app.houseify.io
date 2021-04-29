<?php

namespace App\Http\Controllers\Api\JobProfiles\Actions;

use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function store(JobProfile $jobProfile) : \Illuminate\Http\JsonResponse
    {
        $jobProfile->interested();

        return response()->json(['data' => $jobProfile->isInterested]);
    }

    public function destroy(JobProfile $jobProfile) : \Illuminate\Http\JsonResponse
    {
        $jobProfile->uninterested();

        return response()->json(['data' => $jobProfile->isInterested]);
    }
}
