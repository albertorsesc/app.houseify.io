<?php

namespace App\Http\Controllers\Web\Businesses;

use App\Models\Businesses\Business;
use App\Http\Controllers\Controller;
use App\Http\Resources\Businesses\BusinessResource;

class BusinessController extends Controller
{
    public function __invoke (Business $business)
    {
        return view('businesses.show', [
            'business' => new BusinessResource($business)
        ]);
    }
}
