<?php

use App\Http\Controllers\Tenant\GradeController;
use App\Http\Controllers\Tenant\PermissionController;
use App\Http\Controllers\Tenant\RoleController;
use App\Http\Controllers\Tenant\SchoolController;
use App\Http\Controllers\Tenant\TeacherController;
use App\Http\Controllers\Tenant\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    #Users
    Route::resource('users', UserController::class);
    Route::group(['prefix' => 'users', 'name' => 'users'], function () {
        Route::post('list-all', [UserController::class, 'listAll'])->name('list-all');
    });

    #Roles
    Route::resource('roles', RoleController::class);
    Route::group(['prefix' => 'roles', 'name' => 'roles'], function () {
        Route::post('list-all', [RoleController::class, 'listAll'])->name('list-all');
    });

    #Permissions
    Route::resource('permissions', PermissionController::class);
    Route::group(['prefix' => 'permissions', 'name' => 'permissions'], function () {
        Route::post('list-all', [PermissionController::class, 'listAll'])->name('list-all');
    });

    #Schools
    Route::resource('schools', SchoolController::class);
    Route::group(['prefix' => 'schools', 'name' => 'schools'], function () {
        Route::post('list-all', [SchoolController::class, 'listAll'])->name('list-all');
    });

    #Teachers
    Route::resource('teachers', TeacherController::class);
    Route::group(['prefix' => 'teachers', 'name' => 'teachers'], function () {
        Route::post('list-all', [TeacherController::class, 'listAll'])->name('list-all');
    });

    #Grades
    Route::resource('grades', GradeController::class);
    Route::group(['prefix' => 'grades', 'name' => 'grades'], function () {
        Route::post('list-all', [GradeController::class, 'listAll'])->name('list-all');
    });
});
