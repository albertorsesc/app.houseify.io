<?php

namespace App\Http\Controllers\Api\Businesses\Actions;

use App\Http\Controllers\Controller;
use App\Models\Businesses\Business;
use Illuminate\Http\Request;

class PublishController extends Controller
{
    public function __invoke(Business $business)
    {
        $this->authorize('update', $business);

        $business->toggle();
    }
}
