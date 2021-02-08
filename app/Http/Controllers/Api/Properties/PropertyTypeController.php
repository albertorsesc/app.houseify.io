<?php

namespace App\Http\Controllers\Api\Properties;

use App\Models\Properties\PropertyType;

class PropertyTypeController
{
    public function __invoke ()
    {
        return response()->json([
            'data' => PropertyType::query()
                                  ->orderBy('id')
                                  ->get()
        ]);
    }
}
