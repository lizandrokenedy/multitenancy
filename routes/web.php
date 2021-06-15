<?php

use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::group(['prefix' => 'error', 'as' => 'error.'], function () {
    Route::get('access-denied', [ErrorController::class, 'error403'])->name('access-denied');
// });
