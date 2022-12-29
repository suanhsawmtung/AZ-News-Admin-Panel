<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    // Admin //

    // admin -> profile //
    Route::prefix('profile')->group(function(){
        Route::get('myProfilePage',[ProfileController::class,'myProfilePage'])->name('profile#myProfilePage');
        Route::post('updateMyData',[ProfileController::class,'updateMyData'])->name('profile#updateMyData');
        Route::get('passwordChangePage',[ProfileController::class,'passwordChangePage'])->name('profile#passwordChangePage');
        Route::post('changePassword',[ProfileController::class,'changePassword'])->name('profile#changePassword');
    });

    // admin -> category //
    Route::prefix('category')->group(function(){
        Route::get('categoryPage',[CategoryController::class,'categoryPage'])->name('category#categoryPage');
        Route::post('createCategory',[CategoryController::class,'createCategory'])->name('category#createCategory');
        Route::get('categoryEditPage/{id}',[CategoryController::class,'categoryEditPage'])->name('category#categoryEditPage');
        Route::post('editCategory/{id}',[CategoryController::class,'editCategory'])->name('category#editCategory');
        Route::get('deleteCategory/{id}',[CategoryController::class,'deleteCategory'])->name('category#deleteCategory');
    });

    // admin -> news //
    Route::prefix('news')->group(function(){
        Route::get('newsListPage',[NewsController::class,'newsListPage'])->name('news#newsListPage');
        Route::get('newsCreatePage',[NewsController::class,'newsCreatePage'])->name('news#newsCreatePage');
        Route::post('newsPostCreate',[NewsController::class,'newsPostCreate'])->name('news#newsPostCreate');
        Route::get('deleteNewsPost/{id}',[NewsController::class,'deleteNewsPost'])->name('news#deleteNewsPost');
        Route::get('newsPostEditPage/{id}',[NewsController::class,'newsPostEditPage'])->name('news#newsPostEditPage');
        Route::post('newsPostEdit',[NewsController::class,'newsPostEdit'])->name('news#newsPostEdit');
    });

    // admin -> user accounts //
    Route::prefix('account')->group(function(){
        Route::get('accountListPage',[AccountController::class,'accountListPage'])->name('account#accountListPage');
        Route::get('deleteAccount/{id}',[AccountController::class,'deleteAccount'])->name('account#deleteAccount');
    });
});
