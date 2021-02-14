<?php

    use App\Http\Controllers\Api\Businesses\Actions\InterestBusinessController;
    use App\Http\Controllers\Api\Businesses\BusinessController;
    use App\Http\Controllers\Api\Businesses\MyBusinessController;
    use App\Http\Controllers\Api\ConstructionCategoryController;
    use App\Http\Controllers\Api\CountryController;
    use App\Http\Controllers\Api\Properties\Actions\InterestPropertyController;
    use App\Http\Controllers\Api\Properties\Actions\PublishController;
    use App\Http\Controllers\Api\Properties\BusinessTypeController;
    use App\Http\Controllers\Api\Properties\LocationController;
    use App\Http\Controllers\Api\Properties\MyInterestedPropertiesController;
    use App\Http\Controllers\Api\Properties\MyPropertyController;
    use App\Http\Controllers\Api\Properties\PropertyCategoriesByPropertyTypeController;
    use App\Http\Controllers\Api\Properties\PropertyCategoryController;
    use App\Http\Controllers\Api\Properties\PropertyController;
    use App\Http\Controllers\Api\Properties\PropertyFeatureController;
    use App\Http\Controllers\Api\Sepomex\CityByStateController;
    use App\Http\Controllers\Api\Sepomex\NeighborhoodByCityController;
    use App\Http\Controllers\Api\StateController;
    use App\Http\Controllers\Api\SuggestionController;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Api\Properties\PropertyTypeController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::name('api.')->group(function () {
        Route::get('property-types', PropertyTypeController::class)->name('property-types.index');
        Route::get('property-categories', [PropertyCategoryController::class, 'index'])->name('property-categories.index');
        Route::get('business-types', BusinessTypeController::class)->name('business-types.index');
        Route::get('countries', CountryController::class)->name('countries.index');
        Route::get('states', StateController::class)->name('states.index');
        Route::get('construction-categories', ConstructionCategoryController::class)->name('construction-categories.index');
        Route::get('states/{state}/cities', CityByStateController::class)->name('states.cities.index');
        Route::get('cities/{city}/neighborhoods', NeighborhoodByCityController::class)->name('cities.neighborhoods.index');

        Route::get(
            'property-types/{propertyType}/property-categories',
            PropertyCategoriesByPropertyTypeController::class
        )->name('property-types.property-categories');

        Route::post('properties/{property:slug}/location', [LocationController::class, 'store'])->name('properties.location.store');
        Route::put('properties/{property:slug}/location', [LocationController::class, 'update'])->name('properties.location.update');

        Route::post('properties/{property:slug}/features', [PropertyFeatureController::class, 'store'])->name('properties.features.store');
        Route::put('properties/{property:slug}/features', [PropertyFeatureController::class, 'update'])->name('properties.features.update');

        Route::put('properties/{property:slug}/toggle', PublishController::class)->name('properties.toggle');

        Route::post('properties/{property:slug}/interested', [InterestPropertyController::class, 'store'])->name('properties.interested');
        Route::delete('properties/{property:slug}/uninterested', [InterestPropertyController::class, 'destroy'])->name('properties.uninterested');

        Route::post('businesses/{business:slug}/location', [\App\Http\Controllers\Api\Businesses\LocationController::class, 'store'])->name('businesses.location.store');
        Route::put('businesses/{business:slug}/location', [\App\Http\Controllers\Api\Businesses\LocationController::class, 'update'])->name('businesses.location.update');

        Route::post('businesses/{business:slug}/interested', [InterestBusinessController::class, 'store'])->name('businesses.interested');
        Route::delete('businesses/{business:slug}/uninterested', [InterestBusinessController::class, 'destroy'])->name('businesses.uninterested');

        Route::put('businesses/{business:slug}/toggle', \App\Http\Controllers\Api\Businesses\Actions\PublishController::class)->name('businesses.toggle');

        Route::get('me/properties', MyPropertyController::class)->name('me.properties');
        Route::get('me/properties/interested', MyInterestedPropertiesController::class)->name('me.properties.interested');
        Route::get('me/businesses', MyBusinessController::class)->name('me.businesses');
//        Route::get('me/properties/interested', MyInterestedPropertiesController::class)->name('me.properties.interested');

        Route::apiResources([
            'properties' => PropertyController::class,
            'businesses' => BusinessController::class,
        ]);
    });
});
