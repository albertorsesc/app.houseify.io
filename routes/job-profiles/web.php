<?php

    use App\Http\Controllers\Web\JobProfiles\Actions\UploadPhotoController;

    Route::middleware('prevent-back-history')->group(function () {
        Route::put(
            'job-profiles/{jobProfile:uuid}/image',
            UploadPhotoController::class
        )->name('job-profiles.photo.store');
    });

