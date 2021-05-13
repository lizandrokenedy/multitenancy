<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    #Companies
    Route::resource('/companies', CompanyController::class);
    Route::group(['prefix' => 'companies', 'name' => 'companies'], function () {
        Route::post('list-all', [CompanyController::class, 'listAll'])->name('companies.list-all');
    });

    #Users
    Route::resource('users', UserController::class);
    Route::group(['prefix' => 'users', 'name' => 'users'], function () {
        Route::post('list-all', [UserController::class, 'listAll'])->name('users.list-all');
    });
});
