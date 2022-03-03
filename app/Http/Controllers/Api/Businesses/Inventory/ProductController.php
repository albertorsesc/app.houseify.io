<?php

namespace App\Http\Controllers\Api\Businesses\Inventory;

use Illuminate\Http\JsonResponse;
use App\Models\Businesses\Business;
use App\Http\Controllers\Controller;
use App\Models\Businesses\Inventory\Product;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Businesses\ProductRequest;
use App\Http\Resources\Businesses\Inventory\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(Business $business) : AnonymousResourceCollection
    {
        $products = $business->products()->with('business');
        if (request()->input('query')) {
            $products->where(
                'name',
                'LIKE',
                '%' . request()->input('query') . '%'
            )->orWhere(
                'description',
                'LIKE',
                '%' . request()->input('query') . '%'
            );
        }

        return ProductResource::collection(
            $products->orderBy('name')->get()
        );
    }

    public function store(ProductRequest $request, Business $business) : JsonResponse
    {
        $this->authorize('update', $business);

        $product = $business->products()->create($request->all());
        $product->load('business');

        return response()->json([
            'data' => new ProductResource($product)
        ], Response::HTTP_CREATED);
    }

    public function update(ProductRequest $request, Business $business, Product $product) : ProductResource
    {
        $this->authorize('update', $business);

        $product->update($request->all());

        return new ProductResource(
            $product->load('business')
        );
    }

    public function destroy(Business $business, Product $product) : JsonResponse
    {
        $this->authorize('update', $business);

        $product->delete();

        return response()->json([], 204);
    }
}
