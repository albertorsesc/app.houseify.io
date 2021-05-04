<?php

namespace App\Http\Controllers\Api\Properties;

use App\Events\Properties\NewPropertyCreated;
use App\Models\Properties\Property;
use App\Http\Controllers\Controller;
use App\Http\Requests\Properties\PropertyRequest;
use App\Http\Resources\Properties\PropertyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PropertyController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return PropertyResource::collection(
            Property::query()
                    ->isPublished()
                    ->with([
                        'media',
                        'interests',
                        'seller:id',
                        'location.state',
                        'propertyFeature',
                        'propertyCategory.propertyType',
                    ])
                    ->orderBy('updated_at', 'desc')
                    ->paginate(12)
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
            tap($property, function ($model) use ($request) {
                $model->title = $request->title;
                $model->price = $request->price;
                $model->business_type = $request->business_type;
                $model->property_category_id = $request->property_category_id;
                $model->phone = $request->phone;
                $model->email = $request->email;
                $model->comments = $request->comments;
                $model->update();
            })->load([
                    'propertyCategory.propertyType',
                    'location.state',
                    'interests',
                    'seller:id'
                ])
        );
    }

    public function destroy(Property $property)
    {
        $this->authorize('update', $property);

        $property->delete();

        return response([], 204);
    }
}
