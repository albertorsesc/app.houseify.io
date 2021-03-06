<?php

namespace App\Http\Controllers\Api\JobProfiles\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;

class ReportJobProfileController extends Controller
{
    public function __invoke(
        Request $request,
        JobProfile $jobProfile
    )
    {
        $jobProfile->report($request->all());
    }
}
