<?php

    use App\Http\Controllers\Api\JobProfiles\JobProfileController;
    use App\Http\Controllers\Api\JobProfiles\MyJobProfileController;
    use App\Http\Controllers\Api\JobProfiles\Actions\ReportJobProfileController;

    Route::get('me/job-profile', MyJobProfileController::class)->name('me.job-profile');

    Route::post('job-profiles/{jobProfile:slug}/report', ReportJobProfileController::class)->name('job-profiles.report');

    Route::apiResource('job-profiles', JobProfileController::class);
