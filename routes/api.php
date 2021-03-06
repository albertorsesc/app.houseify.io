<?php

    use App\Http\Controllers\Api\Businesses\Actions\InterestBusinessController;
    use App\Http\Controllers\Api\Businesses\BusinessController;
    use App\Http\Controllers\Api\Businesses\MyBusinessController;
    use App\Http\Controllers\Api\ConstructionCategoryController;
    use App\Http\Controllers\Api\CountryController;
    use App\Http\Controllers\Api\JobProfiles\JobProfileController;
    use App\Http\Controllers\Api\JobProfiles\MyJobProfileController;
    use App\Http\Controllers\Api\JobProfiles\SkillController;
    use App\Http\Controllers\Api\Properties\Actions\InterestPropertyController;
    use App\Http\Controllers\Api\Properties\Actions\PublishController;
    use App\Http\Controllers\Api\Properties\Actions\ReportPropertyController;
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
    use Illuminate\Http\Request;
    use App\Http\Controllers\Api\Properties\PropertyTypeController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::name('api.')->group(function () {

        Route::get('countries', CountryController::class)->name('countries.index');
        Route::get('states', StateController::class)->name('states.index');
        Route::get('construction-categories', ConstructionCategoryController::class)->name('construction-categories.index');
        Route::get('states/{state}/cities', CityByStateController::class)->name('states.cities.index');
        Route::get('cities/{city}/neighborhoods', NeighborhoodByCityController::class)->name('cities.neighborhoods.index');


        //        Route::put('job-profiles.rate', [RateController::class, 'update'])->name('job-profiles.rate');
        Route::get('skills', SkillController::class)->name('skills.index');

    });
});
