<?php

namespace App\Http\Controllers\Api\JobProfiles\Actions;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;

class LikeController extends Controller
{
    public function store(JobProfile $jobProfile) : JsonResponse
    {
        $jobProfile->liked();

        return response()->json([
            'data' => [
                'likes' => $jobProfile->likes,
                'likedByAuth' => $jobProfile->hasLikeByAuth()
            ]
        ]);
    }

    public function destroy(JobProfile $jobProfile) : JsonResponse
    {
        $jobProfile->disliked();

        return response()->json([
            'data' => [
                'likes' => $jobProfile->likes,
                'isLiked' => $jobProfile->hasLikeByAuth(),
            ]
        ]);
    }
}
