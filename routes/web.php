<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassManagementController;
use App\Http\Controllers\StudentManagementController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:teacher')->group(function(){
    Route::get('/student/result', [StudentManagementController::class, 'showResults'])->name('student.results');
    Route::get('admin-class-view/{stageId}', [ClassManagementController::class, 'viewClasses'])->name('class_view');
    Route::get('admin-students-stage-view/{stageId}', [ClassManagementController::class, 'studentsStageView']);
});

Route::middleware('auth:student')->group(function(){

    Route::get('/student/pre-exams', [StudentManagementController::class, 'showPreExamTable'])->name('student.pre_exams');

});

Route::middleware('auth:manager')->group(function(){
    Route::get('class-management', [ClassManagementController::class, 'stageDetails']);
    Route::get('admin-class-view/{stageId}', [ClassManagementController::class, 'viewClasses'])->name('class_view');
    Route::get('admin-students-stage-view/{stageId}', [ClassManagementController::class, 'studentsStageView']);

});

Route::middleware('auth:guardian')->group(function(){

});

Route::get('class-view/students-view/{classModelsId}', [ClassManagementController::class, 'studentsView']);
Route::get('class-view/teacher-view/{stageId}', [ClassManagementController::class, 'viewTeachers']);
Route::get('class-view/teacher-class-view/{classId}', [ClassManagementController::class, 'viewClassTeachers']);
Route::get('class-view/view-class-table/{classId}', [ClassManagementController::class, 'ViewClassTable'])->name('view-class-table');
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
Route::get('/admin/timetable/create', [ClassManagementController::class, 'create'])->name('admin.timetable.create');
Route::post('/admin/timetable/store', [ClassManagementController::class, 'store'])->name('admin.timetable.store');
Route::get('/admin/timetable/edit/{classId}/{day}', [ClassManagementController::class, 'editDay'])->name('admin.timetable.editDay');
Route::post('/admin/timetable/update/{classId}/{day}', [ClassManagementController::class, 'updateDay'])->name('admin.timetable.updateDay');
Route::get('/admin/events/create', [ClassManagementController::class, 'createEvent'])->name('admin.events.create');
Route::post('/admin/events/store', [ClassManagementController::class, 'storeEvent'])->name('admin.events.store');
Route::get('/login', [ClassManagementController::class, 'showLogin'])->name('login');
Route::post('/login', [ClassManagementController::class, 'login'])->name('login.submit');
Route::get('/exams/create', [ClassManagementController::class, 'createExamTable'])->name('exams.create');
Route::post('/exams/store', [ClassManagementController::class, 'storeExamTable'])->name('exams.store');
// بصفحات كل يوزر الي هيفتح عليها)
Route::get('/student/dashboard', fn() => 'صفحات الطالب')->name('student.dashboard');
Route::get('/guardian/dashboard', fn() => 'صفحات ولي الأمر')->name('guardian.dashboard');
Route::get('/teacher/dashboard', fn() => 'صفحات المدرس')->name('teacher.dashboard');
Route::get('/admin/dashboard', fn() => 'صفحات الأدمن')->name('admin.dashboard');
