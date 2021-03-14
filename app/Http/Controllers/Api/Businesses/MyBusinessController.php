<?php

namespace App\Http\Controllers\Api\Businesses;

use App\Http\Controllers\Controller;
use App\Http\Resources\Businesses\BusinessResource;

class MyBusinessController extends Controller
{
    public function __invoke ()
    {
        return BusinessResource::collection(
            auth()->user()->businesses->load(['interests', 'location.state'])
        );
    }
}
