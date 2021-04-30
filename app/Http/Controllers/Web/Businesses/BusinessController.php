<?php

namespace App\Http\Controllers\Web\Businesses;

use Carbon\Carbon;
use App\Models\Businesses\Business;
use App\Http\Controllers\Controller;
use App\Http\Resources\Businesses\BusinessResource;

class BusinessController extends Controller
{
    public function show (Business $business)
    {
        return view('businesses.show', [
            'business' => new BusinessResource(
                $business->load([
                    'location.state',
                    'owner:id',
                    'likes:id,likeable_type,likeable_id,liked,liked_by',
                    'interests:id,interestable_type,interestable_id,interested_by'
                ])
            ),
            'likes' => [
                'like_count' => $likeCount = $business->likes()->count(),
                'last_like_at' => $likeCount > 0 ? Carbon::parse($business->likes()->latest()->first()->created_at)->toFormattedDateString() : null,
            ],
            'interests' => [
                'interest_count' => $interestCount = $business->interests()->count(),
                'last_interest_at' => $interestCount > 0 ? Carbon::parse($business->interests()->latest()->first()->created_at)->toFormattedDateString() : null,
            ],
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
