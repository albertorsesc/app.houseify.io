<?php

    use App\Http\Controllers\Web\Properties\PropertyController;

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('propiedades/{property:slug}', [PropertyController::class, 'show'])->name('web.properties.show');
    });

    Route::get('h/propiedades', [PropertyController::class, 'index'])->name('web.public.properties.index');
    Route::get('h/propiedades/{property:slug}', [PropertyController::class, 'display'])->name('web.public.properties.show');
