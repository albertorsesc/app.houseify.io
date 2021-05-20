<?php

use App\Http\Controllers\Auth\FacebookLoginController;
use App\Http\Controllers\Auth\GoogleLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuggestionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return redirect('/inicio');
});

Route::get('/auth/login/facebook/redirect', [FacebookLoginController::class, 'redirectToProvider'])->name('facebook.redirect');
Route::get('/auth/login/facebook/callback', [FacebookLoginController::class, 'handleProviderCallback'])->name('facebook.callback');

Route::get('/auth/login/google/redirect', [GoogleLoginController::class, 'redirectToProvider'])->name('google.redirect');
Route::get('/auth/login/google/callback', [GoogleLoginController::class, 'handleProviderCallback'])->name('google.callback');

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

    Route::view('novedades', 'updates.roadmap')->name('web.roadmap.index');
});

//    Route::get('resize', function () {
//        \Intervention\Image\Facades\Image::make('img/undraw_location_review_dmxd.png')
//                                         ->filter(new \App\Models\Concerns\InterventionImage\Filters\MediumFilter())
//                                         ->save('img/business_location_1.png');
//    });
