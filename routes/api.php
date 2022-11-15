<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\Api\ArticuloController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'posts','middleware' => 'auth:sanctum'], function() {
    Route::get('/', [PostController::class,'index']);
    Route::post('add', [PostController::class,'add']);
    Route::post('update/{id}', [PostController::class,'update']);
    Route::get('edit/{id}', [PostController::class,'edit']);
    Route::delete('delete/{id}', [PostController::class,'delete']);
});
Route::group(['prefix' => 'articulos','middleware' => 'auth:sanctum'], function() {
    Route::get('/', [ArticuloController::class,'index']);
    Route::post('add', [ArticuloController::class,'add']);
    Route::post('update/{id}', [ArticuloController::class,'update']);
    Route::get('edit/{id}', [ArticuloController::class,'edit']);
    Route::delete('delete/{id}', [ArticuloController::class,'delete']);
});
