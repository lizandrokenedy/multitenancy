<?php

use Illuminate\Support\Facades\Route;

Route::view('/404-tenant', 'errors.404-tenant')->name('404.tenant');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
