<?php

use App\Http\Controllers\Tenant\AssessmentController;
use App\Http\Controllers\Tenant\CityController;
use App\Http\Controllers\Tenant\GradeController;
use App\Http\Controllers\Tenant\HelpCenterController;
use App\Http\Controllers\Tenant\ModuleController;
use App\Http\Controllers\Tenant\PermissionController;
use App\Http\Controllers\Tenant\RoleController;
use App\Http\Controllers\Tenant\SchoolController;
use App\Http\Controllers\Tenant\StudentController;
use App\Http\Controllers\Tenant\TeacherController;
use App\Http\Controllers\Tenant\UserController;
use App\Http\Controllers\Tenant\Reports\StudentReportController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::get('cities/{state_id}', [CityController::class, 'getCitiesFromStates']);

    #Schools/Escolas
    Route::group(['prefix' => 'schools', 'as' => 'schools.'], function () {
        Route::post('list-all', [SchoolController::class, 'listAll'])->name('list-all');
        Route::post('list-managers', [SchoolController::class, 'listManagers']);
    });
    Route::resource('schools', SchoolController::class);

    #Teachers/Professores
    Route::group(['prefix' => 'teachers', 'as' => 'teachers.'], function () {
        Route::post('list-all', [TeacherController::class, 'listAll'])->name('list-all');
    });
    Route::resource('teachers', TeacherController::class);

    #Students/Alunos
    Route::group(['prefix' => 'students', 'as' => 'students.'], function () {
        Route::post('send-mail-history', [StudentController::class, 'sendMailHistory'])->name('send-mail-history');
        Route::get('list-students-school/{school_id}', [StudentController::class, 'listStudentSchool'])->name('list-student-school');
        Route::get('send-mail-history/{student_id}', [StudentController::class, 'sendMailHistory']);
        Route::get('teste/{student_id}', [StudentController::class, 'testeView'])->name('teste');
        Route::post('list-all', [StudentController::class, 'listAll'])->name('list-all');
    });
    Route::resource('students', StudentController::class);

    #Grades/Notas
    Route::group(['prefix' => 'grades', 'as' => 'grades.'], function () {
        Route::post('list-all', [GradeController::class, 'listAll'])->name('list-all');
    });
    Route::resource('grades', GradeController::class);

    #Assessments/Avaliações
    Route::group(['prefix' => 'assessments', 'as' => 'assessments.'], function () {
        Route::post('list-all', [AssessmentController::class, 'listAll'])->name('list-all');
    });
    Route::resource('assessments', AssessmentController::class);

    #Users/Usuários
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::post('list-all', [UserController::class, 'listAll'])->name('list-all');
    });
    Route::resource('users', UserController::class);

    #Roles/Perfis
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::post('list-all', [RoleController::class, 'listAll'])->name('list-all');
    });
    Route::resource('roles', RoleController::class);

    #Permissions/Permissões
    Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
        Route::post('list-all', [PermissionController::class, 'listAll'])->name('list-all');
    });
    Route::resource('permissions', PermissionController::class);

    #Modules/Módulos
    Route::group(['prefix' => 'modules', 'as' => 'modules.'], function () {
        Route::post('list-all', [ModuleController::class, 'listAll'])->name('list-all');
    });
    Route::resource('modules', ModuleController::class);

    #Imports/Importações
    Route::group(['prefix' => 'imports', 'as' => 'imports.'], function () {
        Route::group(['prefix' => 'schools', 'as' => 'schools.'], function () {
            Route::get('index', [SchoolController::class, 'index'])->name('index');
            Route::post('import', [SchoolController::class, 'import'])->name('import');
        });

        Route::group(['prefix' => 'teachers', 'as' => 'teachers.'], function () {
            Route::get('index', [TeacherController::class, 'index'])->name('index');
            Route::post('import', [TeacherController::class, 'import'])->name('import');
        });

        Route::group(['prefix' => 'students', 'as' => 'students.'], function () {
            Route::get('index', [StudentController::class, 'index'])->name('index');
            Route::post('import', [StudentController::class, 'import'])->name('import');
        });
    });

    #Help Center/Central de Ajuda
    Route::group(['prefix' => 'help-center', 'as' => 'help-center.'], function () {
        Route::post('list-all', [HelpCenterController::class, 'listAll'])->name('list-all');
    });
    Route::resource('help-center', HelpCenterController::class);


    #Help Center/Central de Ajuda
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {

        Route::group(['prefix' => 'students', 'as' => 'students.'], function () {
            Route::get('index', [StudentReportController::class, 'index'])->name('index');
            Route::get('data/{student_id}', [StudentReportController::class, 'getData'])->name('data');
            Route::get('history/{student_id}', [StudentReportController::class, 'getHistoryStudent'])->name('history');
        });
    });
});
