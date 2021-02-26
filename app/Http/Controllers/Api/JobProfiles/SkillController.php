<?php

namespace App\Http\Controllers\Api\JobProfiles;

use App\Http\Controllers\Controller;
use App\Models\JobProfiles\JobProfile;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'data' => JobProfile::getSkills()
        ]);
    }
}
