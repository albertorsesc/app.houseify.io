<?php

namespace App\Http\Controllers\Api\Properties;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Properties\Concerns\BusinessType;

class BusinessTypeController extends Controller
{
    public function __invoke () : JsonResponse
    {
        return response()->json([
            'data' => BusinessType::all()
        ]);
    }
}
