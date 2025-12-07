<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiresource('/posts', PostController::class);
    Route::post('/logout', [ApiController::class, 'logout']);
});
Route::apiresource('/categories', CategoryController::class);
Route::apiresource('/products', ProductController::class);
// Route::put('/category/{id}', [ProductController::class, 'update']);
