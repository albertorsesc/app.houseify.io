<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use App\Http\Requests\Properties\PropertyFeatureRequest;
use App\Http\Resources\Properties\PropertyFeatureResource;
use App\Models\Properties\PropertyFeature;
use Illuminate\Http\Request;

class PropertyFeatureController extends Controller
{
    public function index()
    {
        return PropertyFeatureResource::collection(
            PropertyFeature::with('property')->get()
        );
    }

    public function store(PropertyFeatureRequest $request)
    {
        return new PropertyFeatureResource(PropertyFeature::create($request->all()));
    }

    public function show(PropertyFeature $propertyFeature)
    {
        return new PropertyFeatureResource($propertyFeature);
    }

    public function update(PropertyFeatureRequest $request, PropertyFeature $propertyFeature)
    {
        $propertyFeature->update($request->except('property_id'));

        return new PropertyFeatureResource($propertyFeature);
    }

    public function destroy(PropertyFeature $propertyFeature)
    {
        $propertyFeature->delete();

        return response([], 204);
    }
}
