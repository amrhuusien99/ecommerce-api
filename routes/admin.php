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

    Route::group(['middleware' => ['checkPassword', 'changeLang'], 'namespace' => 'Api\Admin', 'prefix' => 'v1/admin'], function(){

        Route::post('login', 'AuthController@login');
        Route::post('password-send-code', 'AuthController@password_send_code');
        Route::post('update-reset-password', 'AuthController@update_reset_password');

        Route::group(['middleware' => 'checkToken:admin-api'], function(){

            //routes admin
            Route::get('index', 'AdminController@index')->name('admin/index');
            Route::get('create', 'AdminController@create');
            Route::post('store', 'AdminController@store');
            Route::get('info/{id}', 'AdminController@info');
            Route::get('edit/{id}', 'AdminController@edit');
            Route::post('update/{id}', 'AdminController@update');
            Route::post('change-password/{id}', 'AdminController@change_password');
            Route::get('delete/{id}', 'AdminController@delete');
            Route::get('activate/{id}', 'AdminController@activate')->name('admin/activate');
            Route::get('deactivate/{id}', 'AdminController@deactivate')->name('admin/deactivate');

            //routes role
            Route::get('roles', 'RoleController@index');
            Route::get('roles/create', 'RoleController@create');
            Route::post('roles/store', 'RoleController@store');
            Route::get('roles/edit/{id}', 'RoleController@edit');
            Route::post('roles/update/{id}', 'RoleController@update');
            Route::get('roles/show/{id}', 'RoleController@show');
            Route::get('roles/delete/{id}', 'RoleController@delete');

            /////////// routes vendor
            Route::get('vendors', 'VendorController@index');
            Route::post('vendors/store', 'VendorController@store');
            Route::get('vendors/delete/{id}', 'VendorController@delete');
            Route::get('vendors/deactivate/{id}', 'VendorController@deactivate');
            Route::get('vendors/activate/{id}', 'VendorController@activate');
            Route::get('vendors/special/{id}', 'VendorController@special');
            Route::get('vendors/unspecial/{id}', 'VendorController@unspecial');

            /////////// routes user
            Route::get('users', 'UserController@index');
            Route::post('users/store', 'UserController@store');
            Route::get('users/delete/{id}', 'UserController@delete');
            Route::get('users/deactivate/{id}', 'UserController@deactivate');
            Route::get('users/activate/{id}', 'UserController@activate');

            //routes main categroy
            Route::get('main-category', 'MainCategoryController@index');
            Route::post('main-category/store', 'MainCategoryController@store');
            Route::get('main-category/edit/{id}', 'MainCategoryController@edit');
            Route::post('main-category/update/{id}', 'MainCategoryController@update');
            Route::get('main-category/delete/{id}', 'MainCategoryController@delete');
            Route::get('main-category/activate/{id}', 'MainCategoryController@activate');
            Route::get('main-category/deactivate/{id}', 'MainCategoryController@deactivate');
            Route::post('main-category/lang-ar/{id}', 'MainCategoryController@lang_ar');
            Route::post('main-category/lang-es/{id}', 'MainCategoryController@lang_es');

            //routes sub categroy
            Route::get('sub-category', 'SubCategoryController@index');
            Route::get('sub-category/create', 'SubCategoryController@create');
            Route::post('sub-category/store', 'SubCategoryController@store');
            Route::get('sub-category/edit/{id}', 'SubCategoryController@edit');
            Route::post('sub-category/update/{id}', 'SubCategoryController@update');
            Route::get('sub-category/delete/{id}', 'SubCategoryController@delete');
            Route::get('sub-category/activate/{id}', 'SubCategoryController@activate');
            Route::get('sub-category/deactivate/{id}', 'SubCategoryController@deactivate');
            Route::post('sub-category/lang-ar/{id}', 'SubCategoryController@lang_ar');
            Route::post('sub-category/lang-es/{id}', 'SubCategoryController@lang_es');

            //routes brand
            Route::get('brands', 'BrandController@index');
            Route::post('brands/store', 'BrandController@store');
            Route::get('brands/edit/{id}', 'BrandController@edit');
            Route::post('brands/update/{id}', 'BrandController@update');
            Route::get('brands/delete/{id}', 'BrandController@delete');
            Route::get('brands/activate/{id}', 'BrandController@activate');
            Route::get('brands/deactivate/{id}', 'BrandController@deactivate');
            Route::post('brands/lang-ar/{id}', 'BrandController@lang_ar');
            Route::post('brands/lang-es/{id}', 'BrandController@lang_es');

            //routes tag
            Route::get('tags', 'TagController@index');
            Route::post('tags/store', 'TagController@store');
            Route::get('tags/edit/{id}', 'TagController@edit');
            Route::post('tags/update/{id}', 'TagController@update');
            Route::get('tags/delete/{id}', 'TagController@delete');
            Route::get('tags/activate/{id}', 'TagController@activate');
            Route::get('tags/deactivate/{id}', 'TagController@deactivate');
            Route::post('tags/lang-ar/{id}', 'TagController@lang_ar');
            Route::post('tags/lang-es/{id}', 'TagController@lang_es');

            //routes slider
            Route::get('sliders', 'SliderController@index');
            Route::post('sliders/store', 'SliderController@store');
            Route::get('sliders/edit/{id}', 'SliderController@edit');
            Route::post('sliders/update/{id}', 'SliderController@update');
            Route::get('sliders/delete/{id}', 'SliderController@delete');
            Route::get('sliders/activate/{id}', 'SliderController@activate');
            Route::get('sliders/deactivate/{id}', 'SliderController@deactivate');
            Route::post('sliders/lang-ar/{id}', 'SliderController@lang_ar');
            Route::post('sliders/lang-es/{id}', 'SliderController@lang_es');

            //routes attribute
            Route::get('attributes', 'AttributeController@index');
            Route::get('attributes/delete/{id}', 'AttributeController@delete');
            Route::get('attributes/activate/{id}', 'AttributeController@activate');
            Route::get('attributes/deactivate/{id}', 'AttributeController@deactivate');

            //routes attribute
            Route::get('options', 'OptionController@index');
            Route::get('options/delete/{id}', 'OptionController@delete');
            Route::get('options/activate/{id}', 'OptionController@activate');
            Route::get('options/deactivate/{id}', 'OptionController@deactivate');

            //routes product
            Route::get('products', 'ProductController@index');
            Route::get('products/info/{id}', 'ProductController@info');

            //routes order
            Route::get('orders', 'OrderController@index');
            Route::get('orders/info/{id}', 'OrderController@info');

            //routes setting
            Route::get('settings', 'SettingController@index');
            Route::post('settings/edit/{id}', 'SettingController@edit');

            //routes contact
            Route::get('contacts', 'ContactController@index');
            Route::get('contacts/delete{id}', 'ContactController@delete');

            //routes notification
            Route::get('notifications', 'NotificationController@index');
            Route::get('notifications/delete/{id}', 'NotificationController@delete');
            
            Route::get('logout', 'AuthController@logout');
        });

    });
