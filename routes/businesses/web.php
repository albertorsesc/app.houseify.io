<?php

    use App\Http\Controllers\Web\Businesses\Actions\UploadLogoController;

    Route::middleware('prevent-back-history')->group(function () {
        Route::put(
            'businesses/{business:slug}/image',
            UploadLogoController::class
        )->name('businesses.logo.store');
    });
