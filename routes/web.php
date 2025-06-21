<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassManagementController;
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth:teacher'])->group(function () {
        Route::get('teacher/dashboard',[DashboardController::class,'dashboard']);

Route::get('class-management', [ClassManagementController::class, 'stageDetails']);
Route::get('class-view/{stageId}', [ClassManagementController::class, 'viewClasses'])->name('class_view');
Route::get('class-view/students-view/{classModelsId}', [ClassManagementController::class, 'studentsView']);
Route::get('students-stage-view/{stageId}', [ClassManagementController::class, 'studentsStageView']);
Route::get('class-view/teacher-view/{stageId}', [ClassManagementController::class, 'viewTeachers']);
Route::get('class-view/teacher-class-view/{classId}', [ClassManagementController::class, 'viewClassTeachers']);
Route::get('class-view/view-class-table/{classId}', [ClassManagementController::class, 'ViewClassTable']);
});
Route::middleware(['auth:manager'])->group(function () {
        Route::get('manager/dashboard',[DashboardController::class,'dashboard']);

Route::get('/admin/teachers/create', [ClassManagementController::class, 'createTeacher'])->name('admin.teachers.create');
Route::post('/admin/teachers', [ClassManagementController::class, 'storeTeacher'])->name('admin.teachers.store');
Route::get('/admin/students/create', [ClassManagementController::class, 'createStudent'])->name('admin.students.create');
Route::post('/admin/students', [ClassManagementController::class, 'storeStudent'])->name('admin.students.store');
Route::get('/admin/guardians/create', [ClassManagementController::class, 'createGuardian'])->name('admin.guardians.create');
Route::post('/admin/guardians', [ClassManagementController::class, 'storeGuardian'])->name('admin.guardians.store');
});

Route::group(['prefix'=>'admin'],function(){
    
Route::get('login',[DashboardController::class,'login'])->name('login');

Route::post('signin',[DashboardController::class,'signin'])->name('signin');

});
