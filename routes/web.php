<?php

use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('access-denied', [ErrorController::class, 'error403'])->name('access-denied');
