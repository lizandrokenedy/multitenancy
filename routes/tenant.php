<?php

use App\Http\Controllers\Tenant\UserController;
use App\Http\Controllers\Tenant\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('clients-list', [ClientController::class, 'clientsList'])->name('clients-list');
Route::resource('/clients', ClientController::class);
Route::resource('/users', UserController::class);
