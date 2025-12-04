<?php
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::apiResource('products', ProductController::class);
});
// Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');