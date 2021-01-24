<?php

namespace App\Http\Controllers\Api;

use App\Models\State;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    public function __invoke () : JsonResponse
    {
        return response()->json([
            'data' => State::with('country')
                           ->orderBy('name')
                           ->get()
        ]);
    }
}
