<?php

namespace App\Http\Controllers\Api\Properties\Actions;

use App\Models\Properties\Property;
use App\Http\Controllers\Controller;

class PublishController extends Controller
{
    public function __invoke(Property $property)
    {
        $this->authorize('update', $property);

        $property->toggle();
    }
}
