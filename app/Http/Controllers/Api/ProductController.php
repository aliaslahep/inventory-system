<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * GET /api/products
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        
        $products = Product::with('categories')->latest()->paginate(10);
        
        return ProductResource::collection($products);
    }

    /**
     * GET /api/products/{id}
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \App\Http\Resources\ProductResource
     */
    public function show(Product $product)
    {

        return new ProductResource($product->load('categories'));
    }

    /**
     * POST /api/products
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \App\Http\Resources\ProductResource
     */
    public function store(ProductRequest $request)
    {
        // Create product from validated data
        $product = Product::create($request->validated());

        // Attach categories if provided
        if ($request->has('category_ids')) {
            $product->categories()->sync($request->category_ids);
        }

        // Return JSON response using API Resource
        return response()->json([
            'status'  => true,
            'message' => 'Product created successfully',
            'data'    => new ProductResource($product->load('categories')),
        ], 201); // HTTP_CREATED
    }

    /**
     * PUT /api/products/{id}
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \App\Http\Resources\ProductResource
     */
   public function update(ProductRequest $request, Product $product)
    {
        
        $product->update($request->validated());

        // Sync categories if provided
        if ($request->has('category_ids')) {
            $product->categories()->sync($request->category_ids);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Product updated successfully',
            'data'    => new ProductResource($product->load('categories')),
        ], 200); // HTTP_OK
    }


    /**
     * DELETE /api/products/{id}
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Product deleted successfully',
            'data'    => null,
        ], 200); // or 204 but 200 preferred for frontend messages
    }
}
