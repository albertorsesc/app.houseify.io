<?php

namespace App\Http\Controllers\Api\JobProfiles\Actions;

use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Http\Request;

class PublishController extends Controller
{
    public function __invoke(JobProfile $jobProfile)
    {
        $this->authorize('update', $jobProfile);

        $jobProfile->toggle();
    }
}
