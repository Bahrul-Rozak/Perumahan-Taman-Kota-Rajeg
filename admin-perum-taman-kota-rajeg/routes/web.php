<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {

    Route::group(['middleware' => 'auth'], function () {

        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');

        //permissions
        Route::resource('/permission', App\Http\Controllers\Admin\PermissionController::class, ['except' => ['show', 'create', 'edit', 'update', 'delete'], 'as' => 'admin']);

        //roles
        Route::resource('/role', App\Http\Controllers\Admin\RoleController::class, ['except' => ['show'], 'as' => 'admin']);

        //users
        Route::resource('/user', App\Http\Controllers\Admin\UserController::class, ['except' => ['show'], 'as' => 'admin']);

        //tags
        Route::resource('/tag', App\Http\Controllers\Admin\TagController::class, ['except' => 'show', 'as' => 'admin']);
    });
});
