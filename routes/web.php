<?php

    use App\Http\Controllers\Web\JobProfiles\MyJobProfileController;
    use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuggestionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Web\Businesses\BusinessController;
use App\Http\Controllers\Web\Properties\PropertyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/inicio');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('inicio', 'dashboard')->name('dashboard');
    Route::view('propiedades', 'properties.index')->name('web.properties.index');
    Route::get('propiedades/{property:slug}', PropertyController::class)->name('web.properties.show');

    Route::view('directorio-de-negocios', 'businesses.index')->name('web.businesses.index');
    Route::get('directorio-de-negocios/{business:slug}', BusinessController::class)->name('web.businesses.show');

    Route::get('tecnicos-y-profesionistas/{jobProfile}', MyJobProfileController::class)->name('web.job-profiles.show');
    Route::view('tecnicos-y-profesionistas', 'job-profiles.index')->name('web.job-positions.index');

    Route::view('sugerencias', 'suggestions')->name('web.suggestions.index');
    Route::post('suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');
});
