<?php

namespace App\Http\Controllers\Api\Businesses\Actions;

use App\Http\Controllers\Controller;
use App\Models\Businesses\Business;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Business $business) : \Illuminate\Http\JsonResponse
    {
        $business->liked();

        return response()->json([
            'data' => [
                'likes' => $business->likes()->get(['id', 'liked_by', 'liked']),
                'likedByAuth' => $business->hasLikeByAuth()
            ]
        ]);
    }

    public function destroy(Business $business) : \Illuminate\Http\JsonResponse
    {
        $business->disliked();

        return response()->json([
            'data' => [
                'likes' => $business->likes,
                'isLiked' => $business->hasLikeByAuth(),
            ]
        ]);
    }
}
