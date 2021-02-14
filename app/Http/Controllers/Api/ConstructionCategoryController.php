<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstructionCategoryController extends Controller
{
    public function __invoke ()
    {
        return response()->json([
            'data' => collect(config('houseify.construction_categories'))->toArray()
        ]);
    }
}
