<?php

    use App\Http\Controllers\Web\Properties\PropertyController;
    use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('inicio', 'dashboard')->name('dashboard');
    Route::view('propiedades', 'properties.index')->name('web.properties.index');
    Route::view('propiedades/crear', 'properties.create')->name('web.properties.create');
    Route::get('propiedades/{property:slug}', PropertyController::class)->name('web.properties.show');

    Route::view('directorio-de-negocios', 'businesses.index')->name('web.businesses.index');
    Route::view('directorio-de-negocios/un-negocio', 'businesses.show')->name('web.businesses.show');

});
