<?php

namespace App\Http\Controllers\Api\Properties\Actions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Properties\PropertyResource;
use App\Models\Properties\Property;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke ()
    {
        $properties = Property::query()->with('propertyCategory');

        if (request()->has('title_or_comments')) {
            $properties->where(
                'title',
                'LIKE',
                '%' . request()->title_or_comments . '%'
            )->orWhere(
                'comments',
                'LIKE',
                '%' . request()->title_or_comments . '%'
            );
        }

        if (request()->has('from_price')) {
            $properties->where(
                'price', '>=', request()->from_price
            );
        }

        if (request()->has('to_price')) {
            $properties->where(
                'price', '<=', request()->to_price
            );
        }

        if (request()->has('business_types')) {
            $properties->whereIn(
                'business_type', request()->business_types
            );
        }

        if (request()->has('property_category')) {
            $properties
                ->whereHas('propertyCategory', function ($query) {
                    $query->where('display_name', request()->property_category);
                });
        }

        if (request()->has('property_type')) {
            $properties
                ->whereHas('propertyCategory', function ($propertyCategory) {
                    $propertyCategory->whereHas('propertyType', function ($propertyType) {
                        $propertyType->where('display_name', request()->property_type);
                    });
                });
        }

        return PropertyResource::collection($properties->get());
    }

}
