<?php

    use App\Http\Controllers\Web\JobProfiles\MyJobProfileController;
    use App\Models\Concerns\InterventionImage\Filters\SmallFilter;
    use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuggestionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Web\Businesses\BusinessController;
use App\Http\Controllers\Web\Properties\PropertyController;

Route::get('/', function () {
    return redirect('/inicio');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/inicio');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth:sanctum', 'verified', 'prevent-back-history'])->group(function () {

    Route::view('inicio', 'dashboard')->name('dashboard');
    Route::view('propiedades', 'properties.index')->name('web.properties.index');

    Route::view('directorio-de-negocios', 'businesses.index')->name('web.businesses.index');

    Route::view('tecnicos-y-profesionistas', 'job-profiles.index')->name('web.job-profiles.index');

    Route::view('sugerencias', 'suggestions')->name('web.suggestions.index');
    Route::post('suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');
});

//    Route::get('resize', function () {
//        \Intervention\Image\Facades\Image::make('img/undraw_location_review_dmxd.png')
//                                         ->filter(new \App\Models\Concerns\InterventionImage\Filters\MediumFilter())
//                                         ->save('img/business_location_1.png');
//    });
