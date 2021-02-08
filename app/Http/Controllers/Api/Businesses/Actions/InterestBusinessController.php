<?php

namespace App\Http\Controllers\Api\Businesses\Actions;

use App\Models\Businesses\Business;
use App\Http\Controllers\Controller;

class InterestBusinessController extends Controller
{
    public function store(Business $business) : \Illuminate\Http\JsonResponse
    {
        $business->interested();

        return response()->json(['data' => $business->isInterested]);
    }

    public function destroy(Business $business) : \Illuminate\Http\JsonResponse
    {
        $business->uninterested();

        return response()->json(['data' => $business->isInterested]);
    }
}
