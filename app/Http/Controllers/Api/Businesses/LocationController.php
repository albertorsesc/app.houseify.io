<?php

namespace App\Http\Controllers\Api\Businesses;

use App\Models\Businesses\Business;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    public function store(LocationRequest $request, Business $business) : JsonResponse
    {
        $business->location()->create($request->all());

        $business->load('location.state');

        return response()->json([
            'data' => new LocationResource($business->location)
        ], 201);
    }

    public function update(LocationRequest $request, Business $business) : LocationResource
    {
        $business->location()->update(
            $request->all() +
            ['coordinates' => $business->location->getCoordinates()]
        );
        $business->touch();

        $business->load('location.state');

        return new LocationResource($business->location);
    }
}
