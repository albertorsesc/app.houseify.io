<?php

namespace App\Http\Controllers\Api\Businesses;

use App\Http\Controllers\Controller;
use App\Http\Resources\Businesses\BusinessResource;
use App\Models\Businesses\Business;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MyBusinessController extends Controller
{
    public function __invoke () : AnonymousResourceCollection
    {
        return BusinessResource::collection(
            Business::query()
                    ->where('owner_id', auth()->id())
                    ->with([
                        'interests',
                        'location.state',
                    ])
                    ->orderBy('created_at', 'DESC')
                    ->orderBy('updated_at', 'DESC')
                    ->get()
        );
    }
}
