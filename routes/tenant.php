<?php

use App\Http\Controllers\Tenant\UserController;
use App\Http\Controllers\Tenant\CompanyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    #Companies
    Route::resource('/companies', CompanyController::class);
    Route::group(['prefix' => 'companies', 'name' => 'companies'], function () {
        Route::post('list-all', [CompanyController::class, 'listAll'])->name('list-all');
    });

    #Users
    Route::resource('users', UserController::class);
    Route::group(['prefix' => 'users', 'name' => 'users'], function () {
        Route::post('list-all', [UserController::class, 'listAll'])->name('list-all');
    });
});
