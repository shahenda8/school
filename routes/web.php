<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ManagerOrTeacher;
use App\Http\Controllers\ClassManagementController;
use App\Http\Middleware\ManagerOrTeacherOrAttendee;
use App\Http\Controllers\StudentManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:teacher')->group(function(){
});

Route::middleware('auth:student')->group(function(){

    Route::get('/student/pre-exams', [StudentManagementController::class, 'showPreExamTable'])->name('student.pre_exams');

});

Route::middleware('auth:manager')->group(function(){
    Route::get('/admin/classes/create', [ClassManagementController::class, 'createClass'])->name('admin.classes.create');
    Route::post('/admin/classes', [ClassManagementController::class, 'storeClass'])->name('admin.classes.store');
    Route::get('/admin/timetable/create', [ClassManagementController::class, 'create'])->name('admin.timetable.create');
    Route::post('/admin/timetable/store', [ClassManagementController::class, 'store'])->name('admin.timetable.store');
    Route::get('/exams-table/create', [ClassManagementController::class, 'createExamTable'])->name('exams.table.create');
    Route::post('/exams/store', [ClassManagementController::class, 'storeExamTable'])->name('exams.store');
    Route::get('admin-class-view/class/{Id}', [ClassManagementController::class, 'deleteClass'])->name('class_delete');
    Route::get('delete-student/{Id}', [ClassManagementController::class, 'deleteStudent'])->name('studen_delete');
    Route::get('delete-teacher/{Id}', [ClassManagementController::class, 'deleteTeacher'])->name('teacher.delete');
    Route::get('/admin/students/create', [ClassManagementController::class, 'createStudent'])->name('admin.students.create');
    Route::post('/admin/students', [ClassManagementController::class, 'storeStudent'])->name('admin.students.store');
    Route::get('/admin/teachers/create', [ClassManagementController::class, 'createTeacher'])->name('admin.teachers.create');
    Route::post('/admin/teachers', [ClassManagementController::class, 'storeTeacher'])->name('admin.teachers.store');
    Route::get('/admin/guardians/create', [ClassManagementController::class, 'createGuardian'])->name('admin.guardians.create');
    Route::post('/admin/guardians', [ClassManagementController::class, 'storeGuardian'])->name('admin.guardians.store');
});

Route::middleware('auth:guardian')->group(function(){


});

Route::middleware([ ManagerOrTeacher::class])->group(function(){
    Route::get('class-management', [ClassManagementController::class, 'stageDetails'])->name('class-managment');
    Route::get('students-stage-view/{stageId}', [ClassManagementController::class, 'studentsStageView']);
    Route::get('admin-class-view/{stageId}', [ClassManagementController::class, 'viewClasses'])->name('class_view');
    Route::get('/student/result', [StudentManagementController::class, 'showResults'])->name('student.results');
    Route::get('class-view/teacher-view/{stageId}', [ClassManagementController::class, 'viewTeachers']);
    Route::get('admin-class-view/students-view/{classModelsId}', [ClassManagementController::class, 'studentsView']);
    Route::get('admin-class-view/teacher-class-view/{classId}', [ClassManagementController::class, 'viewClassTeachers']);


});


Route::middleware([ ManagerOrTeacherOrAttendee::class])->group(function(){

    Route::get('admin-class-view/view-class-table/{classId}', [ClassManagementController::class, 'ViewClassTable'])->name('view-class-table');
    Route::post('/student/exam/{exam}', [StudentManagementController::class, 'submitExam'])->name('student.exam.submit');

});





Route::get('/admin/timetable/edit/{classId}/{day}', [ClassManagementController::class, 'editDay'])->name('admin.timetable.editDay');
Route::post('/admin/timetable/update/{classId}/{day}', [ClassManagementController::class, 'updateDay'])->name('admin.timetable.updateDay');
Route::get('/admin/events/create', [ClassManagementController::class, 'createEvent'])->name('admin.events.create');
Route::post('/admin/events/store', [ClassManagementController::class, 'storeEvent'])->name('admin.events.store');
Route::get('/login', [ClassManagementController::class, 'showLogin'])->name('login');
Route::post('/login', [ClassManagementController::class, 'login'])->name('login.submit');

// بصفحات كل يوزر الي هيفتح عليها)
Route::get('/student/dashboard', fn() => 'صفحات الطالب')->name('student.dashboard');
Route::get('/guardian/dashboard', fn() => 'صفحات ولي الأمر')->name('guardian.dashboard');
Route::get('/teacher/dashboard', fn() => 'صفحات المدرس')->name('teacher.dashboard');
Route::get('/admin/dashboard', fn() => 'صفحات الأدمن')->name('admin.dashboard');









//yomna
Route::middleware(['auth:teacher'])->group(function () {
        Route::get('teacher/dashboard',[DashboardController::class,'dashboard'])->name('teacher.dashboard');

Route::get('class-view/{stageId}', [ClassManagementController::class, 'viewClasses'])->name('class_view');
Route::get('class-view/students-view/{classModelsId}', [ClassManagementController::class, 'studentsView']);
Route::get('class-view/view-class-table/{classId}', [ClassManagementController::class, 'ViewClassTable']);

// ============================subjects ====================
Route::resource('subjects',SubjectController::class);
Route::resource('materials',MaterialController::class);
Route::resource('questions',QuestionController::class);
Route::resource('exams',ExamController::class);
});


Route::middleware(['auth:manager'])->group(function () {
        Route::get('manager/dashboard',[DashboardController::class,'dashboard'])->name('manager.dashboard');
});

Route::group(['prefix'=>'admin'],function(){

// Route::get('login',[DashboardController::class,'login'])->name('login');

Route::post('signin',[DashboardController::class,'signin'])->name('signin');

});

