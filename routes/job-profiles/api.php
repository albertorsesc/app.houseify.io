<?php

    use App\Http\Controllers\Api\JobProfiles\{Actions\LikeController,
        JobProfileController,
        LocationController,
        MyJobProfileController,
        Actions\ReportJobProfileController};

    Route::get('me/job-profile', MyJobProfileController::class)->name('me.job-profile');

    Route::post('job-profiles/{jobProfile:uuid}/location', [LocationController::class, 'store'])->name('job-profiles.location.store');
    Route::put('job-profiles/{jobProfile:uuid}/location', [LocationController::class, 'update'])->name('job-profiles.location.update');

    Route::post('job-profiles/{jobProfile:uuid}/report', ReportJobProfileController::class)->name('job-profiles.report');

    Route::put('job-profiles/{jobProfile:uuid}/toggle', \App\Http\Controllers\Api\JobProfiles\Actions\PublishController::class)->name('job-profiles.toggle');

    Route::post('job-profiles/{jobProfile:uuid}/like', [LikeController::class, 'store'])->name('job-profiles.likes.store');
    Route::delete('job-profiles/{jobProfile:uuid}/dislike', [LikeController::class, 'destroy'])->name('job-profiles.likes.destroy');

    Route::apiResource('job-profiles', JobProfileController::class);
