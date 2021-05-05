<?php

use App\Http\Controllers\Tenant\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'teste';
});

Route::get('/company', [CompanyController::class, 'store']);
