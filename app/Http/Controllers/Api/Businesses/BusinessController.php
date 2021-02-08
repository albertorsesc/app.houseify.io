<?php

namespace App\Http\Controllers\Api\Businesses;

use App\Models\Businesses\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\Businesses\BusinessRequest;
use App\Http\Resources\Businesses\BusinessResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BusinessController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return BusinessResource::collection(
            Business::query()
                    ->isPublished()
                    ->with('owner:id')
                    ->paginate(10)
        );
    }

    public function store(BusinessRequest $request) : BusinessResource
    {
        return new BusinessResource(Business::create($request->all()));
    }

    public function update(BusinessRequest $request, Business $business) : BusinessResource
    {
        $this->authorize('update', $business);

        return new BusinessResource(
            tap($business)->update($request->all())
        );
    }

    public function destroy(Business $business)
    {
        $this->authorize('update', $business);

        $business->delete();

        return response([], 204);
    }
}
