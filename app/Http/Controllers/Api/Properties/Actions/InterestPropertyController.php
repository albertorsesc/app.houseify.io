<?php

namespace App\Http\Controllers\Api\Properties\Actions;

use App\Http\Controllers\Controller;
use App\Models\Properties\Property;
use Illuminate\Http\Request;

class InterestPropertyController extends Controller
{
    public function store(Property $property) : \Illuminate\Http\JsonResponse
    {
        $property->interested();

        return response()->json(['data' => $property->isInterested]);
    }

    public function destroy(Property $property) : \Illuminate\Http\JsonResponse
    {
        $property->uninterested();

        return response()->json(['data' => $property->isInterested]);
    }
}
