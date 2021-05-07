<?php

use App\Http\Controllers\Tenant\UserController;
use App\Http\Controllers\Tenant\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/users', UserController::class);

Route::group([], function () {
    Route::resource('/companies', CompanyController::class);
    Route::group(['prefix' => 'companies', 'name' => 'companies'], function () {
        Route::post('companies-list', [CompanyController::class, 'companiesList'])->name('companies-list');
    });
});
