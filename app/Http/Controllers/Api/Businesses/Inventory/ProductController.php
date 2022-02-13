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
        return ProductResource::collection(
            $business->products()->with('business')->get()
        );
    }

    public function store(ProductRequest $request, Business $business) : JsonResponse
    {
        $product = $business->products()->create($request->all());
        $product->load('business');

        return response()->json([
            'data' => new ProductResource($product)
        ], Response::HTTP_CREATED);
    }

    public function update(ProductRequest $request, Business $business, Product $product) : ProductResource
    {
        $product = $business->products()->create($request->all());

        return new ProductResource(
            $product->load('business')
        );
    }

    public function destroy(Business $business, Product $product) : JsonResponse
    {
        $product->delete();

        return response()->json([], 204);
    }
}
