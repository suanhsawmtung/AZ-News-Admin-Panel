<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;

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

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);
Route::get('category',[CategoryController::class,'category']);
Route::get('allPost',[PostController::class,'allPost']);
Route::post('search',[PostController::class,'search']);
Route::post('searchCategory',[CategoryController::class,'searchCategory']);
Route::get('postDetails/{id}',[PostController::class,'postDetails']);
Route::post('viewCount',[PostController::class,'viewCount']);
Route::post('postComment',[PostController::class,'postComment']);
Route::post('reactLove',[PostController::class,'reactLove']);
// Route::post('showReact',[PostController::class,'showReact']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

// });
