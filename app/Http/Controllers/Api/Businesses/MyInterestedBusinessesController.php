<?php

namespace App\Http\Controllers\Api\Businesses;

use App\Http\Controllers\Controller;
use App\Http\Resources\Businesses\BusinessResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MyInterestedBusinessesController extends Controller
{
    public function __invoke () : AnonymousResourceCollection
    {
        return BusinessResource::collection(
            auth()->user()->interestedBusinesses()->get()
        );
    }
}
