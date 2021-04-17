<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use App\Http\Resources\Properties\PropertyResource;

class MyPropertyController extends Controller
{
    public function __invoke ()
    {
        return PropertyResource::collection(
            auth()
                ->user()
                ->properties
                ->load([
                    'media',
                    'seller:id',
                    'interests',
                    'location.state',
                    'propertyCategory.propertyType',
                ])
        );
    }
}
