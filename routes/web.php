<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\FacebookLoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return redirect('/inicio');
});

Route::get('/auth/login/{driver}/redirect', [\App\Http\Controllers\Auth\SocialLoginController::class, 'redirectToProvider'])->name('social-login.redirect');
Route::get('/auth/login/{driver}/callback', [\App\Http\Controllers\Auth\SocialLoginController::class, 'handleProviderCallback'])->name('social-login.callback');

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
//        \Intervention\Image\Facades\Image::make('img/forum.png')
//                                         ->filter(new \App\Models\Concerns\InterventionImage\Filters\MediumFilter())
//                                         ->save('img/forum1.png');
//    });
