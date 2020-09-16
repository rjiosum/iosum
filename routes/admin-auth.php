<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Iosum\AdminAuth\Http\Controllers',
    'middleware' => ['api.admin', 'throttle:60,1'],
    'prefix' => 'admin'

], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::middleware(['guest:api:admin'])->group(function () {
            Route::post('/login', 'LoginController@login')->name('admin.login');
        });

        Route::middleware(['auth:api:admin'])->group(function () {
            Route::post('/logout', 'LogoutController@logout')->name('admin.logout');
        });
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/profile', 'ProfileController@index')->name('admin.profile');
    });

});

