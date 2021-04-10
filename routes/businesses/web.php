<?php

    use App\Http\Controllers\Web\Businesses\BusinessController;
    use App\Http\Controllers\Web\Businesses\Actions\UploadLogoController;

    Route::middleware(['prevent-back-history', 'auth:sanctum'])->group(function () {
        Route::put(
            'businesses/{business:slug}/image',
            UploadLogoController::class
        )->name('businesses.logo.store');
    });

    Route::get('directorio-de-negocios/{business:slug}', BusinessController::class)->name('web.businesses.show');
