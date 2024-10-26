<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['api']
], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });
    Route::group(['prefix' => '/company'], function () {
        Route::resource('', CompanyController::class);
        Route::get('/list_address/{id}', [CompanyController::class, 'addresses']);
        Route::get('/default_address/{id}', [CompanyController::class, 'defaultAddress']);
        Route::get('/assets/{id}', [CompanyController::class, 'assets']);
    });

    Route::resource('/category', CategoryController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/store', StoreController::class);

    // Route::group(['prefix' => '/user'], function () {
    //     Route::resource('', UserController::class);
    //     // Route::put('/{id}', [UserController::class, 'update']);
    //     Route::get('/list', [UserController::class, 'getUserByRole']);
    //     Route::group(['prefix' => '/password'], function () {
    //         Route::post('/request', [UserController::class, 'requestOTP']);
    //         Route::post('/reset', [UserController::class, 'resetPassword']);
    //     });
    // });

    // Route::group(['prefix' => '/address'], function () {
    //     Route::resource('', AddressController::class);
    //     Route::put('/set_default/{id}', [AddressController::class, 'setDefault']);
    // });

    Route::group(['prefix' => '/products'], function () {
        // No authentication required for GET requests
        Route::post('get_products', [ProductController::class, 'getProducts']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::get('/publish/{id}', [ProductController::class, 'publish']);
        Route::get('/unpublish/{id}', [ProductController::class, 'unPublish']);
        Route::get('/get_product_by_slug/{slug}', [ProductController::class, 'getProductBySlug']);
    });

    Route::group(['prefix' => '/products', 'middleware' => 'auth:api'], function () {
        // Authentication required for non-GET routes
        Route::post('', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'delete']);
        Route::post('/get_products_by_params', [ProductController::class, 'getProductsByParams']);
    });

    // Route::post('/test', [ProductController::class, 'test']);
});