<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use App\Models\Properties\PropertyType;
use App\Http\Resources\Properties\PropertyCategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PropertyCategoriesByPropertyTypeController extends Controller
{
    public function __invoke (PropertyType $propertyType) : AnonymousResourceCollection
    {
        return PropertyCategoryResource::collection(
            $propertyType->propertyCategories->load('propertyType')
        );
    }
}
