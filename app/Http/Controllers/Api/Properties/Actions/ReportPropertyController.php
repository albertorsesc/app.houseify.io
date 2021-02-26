<?php

namespace App\Http\Controllers\Api\Properties\Actions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Properties\ReportPropertyRequest;
use App\Models\Properties\Property;
use Illuminate\Http\Request;

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
