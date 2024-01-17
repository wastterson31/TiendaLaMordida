<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\AuthenticationSessionController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|

|
*/

// Ruths de recurses
Route::apiResource('v1/products', ProductController::class);
Route::apiResource('v1/orders', OrderController::class);
Route::apiResource('v1/categories', CategoryController::class);

Route::post('login', [AuthenticationSessionController::class, 'login']);
Route::post('logout', [AuthenticationSessionController::class, 'logout'])->middleware('auth:sanctum');

Route::post('register', [AuthenticationSessionController::class, 'register']);
Route::get('v1/UserPedido', [IndexController::class, 'ShowUserPedido']);
Route::get('Home', [IndexController::class, 'ShowHome'])->name('Home');
//Route::get('/welcome', [AdminController::class, 'ShowAdmin'])->name('Admin');

//obtener productos por categoría
Route::get('v1/categories/{id}/products', [CategoryController::class, 'getProductsByCategory']);
Route::get('v1/user/{id}/orders', [OrderController::class, 'getOrdersByUser']);
