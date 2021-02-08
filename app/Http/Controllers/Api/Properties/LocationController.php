<?php

namespace App\Http\Controllers\Api\Properties;

use Illuminate\Http\JsonResponse;
use App\Models\Properties\Property;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    public function store(LocationRequest $request, Property $property) : JsonResponse
    {
        $property->location()->create($request->all());

        $property->load('location.state');

        return response()->json([
            'data' => new LocationResource($property->location)
        ], 201);
    }

    public function update(LocationRequest $request, Property $property) : LocationResource
    {
        $property->location()->update($request->all());

        $property->load('location.state');

        return new LocationResource($property->location);
    }
}
