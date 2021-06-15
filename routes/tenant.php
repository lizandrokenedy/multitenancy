<?php

use App\Http\Controllers\Tenant\AssessmentController;
use App\Http\Controllers\Tenant\CityController;
use App\Http\Controllers\Tenant\GradeController;
use App\Http\Controllers\Tenant\HelpCenterController;
use App\Http\Controllers\Tenant\ModuleController;
use App\Http\Controllers\Tenant\PermissionController;
use App\Http\Controllers\Tenant\ReportController;
use App\Http\Controllers\Tenant\RoleController;
use App\Http\Controllers\Tenant\SchoolController;
use App\Http\Controllers\Tenant\StudentController;
use App\Http\Controllers\Tenant\TeacherController;
use App\Http\Controllers\Tenant\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::get('cities/{state_id}', [CityController::class, 'getCitiesFromStates']);

    #Schools/Escolas
    Route::resource('schools', SchoolController::class);
    Route::group(['prefix' => 'schools', 'as' => 'schools.'], function () {
        Route::post('list-all', [SchoolController::class, 'listAll'])->name('list-all');
    });

    #Teachers/Professores
    Route::resource('teachers', TeacherController::class);
    Route::group(['prefix' => 'teachers', 'as' => 'teachers.'], function () {
        Route::post('list-all', [TeacherController::class, 'listAll'])->name('list-all');
    });

    #Students/Alunos
    Route::resource('students', StudentController::class);
    Route::group(['prefix' => 'students', 'as' => 'students.'], function () {
        Route::post('list-all', [StudentController::class, 'listAll'])->name('list-all');
    });

    #Grades/Notas
    Route::resource('grades', GradeController::class);
    Route::group(['prefix' => 'grades', 'as' => 'grades.'], function () {
        Route::post('list-all', [GradeController::class, 'listAll'])->name('list-all');
    });

    #Assessments/Avaliações
    Route::resource('assessments', AssessmentController::class);
    Route::group(['prefix' => 'assessments', 'as' => 'assessments.'], function () {
        Route::post('list-all', [AssessmentController::class, 'listAll'])->name('list-all');
    });

    #Users/Usuários
    Route::resource('users', UserController::class);
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::post('list-all', [UserController::class, 'listAll'])->name('list-all');
    });

    #Roles/Perfis
    Route::resource('roles', RoleController::class);
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::post('list-all', [RoleController::class, 'listAll'])->name('list-all');
    });

    #Permissions/Permissões
    Route::resource('permissions', PermissionController::class);
    Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
        Route::post('list-all', [PermissionController::class, 'listAll'])->name('list-all');
    });

    #Modules/Módulos
    Route::resource('modules', ModuleController::class);
    Route::group(['prefix' => 'modules', 'as' => 'modules.'], function () {
        Route::post('list-all', [ModuleController::class, 'listAll'])->name('list-all');
    });

    #Imports/Importações
    Route::group(['prefix' => 'imports', 'as' => 'imports.'], function () {
        Route::group(['prefix' => 'schools', 'as' => 'schools.'], function () {
            Route::get('index', [SchoolController::class, 'viewImport'])->name('index');
            Route::post('import', [SchoolController::class, 'import'])->name('import');
        });

        Route::group(['prefix' => 'teachers', 'as' => 'teachers.'], function () {
            Route::get('index', [TeacherController::class, 'viewImport'])->name('index');
            Route::post('import', [TeacherController::class, 'import'])->name('import');
        });

        Route::group(['prefix' => 'students', 'as' => 'students.'], function () {
            Route::get('index', [StudentController::class, 'viewImport'])->name('index');
            Route::post('import', [StudentController::class, 'import'])->name('import');
        });
    });

    #Help Center/Central de Ajuda
    Route::resource('help-center', HelpCenterController::class);
    Route::group(['prefix' => 'help-center', 'as' => 'help-center.'], function () {
        Route::post('list-all', [HelpCenterController::class, 'listAll'])->name('list-all');
    });


     #Help Center/Central de Ajuda
     Route::resource('reports', ReportController::class);
     Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
         Route::post('list-all', [ReportController::class, 'listAll'])->name('list-all');
     });
});
