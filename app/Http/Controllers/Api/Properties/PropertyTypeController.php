<?php

namespace App\Http\Controllers\Api\Properties;

use App\Models\Properties\PropertyType;

class PropertyTypeController
{
    public function __invoke () : \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => PropertyType
                ::query()
                ->select(['id', 'display_name'])
                ->orderBy('id')
                ->get()
        ]);
    }
}
