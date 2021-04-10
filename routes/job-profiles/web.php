<?php

    use App\Http\Controllers\Web\JobProfiles\Actions\UploadPhotoController;
    use App\Http\Controllers\Web\JobProfiles\MyJobProfileController;

    Route::get('tecnicos-y-profesionistas/{jobProfile}', MyJobProfileController::class)->name('web.job-profiles.show');

    Route::middleware('prevent-back-history')->group(function () {
        Route::put(
            'job-profiles/{jobProfile:uuid}/image',
            UploadPhotoController::class
        )->name('job-profiles.photo.store');
    });

