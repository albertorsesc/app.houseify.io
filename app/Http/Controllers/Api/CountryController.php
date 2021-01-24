<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function __invoke () : JsonResponse
    {
        return response()->json([
            'data' => Country::isSupported()->orderBy('name')->get()
        ]);
    }
}
