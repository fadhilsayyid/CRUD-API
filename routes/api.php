<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\LoginController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::post('products', [ProductController::class, 'store']);
Route::put('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);

Route::get('user', [LoginController::class, "getUser"]);
Route::post('add-user', [LoginController::class, "addUser"]);
Route::post('login', [LoginController::class, "login"]);
Route::middleware('auth:api')->group(function(){
    Route::get('profile', [LoginController::class, "profile"]);
});
Route::get('delete/{id}', [LoginController::class, "delete"]);
