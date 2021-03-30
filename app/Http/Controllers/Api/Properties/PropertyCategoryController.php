<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use App\Models\Properties\PropertyCategory;
use App\Http\Resources\Properties\PropertyCategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PropertyCategoryController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return PropertyCategoryResource::collection(
            PropertyCategory
                ::query()
                ->select(['id', 'display_name', 'property_type_id'])
                ->with('propertyType:id,display_name')
                ->orderBy('display_name')
                ->get()
        );
    }
}
