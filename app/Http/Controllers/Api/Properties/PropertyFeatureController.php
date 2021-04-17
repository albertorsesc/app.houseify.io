<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Properties\{Property};
use App\Http\Requests\Properties\PropertyFeatureRequest;
use App\Http\Resources\Properties\PropertyFeatureResource;

class PropertyFeatureController extends Controller
{
    public function store(PropertyFeatureRequest $request, Property $property) : JsonResponse
    {
        $property->propertyFeature()->create($request->only('features'));

        $property->load('propertyFeature');

        return response()->json(new PropertyFeatureResource($property->propertyFeature), 201);
    }

    public function update(PropertyFeatureRequest $request, Property $property) : PropertyFeatureResource
    {
        $property->propertyFeature()->update($request->only('features'));

        $property->load('propertyFeature');

        return new PropertyFeatureResource($property->propertyFeature);
    }
}
