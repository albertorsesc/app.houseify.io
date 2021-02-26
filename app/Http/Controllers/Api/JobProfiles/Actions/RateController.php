<?php

namespace App\Http\Controllers\Api\JobProfiles\Actions;

use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function update(Request $request, JobProfile $jobProfile)
    {
        dd($request->all());
    }
}
