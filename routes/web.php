<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassManagementController;
use App\Http\Controllers\StudentManagementController;

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
Route::get('/admin/teachers/create', [ClassManagementController::class, 'createTeacher'])->name('admin.teachers.create');
Route::post('/admin/teachers', [ClassManagementController::class, 'storeTeacher'])->name('admin.teachers.store');
Route::get('/admin/students/create', [ClassManagementController::class, 'createStudent'])->name('admin.students.create');
Route::post('/admin/students', [ClassManagementController::class, 'storeStudent'])->name('admin.students.store');
Route::get('/admin/guardians/create', [ClassManagementController::class, 'createGuardian'])->name('admin.guardians.create');
Route::post('/admin/guardians', [ClassManagementController::class, 'storeGuardian'])->name('admin.guardians.store');
Route::get('/admin/classes/create', [ClassManagementController::class, 'createClass'])->name('admin.classes.create');
Route::post('/admin/classes', [ClassManagementController::class, 'storeClass'])->name('admin.classes.store');
Route::get('/student/exam/{exam}', [StudentManagementController::class, 'showExam'])->name('student.exam.show');
Route::post('/student/exam/{exam}', [StudentManagementController::class, 'submitExam'])->name('student.exam.submit');
