<?php

    use App\Http\Controllers\Api\CountryController;
    use App\Http\Controllers\Api\Properties\BusinessTypeController;
    use App\Http\Controllers\Api\Properties\LocationController;
    use App\Http\Controllers\Api\Properties\PropertyCategoriesByPropertyTypeController;
    use App\Http\Controllers\Api\Properties\PropertyCategoryController;
    use App\Http\Controllers\Api\Properties\PropertyController;
    use App\Http\Controllers\Api\Properties\PropertyFeatureController;
    use App\Http\Controllers\Api\StateController;
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
        Route::get(
            'property-types/{propertyType}/property-categories',
            PropertyCategoriesByPropertyTypeController::class
        )->name('property-types.property-categories');

        Route::post('properties/{property:slug}/location', [LocationController::class, 'store'])->name('properties.location.store');
        Route::put('properties/{property:slug}/location', [LocationController::class, 'update'])->name('properties.location.update');


        Route::apiResources([
            'properties' => PropertyController::class,
        ]);
        Route::apiResource(
            'property-features',
            PropertyFeatureController::class
        )->names('properties.features');
    });
});
