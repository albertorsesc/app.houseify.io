<?php

    use App\Http\Controllers\Web\JobProfiles\Actions\UploadPhotoController;
    use App\Http\Controllers\Web\JobProfiles\JobProfileController;
    use App\Http\Controllers\Web\JobProfiles\MyJobProfileController;

    Route::middleware(['auth:sanctum', 'prevent-back-history'])->group(function () {
        Route::get('tecnicos-y-profesionistas/{jobProfile}', [MyJobProfileController::class, 'show'])->name('web.job-profiles.show');

        Route::put(
            'job-profiles/{jobProfile:uuid}/image',
            UploadPhotoController::class
        )->name('job-profiles.photo.store');

        Route::get('tecnicos-y-profesionales/{jobProfile:uuid}', [JobProfileController::class, 'show'])->name('web.job-profiles.show');
    });

    Route::get('i/tecnicos-y-profesionales/{jobProfile:uuid}', [JobProfileController::class, 'display'])->name('web.public.job-profiles.show');

