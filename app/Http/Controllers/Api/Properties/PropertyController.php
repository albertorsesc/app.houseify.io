<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use App\Http\Requests\Properties\PropertyRequest;
use App\Http\Resources\Properties\PropertyResource;
use App\Models\Properties\Property;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PropertyController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return PropertyResource::collection(
            Property::query()
                    ->isPublished()
                    ->with(['propertyCategory.propertyType'])
                    ->orderBy('updated_at', 'desc')
                    ->paginate(10)
        );
    }

    public function store(PropertyRequest $request) : PropertyResource
    {
        $property = Property::create($request->all());

        return new PropertyResource(
            $property->load('propertyCategory.propertyType')
        );
    }

    public function update(PropertyRequest $request, Property $property) : PropertyResource
    {
        $this->authorize('update', $property);

        return new PropertyResource(
            tap($property)
                ->update($request->all())
                ->load('propertyCategory.propertyType')
        );
    }

    public function destroy(Property $property)
    {
        $this->authorize('update', $property);

        $property->delete();

        return response([], 204);
    }
}
