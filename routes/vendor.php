<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Vendor API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Vendor API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Vendor API!
|
*/

Route::group(['middleware' => ['checkPassword', 'changeLang'], 'namespace' => 'Api\Vendor', 'prefix' => 'v1/vendor'], function(){

    Route::post('login', 'AuthController@login');
    Route::post('password-send-code', 'AuthController@password_send_code');
    Route::post('update-reset-password', 'AuthController@update_reset_password');

    Route::group(['middleware' => 'checkToken:vendor-api'], function(){

        // routes vendor
        Route::get('info/{id}', 'VendorController@info');
        Route::post('edit/{id}', 'VendorController@edit');
        Route::post('change-password/{id}', 'VendorController@change_password');
        Route::get('state/{id}', 'VendorController@state');

        // routes product
        Route::get('products', 'ProductController@index');
        Route::get('products/create', 'ProductController@create');
        Route::post('products/store', 'ProductController@store');
        Route::get('products/edit/{id}', 'ProductController@edit');
        Route::post('products/update/{id}', 'ProductController@update');
        Route::post('products/price/{id}', 'ProductController@price');
        Route::post('products/stock/{id}', 'ProductController@stock');
        Route::post('products/images/{id}', 'ProductController@images');
        Route::get('products/show/{id}', 'ProductController@show');
        Route::get('products/activate/{id}', 'ProductController@activate');
        Route::get('products/deactivate/{id}', 'ProductController@deactivate');
        Route::get('products/delete/{id}', 'ProductController@delete');
        Route::post('products/lang-ar/{id}', 'ProductController@lang_ar');
        Route::post('products/lang-es/{id}', 'ProductController@lang_es');
        Route::get('products/special/{id}', 'ProductController@special');
        Route::get('products/unspecial/{id}', 'ProductController@unspecial');

        // routes order
        Route::get('orders', 'OrderController@index');
        Route::get('orders/show/{id}', 'OrderController@show');

        // routes attribute
        Route::get('attributes', 'AttributeController@index');
        Route::post('attributes/store', 'AttributeController@store');
        Route::get('attributes/edit/{id}', 'AttributeController@edit');
        Route::post('attributes/update/{id}', 'AttributeController@update');
        Route::get('attributes/delete/{id}', 'AttributeController@delete');
        Route::get('attributes/deactivate/{id}', 'AttributeController@deactivate');
        Route::get('attributes/activate/{id}', 'AttributeController@activate');
        Route::post('attributes/lang-ar/{id}', 'AttributeController@lang_ar');
        Route::post('attributes/lang-es/{id}', 'AttributeController@lang_es');

        // routes options
        Route::get('options', 'OptionController@index');
        Route::get('options/create', 'OptionController@create');
        Route::post('options/store', 'OptionController@store');
        Route::get('options/edit/{id}', 'OptionController@edit');
        Route::post('options/update/{id}', 'OptionController@update');
        Route::get('options/delete/{id}', 'OptionController@delete');
        Route::get('options/deactivate/{id}', 'OptionController@deactivate');
        Route::get('options/activate/{id}', 'OptionController@activate');
        Route::post('options/lang-ar/{id}', 'OptionController@lang_ar');
        Route::post('options/lang-es/{id}', 'OptionController@lang_es');

        // routes tag
        Route::get('tags', 'TagController@index');
        Route::post('tags/store', 'TagController@store');
        Route::get('tags/edit/{id}', 'TagController@edit');
        Route::post('tags/update/{id}', 'TagController@update');
        Route::get('tags/delete/{id}', 'TagController@delete');
        Route::get('tags/deactivate/{id}', 'TagController@deactivate');
        Route::get('tags/activate/{id}', 'TagController@activate');
        Route::post('tags/lang-ar/{id}', 'TagController@lang_ar');
        Route::post('tags/lang-es/{id}', 'TagController@lang_es');

        Route::get('logout', 'AuthController@logout');

    });

});