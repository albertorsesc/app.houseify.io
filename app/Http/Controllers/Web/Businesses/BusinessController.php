<?php

namespace App\Http\Controllers\Web\Businesses;

use App\Models\Businesses\Business;
use App\Http\Controllers\Controller;
use App\Http\Resources\Businesses\BusinessResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessController extends Controller
{
    public function __invoke (Business $business)
    {
        return view('businesses.show', [
            'business' => new BusinessResource(
                $business->load([
                    'location.state',
                    'owner:id',
                    'likes'
                ])
            )
        ]);
    }

    public function show (Business $business)
    {
        return view('businesses.show', [
            'business' => new BusinessResource(
                $business->load([
                    'location.state',
                    'owner:id',
                    'likes:id,likeable_type,likeable_id,liked,liked_by'
                ])
            )
        ]);
    }

    public function display (Business $business)
    {
        return view('businesses.guests.show', [
            'business' => new BusinessResource(
                $business->load([
                    'owner:id',
                    'location.state:id,name',
                    'likes:id,likeable_type,likeable_id'
                ])
            )
        ]);
    }
}
