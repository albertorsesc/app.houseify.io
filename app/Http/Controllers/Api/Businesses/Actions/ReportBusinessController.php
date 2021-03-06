<?php

namespace App\Http\Controllers\Api\Businesses\Actions;

use App\Http\Controllers\Controller;
use App\Models\Businesses\Business;
use Illuminate\Http\Request;

class ReportBusinessController extends Controller
{
    public function __invoke(
        Request $request,
        Business $business
    )
    {
        $business->report($request->all());
    }
}
