<?php

namespace App\Http\Controllers\Api\Properties\Actions;

use App\Events\Reports\NewReportSubmitted;
use App\Models\Properties\Property;
use App\Http\Controllers\Controller;
use App\Events\Properties\PropertyReported;
use App\Http\Requests\Properties\ReportPropertyRequest;

class ReportPropertyController extends Controller
{
    public function __invoke(
        ReportPropertyRequest $request,
        Property $property
    )
    {
        $property->report($request->all());
    }
}
