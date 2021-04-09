<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Admin API!
|
*/

Route::group(['middleware' => ['checkPassword', 'changeLang'], 'namespace' => 'Api\User', 'prefix' => 'v1/user'], function(){

    // route cycle auth
    Route::post('login', 'AuthController@login');
    Route::post('password-send-code', 'AuthController@password_send_code');
    Route::post('update-reset-password', 'AuthController@update_reset_password');
    Route::post('register', 'AuthController@register');

    // public routes
    Route::get('home', 'HomeController@home');
    Route::get('category/{slug}', 'CategoryController@products_in_category');
    Route::get('products/product-info/{slug}', 'ProductController@product_info');
    Route::get('vendor/product/{id}', 'ProductController@products_by_vendor');

    Route::group(['middleware' => 'checkToken:user-api'], function(){

        // routes user
        Route::get('info/{id}', 'UserController@info');
        Route::post('edit/{id}', 'UserController@edit');
        Route::post('change-password/{id}', 'UserController@change_password');

        // routes user favorate products 
        Route::get('favorates/index', 'FavorateController@index');
        Route::get('favorates/store/{product_id}', 'FavorateController@favorate');
        Route::get('favorates/delete/{product_id}', 'FavorateController@unfavorate');

        // routes user product cart
        Route::get('cart/index', 'CartController@index');
        Route::get('cart/store/{product_id}', 'CartController@store');
        Route::get('cart/delete/{product_id}', 'CartController@delete');

        
        // user payment routes
        Route::post('payments/process', 'PaymentController@processPayment');
        
        Route::get('logout', 'AuthController@logout');
    
    });

});
