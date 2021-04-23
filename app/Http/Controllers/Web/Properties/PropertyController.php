<?php

namespace App\Http\Controllers\Web\Properties;

use App\Models\Properties\Property;
use App\Http\Controllers\Controller;
use App\Http\Resources\Properties\PropertyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyController extends Controller
{
    public function show (Property $property)
    {
        abort_unless(
            $property->status ||
            $property->wasCreatedByAuth('seller_id'),
            404,
        );

        return view('properties.show', [
            'property' => new PropertyResource(
                $property->load([
                    'seller:id',
                    'location.state',
                    'propertyFeature:id,features,property_id',
                    'media:id,mediable_type,mediable_id,file_name',
                    'propertyCategory.propertyType:id,display_name',
                    'propertyCategory:id,display_name,property_type_id',
                ])
            )
        ]);
    }

    public function display(Property $property)
    {
        abort_unless(
            $property->isPublished(),
            404,
        );

        return view('properties.guests.show', [
            'property' => new PropertyResource(
                $property->load([
                    'location',
                    'seller:id',
                    'location.state',
                    'propertyFeature:id,features,property_id',
                    'propertyCategory.propertyType:id,display_name',
                    'media:id,mediable_type,mediable_id,file_name',
                    'propertyCategory:id,display_name,property_type_id',
                ])
            )
        ]);
    }

}
