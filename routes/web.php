<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassManagementController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('class-management', [ClassManagementController::class, 'stageDetails']);
Route::get('class-view/{stageId}', [ClassManagementController::class, 'viewClasses'])->name('class_view');
Route::get('class-view/students-view/{classModelsId}', [ClassManagementController::class, 'studentsView']);
Route::get('students-stage-view/{stageId}', [ClassManagementController::class, 'studentsStageView']);
Route::get('class-view/teacher-view/{stageId}', [ClassManagementController::class, 'viewTeachers']);
Route::get('class-view/teacher-class-view/{classId}', [ClassManagementController::class, 'viewClassTeachers']);
Route::get('class-view/view-class-table/{classId}', [ClassManagementController::class, 'ViewClassTable']);
