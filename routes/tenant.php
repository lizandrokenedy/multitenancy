<?php

use App\Http\Controllers\Tenant\HomeController;
use App\Http\Controllers\Tenant\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    #Users
    Route::resource('users', UserController::class);
    Route::group(['prefix' => 'users', 'name' => 'users'], function () {
        Route::post('list-all', [UserController::class, 'listAll'])->name('list-all');
    });
});
