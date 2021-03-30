<?php

namespace App\Http\Controllers\Web\Properties;

use App\Models\Properties\Property;
use App\Http\Controllers\Controller;
use App\Http\Resources\Properties\PropertyResource;

class PropertyController extends Controller
{
    public function __invoke (Property $property)
    {
        return view('properties.show', [
            'property' => new PropertyResource(
                $property->load([
                    'media',
                    'seller:id',
                    'location.state',
                    'propertyFeature',
                    'propertyCategory.propertyType',
                ])
            )
        ]);
    }

}
