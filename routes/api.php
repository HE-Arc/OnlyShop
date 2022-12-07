<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ShopcartController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('items', ItemController::class);
Route::get('items/getUserItems/{user_id}', [ItemController::class, 'getUserItems'])->name('items.get-user-items');
Route::apiResource('images', ImageController::class);
Route::get('images/getItemImages/{item_id}', [ImageController::class, 'getItemImages'])->name('images.get-item-images');
Route::apiResource('users', UserController::class);
Route::post('shopcarts', [ShopcartController::class, 'storeShopCart'])->name('shopcarts.store-shop-cart');
Route::get('shopcarts/{id}', [ShopcartController::class, 'getShopCart'])->name('shopcrats.get-shop-sart');
Route::post('shopcarts/addItem', [ShopcartController::class, 'addItem'])->name('shopcarts.add-item');
Route::post('users/login', [UserController::class, 'login'])->name('users.login');
