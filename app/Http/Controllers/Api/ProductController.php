<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Response;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('categories')->latest()->paginate(10);
            return ProductResource::collection($products);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch products',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id) // Changed from Product $product to $id
    {
        try {
            $product = Product::with('categories')->find($id);
            
            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'No product found with the given ID',
                    'data' => null,
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Product retrieved successfully',
                'data' => new ProductResource($product),
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function store(ProductRequest $request)
    {
        try {
            
            $product = Product::create($request->validated());
            if ($request->has('category_ids')) {
                $product->categories()->sync($request->category_ids);
            }
            return response()->json([
                'status' => true,
                'message' => 'Product created successfully',
                'data' => new ProductResource($product->load('categories')),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(ProductRequest $request, $id) // Changed from Product $product to $id
    {
        try {
            $product = Product::find($id);
            
            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'No product found with the given ID',
                    'data' => null,
                ], 404);
            }

            $product->update($request->validated());
            
            if ($request->has('category_ids')) {
                $product->categories()->sync($request->category_ids);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully',
                'data' => new ProductResource($product->load('categories')),
            ], 200);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy($id) // Change from Product $product to $id
    {
        try {
            $product = Product::find($id);
            
            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'No product found with the given ID',
                    'data' => null,
                ], 404);
            }

            $product->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Product deleted successfully',
                'data' => null,
            ], 200);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
