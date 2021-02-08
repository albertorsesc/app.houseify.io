<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use App\Http\Resources\Properties\PropertyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MyInterestedPropertiesController extends Controller
{
    public function __invoke () : AnonymousResourceCollection
    {
        return PropertyResource::collection(
            auth()->user()->interestedProperties()->get()
        );
    }
}
