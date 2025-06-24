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



});

Route::middleware('auth:manager')->group(function(){
    Route::get('/admin/classes/create', [ClassManagementController::class, 'createClass'])->name('admin.classes.create');
    Route::post('/admin/classes', [ClassManagementController::class, 'storeClass'])->name('admin.classes.store');//صفحة انشاء فصل
    Route::get('/admin/timetable/create', [ClassManagementController::class, 'create'])->name('admin.timetable.create');//صفحة انشاء الجدول بتاع الحصص
    Route::post('/admin/timetable/store', [ClassManagementController::class, 'store'])->name('admin.timetable.store');
    Route::get('/exams-table/create', [ClassManagementController::class, 'createExamTable'])->name('exams.table.create');//صفحة انشاء جدول امتحانات
    Route::post('/exams/store', [ClassManagementController::class, 'storeExamTable'])->name('exams.table.store');
    Route::get('admin-class-view/class/{Id}', [ClassManagementController::class, 'deleteClass'])->name('class_delete');
    Route::get('delete-student/{Id}', [ClassManagementController::class, 'deleteStudent'])->name('studen_delete');
    Route::get('delete-teacher/{Id}', [ClassManagementController::class, 'deleteTeacher'])->name('teacher.delete');
    Route::get('/admin/students/create', [ClassManagementController::class, 'createStudent'])->name('admin.students.create');//صفحة انشاء طالب
    Route::post('/admin/students', [ClassManagementController::class, 'storeStudent'])->name('admin.students.store');
    Route::get('/admin/teachers/create', [ClassManagementController::class, 'createTeacher'])->name('admin.teachers.create');//صفحة انشاء مدرس
    Route::post('/admin/teachers', [ClassManagementController::class, 'storeTeacher'])->name('admin.teachers.store');
    Route::get('/admin/guardians/create', [ClassManagementController::class, 'createGuardian'])->name('admin.guardians.create');//صفحة انشاء ولي امر
    Route::post('/admin/guardians', [ClassManagementController::class, 'storeGuardian'])->name('admin.guardians.store');
});

Route::middleware('auth:guardian')->group(function(){


});

Route::middleware([ ManagerOrTeacher::class])->group(function(){
    Route::get('students-stage-view/{stageId}', [ClassManagementController::class, 'studentsStageView']);//دي صفخة الطلاب من الgrades
    Route::get('admin-class-view/{stageId}', [ClassManagementController::class, 'viewClasses'])->name('class_view');//دى صفخة الفصول من ال grades
    Route::get('/student/result', [StudentManagementController::class, 'showResults'])->name('student.results');//صفحة جدول النتيجة
    Route::get('class-view/teacher-view/{stageId}', [ClassManagementController::class, 'viewTeachers']);//صفحة المدرسين من الgrades
    Route::get('admin-class-view/students-view/{classModelsId}', [ClassManagementController::class, 'studentsView']);//صفحة الطلاب من الفصل
    Route::get('admin-class-view/teacher-class-view/{classId}', [ClassManagementController::class, 'viewClassTeachers']);
Route::get('/attendance', [ClassManagementController::class, 'index'])->name('attendance.index');//صفحة تسجيل الغياب
Route::post('/attendance/save', [ClassManagementController::class, 'storeAttend'])->name('attendance.store');
Route::get('/admin/timetable/edit/{classId}/{day}', [ClassManagementController::class, 'editDay'])->name('admin.timetable.editDay');//صفحة تعديل يوم في جدول الحصص
Route::post('/admin/timetable/update/{classId}/{day}', [ClassManagementController::class, 'updateDay'])->name('admin.timetable.updateDay');
Route::get('/admin/events/create', [ClassManagementController::class, 'createEvent'])->name('admin.events.create');//دي صفحة انشاء ايفينت
Route::post('/admin/events/store', [ClassManagementController::class, 'storeEvent'])->name('admin.events.store');
    Route::get('class-management', [ClassManagementController::class, 'stageDetails'])->name('class.management');//ده صفحة الgrsdeللادمن



});


Route::middleware([ ManagerOrTeacherOrAttendee::class])->group(function(){

    Route::get('admin-class-view/view-class-table/{classId}', [ClassManagementController::class, 'ViewClassTable'])->name('view-class-table');//صفحة عرض جدول الحصص
    Route::post('/student/exam/{exam}', [StudentManagementController::class, 'submitExam'])->name('student.exam.submit');
    Route::get('/student/exam/{exam}', [StudentManagementController::class, 'showExam'])->name('student.exam.show');//صفحة عرض الامتحان
    Route::get('/attendance-reports', [ClassManagementController::class, 'indexViewAttend'])->name('attendance.reports');//صفحة عرض تقرير الغياب
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');//دي صفحةعرض المواد
     Route::get('/materials/subject/{id}', [StudentManagementController::class, 'showBySubject'])->name('materials.bySubject');//دي صفحة عرض الماتيريال
      Route::get('/events', [StudentManagementController::class, 'viewEvent'])->name('events.index');//صفحة عرض الايفينتات
          Route::get('/student/pre-exams', [StudentManagementController::class, 'showPreExamTable'])->name('student.pre_exams');//عرض صفحة البري اجزام المتاخة

        Route::get('/exams/grade/{id}', [StudentManagementController::class, 'show'])->name('exams.show');//عرض صفحة جدول الامتحانات

});


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

