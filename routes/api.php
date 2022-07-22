<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, ProductController};

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


Route::prefix('private')->group(function(){

    Route::post("register",[UserController::class,"register"]);
    Route::post("login",[UserController::class,"login"]);

    Route::group(["middleware"=>"auth:api"], function(){
        Route::get("list_products/{page?}",[ProductController::class,"list_products"]);
        Route::get("detail_products/{detail_product?}",[ProductController::class,"detail_products"]);
        Route::get("sorting_product/{column?}/{sort?}",[ProductController::class,"sorting_product"]);
        Route::get("list_category",[ProductController::class,"list_category"]);
    });
});

Route::prefix('public')->group(function(){
    Route::group(["middleware"=>"AccessPublicMiddleware"], function(){
        Route::get("list_products/{page?}",[ProductController::class,"list_products"]);
        Route::get("detail_products/{detail_product?}",[ProductController::class,"detail_products"]);
        Route::get("sorting_product/{column?}/{sort?}",[ProductController::class,"sorting_product"]);
        Route::get("list_category",[ProductController::class,"list_category"]);
    });
});
