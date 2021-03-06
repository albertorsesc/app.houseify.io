<?php

    use App\Http\Controllers\Api\Properties\PropertyController;
    use App\Http\Controllers\Api\Properties\LocationController;
    use App\Http\Controllers\Api\Properties\MyPropertyController;
    use App\Http\Controllers\Api\Properties\BusinessTypeController;
    use App\Http\Controllers\Api\Properties\PropertyTypeController;
    use App\Http\Controllers\Api\Properties\Actions\PublishController;
    use App\Http\Controllers\Api\Properties\PropertyFeatureController;
    use App\Http\Controllers\Api\Properties\PropertyCategoryController;
    use App\Http\Controllers\Api\Properties\Actions\ReportPropertyController;
    use App\Http\Controllers\Api\Properties\MyInterestedPropertiesController;
    use App\Http\Controllers\Api\Properties\Actions\InterestPropertyController;
    use App\Http\Controllers\Api\Properties\PropertyCategoriesByPropertyTypeController;

Route::get('property-types', PropertyTypeController::class)->name('property-types.index');
Route::get('property-categories', [PropertyCategoryController::class, 'index'])->name('property-categories.index');
Route::get('business-types', BusinessTypeController::class)->name('business-types.index');

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

    Route::post('properties/{property:slug}/report', ReportPropertyController::class)->name('properties.report');

    Route::get('me/properties', MyPropertyController::class)->name('me.properties');
    Route::get('me/properties/interested', MyInterestedPropertiesController::class)->name('me.properties.interested');

    Route::apiResource('properties', PropertyController::class);
