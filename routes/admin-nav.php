<?php

use Illuminate\Support\Facades\Route;
use Iosum\AdminNav\Http\Controllers\AdminNavigationController;

Route::group([
    'namespace' => 'Iosum\AdminNav\Http\Controllers',
    'middleware' => ['api.admin', 'throttle:60,1', 'auth:api:admin'],
    'prefix' => 'admin'
], function () {

    Route::get('/admin-nav/tree', [AdminNavigationController::class, 'tree'])->name('admin.nav.tree');
    Route::get('/admin-nav/{parentId?}', [AdminNavigationController::class, 'index'])->name('admin.nav');
    Route::post('/admin-nav/store', [AdminNavigationController::class, 'store'])->name('admin.nav.store');
    Route::patch('/admin-nav/edit/{nav:uuid}', [AdminNavigationController::class, 'update'])->name('admin.nav.update');
    Route::delete('/admin-nav/destroy/{nav:uuid}', [AdminNavigationController::class, 'destroy'])->name('admin.nav.destroy');

});

