<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Stage;
use App\Models\Manager;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Guardian;
use App\Models\TimeTable;

use App\Models\ClassModel;
use PHPUnit\Metadata\Uses;
use App\Models\SubjectTime;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\ExamsTimetable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClassManagementController extends Controller
{
    public function stageDetails(){
        $data = Stage::get();
        $columnHeadName = ['ID', 'NO.CLASSES', 'NO.STUDENTS', 'NO.SUBJECTS', 'NO.TEACHERS', 'EXAMS TIMMETABLE', (!empty($routes)) ? 'ACTIONS' : null];
        $columnNames     = [
                                ['column' => 'name',          'link' => null],
                                ['column' => 'no_classes',     'link' => 'admin-class-view'],
                                ['column' => 'no_students',    'link' => 'students-stage-view'],
                                ['column' => 'no_subjects',    'link' => null],
                                ['column' => 'no_teachers',    'link' => 'class-view/teacher-view'],
                                ['column' => '',    'link' => ''],//TODO
                            ];

        return view('admin/classManagement', compact('data','columnHeadName', 'columnNames'));
    }

    public function viewClasses($stageId){
        $data = ClassModel::where('stage_id', $stageId)->get();

        $columnHeadName = ['NAME', 'NO.STUDENTS', 'TIME TABLE', 'NO.TEACHER', 'ACTIONS'];
        $columnNames     = [
                                ['column' => 'name',        'link' => null,],
                                ['column' => 'no_student',  'link' => 'students-view'],
                                ['column' => '',            'link' => 'view-class-table'],
                                ['column' => '',            'link' => 'teacher-class-view'],
                           ];
                           $routes = [
                            'deleteLink' => 'class_delete'
                           ];
        return view('admin/classManagement', compact('data','columnHeadName', 'columnNames', 'routes'));
    }

    public function studentsView($classModelId){
        $data = Student::where('class_models_id', $classModelId)->with(['classModel:id,name', 'gardian:id'])->get();

        $data = $data->map(function ($student) {
            unset($student->classModel); // optional: remove full relation if not needed
            unset($student->gardian); // optional: remove full relation if not needed
            $student->classModelName = $student->classModel->name ?? '—';
            $student->guardian_id = $student->gardian->id ?? '—';

            return $student;
        });
        $columnNames     = [
            ['column' => 'id',        'link' => null],
            ['column' => 'name',  'link' => null],
                                ['column' => "classModelName",  'link' => null],
                                ['column' => 'phone',  'link' => null],
                                ['column' => 'email',  'link' => null],
                                ['column' => 'birth_date',  'link' => null],
                                ['column' => 'national_id',  'link' => null],
                                ['column' => 'guardian_id',  'link' => null],
                                ['column' => 'address',  'link' => null],

                            ];

                            $routes = [
                                'deleteLink' => 'studen_delete'
                            ];
                            $columnHeadName = ['ID', 'NAME','CLASS' ,'PHONE' ,'EMAIL' , 'BIRTH_DATE','NATIONAL_ID', 'PARENT_ID','ADDRESS', (!empty($routes)) ? 'ACTIONS' : null];

        return view('admin/classManagement', compact('data','columnHeadName', 'columnNames', 'routes'));
    }

    public function studentsStageView($stageId){
        $data = Student::where('class_models_id', $stageId)->with(['classModel:id,name', 'gardian:id'])->get();

        $data = $data->map(function ($student) {
            unset($student->classModel); // optional: remove full relation if not needed
            unset($student->gardian); // optional: remove full relation if not needed
            $student->classModelName = $student->classModel->name ?? '—';
            $student->guardian_id = $student->gardian->id ?? '—';

            return $student;
        });
        $columnHeadName = ['ID', 'NAME','CLASS' ,'PHONE' ,'EMAIL' , 'BIRTH_DATE','NATIONAL_ID', 'PARENT_ID','ADDRESS','ACTIONS'];
        $columnNames     = [
                                ['column' => 'id',        'link' => null],
                                ['column' => 'name',  'link' => null],
                                ['column' => "classModelName",  'link' => null],
                                ['column' => 'phone',  'link' => null],
                                ['column' => 'email',  'link' => null],
                                ['column' => 'birth_date',  'link' => null],
                                ['column' => 'national_id',  'link' => null],
                                ['column' => 'guardian_id',  'link' => null],
                                ['column' => 'address',  'link' => null],

                           ];

        return view('admin/classManagement', compact('data','columnHeadName', 'columnNames'));
    }

      public function viewTeachers($stageId){
        $data = Teacher::where('stage_id', $stageId)->get();
        $columnHeadName = ['ID', 'NAME','SALARY','NATIONAL_DI','SUBJECT NAME','PHONE','START DATE','EMAIL', 'ACTIONS'];
        $columnNames     = [
                                ['column' => 'id',        'link' => null],
                                ['column' => 'name',  'link' => null],
                                ['column' => 'salary',  'link' => null],
                                ['column' => 'national_id',  'link' => null],
                                ['column' => 'subject_name',  'link' => null],
                                ['column' => 'phone',  'link' => null],
                                ['column' => 'start_date',  'link' => null],
                                ['column' => 'email',  'link' => null],

                           ];

        return view('admin/classManagement', compact('data','columnHeadName', 'columnNames'));
    }

      public function viewClassTeachers($classId){
        $data = Teacher::
        whereHas('classModel', function($q) use($classId){
            $q->where('class_model_id', $classId);
        })
        ->get();
        $columnNames     = [
            ['column' => 'id',        'link' => null],
            ['column' => 'name',  'link' => null],
            ['column' => 'salary',  'link' => null],
            ['column' => 'national_id',  'link' => null],
            ['column' => 'subject_name',  'link' => null],
            ['column' => 'phone',  'link' => null],
            ['column' => 'start_date',  'link' => null],
            ['column' => 'email',  'link' => null],

        ];

        $routes = [
            'deleteLink' => 'teacher.delete'
        ];

        $columnHeadName = ['ID', 'NAME','SALARY','NATIONAL_DI','SUBJECT NAME','PHONE','START DATE','EMAIL', (!empty($routes)) ? 'ACTIONS' : null];

        return view('admin/classManagement', compact('data','columnHeadName', 'columnNames', 'routes'));
    }

    public function ViewClassTable($classId)
    {


$data= TimeTable::where('class_model_id', $classId)
->with('subject')
->get();
$subjectTimes = SubjectTime::get();
        return view('admin/classtimeTable', compact('data', 'subjectTimes'));
    }

    public function createTeacher()
    {
        $subjects = Subject::all();
        $stages = Stage::all();

        return view('admin.CreateTeacher', compact('subjects', 'stages'));
    }

    public function storeTeacher(Request $request)
    {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'user_name' => 'required|string|unique:teachers,user_name',
                'password' => 'required|string|min:6',
                'email' => 'required|email|unique:teachers,email',
                'phone' => 'nullable|string|max:20',
                'salary' => 'nullable|numeric',
                'national_id' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
                'start_date' => 'required|date',
                'subject_id' => 'required|exists:subjects,id',
                'stage_id' => 'required|exists:stages,id',
            ]);

            $validated['password'] = Hash::make($validated['password']);
            $validated['subject_name'] = Subject::where('id', $request->subject_id)->select('id', 'name')->first()->name;
            $validated['stage_name'] = Stage::where('id', $request->stage_id)->select('id', 'name')->first()->name;

            Teacher::create($validated);

            return redirect()->route('admin.teachers.create')->with('success', 'Added');
    }
    public function createStudent()
{
    $stages = Stage::all();
    $classes = ClassModel::all();
    $guardians = Guardian::all();

    return view('admin.CreateStudent', compact('stages', 'classes', 'guardians'));
    }

    public function storeStudent(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'user_name' => 'required|string|unique:students,user_name',
        'password' => 'required|string|min:6',
        'email' => 'required|email|unique:students,email',
        'phone' => 'nullable|string|max:20',
        'national_id' => 'nullable|string|max:20',
        'birth_date' => 'required|date',
        'address' => 'nullable|string|max:255',
        'stage_id' => 'required|exists:stages,id',
        'class_model_id' => 'required|exists:class_models,id',
        'guardian_id' => 'required|exists:guardians,id',
    ]);

            $validated['password'] = Hash::make($validated['password']);
            $validated['class_name'] = ClassModel::where('id', $request->class_model_id)->select('id', 'name')->first()->name;
            $validated['stage_name'] = Stage::where('id', $request->stage_id)->select('id', 'name')->first()->name;
            $validated['guardian_name'] = Guardian::where('id', $request->guardian_id)->select('id', 'name')->first()->name;
            $validated['class_models_id'] = $request->class_model_id;

    $student=  Student::create($validated);

        $class = ClassModel::where('id', $request->class_model_id)->first();

    $stage = Stage::where('id', $request->stage_id)->first();
    $class->update(
        [
            'no_student' => $class->no_student +1
        ]
    );
    $stage->update(
        [
            'no_students' => $stage->no_students +1
        ]
    );
    return redirect()->route('admin.students.create')->with('success', 'Added');
    }
public function createGuardian()
{
    $students = Student::all();
    return view('admin.CreateParent', compact('students'));
}

public function storeGuardian(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'user_name' => 'required|string|unique:guardians,user_name',
        'password' => 'required|string|min:6',
        'email' => 'required|email|unique:guardians,email',
        'phone' => 'nullable|string|max:20',
        'national_id' => 'nullable|string|max:20',
        'student_ids' => 'nullable|array',
        'student_ids.*' => 'exists:students,id'
    ]);

    $validated['password'] = Hash::make($validated['password']);
    $guardian = Guardian::create(Arr::except($validated,['student_name', 'student_ids']));

    // ربط الطلاب بولي الأمر
    if ($request->has('student_ids')) {
        Student::whereIn('id', $request->student_ids)->update(['guardian_id' => $guardian->id]);
    }

    return redirect()->route('admin.guardians.create')->with('success', 'Added');
}
public function createClass()
{
    $stages = Stage::all();
    return view('admin.CreateClass', compact('stages'));
}

public function storeClass(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:class_models,name',
        'stage_id' => 'required|exists:stages,id',
        'no_students' => 'required|integer|min:0',
    ]);

    ClassModel::create($validated);
    $stage = Stage::where('id', $request->stage_id)->first();
    $stage->update(
        [
            'no_classes' => $stage->no_classes +1
        ]
    );

    return redirect()->route('admin.classes.create')->with('success', 'Added');
}

public function create()
{
    return view('admin.CreateClassTimetable', [
        'grades' => Stage::all(),
        'classes' => ClassModel::all(),
        'teachers' => Teacher::all(),
        'subjects' => Subject::all(),
        'times' => SubjectTime::all(),
    ]);
}

public function store(Request $request)
{
    $data = $request->input('timetable');

    foreach ($data as $day => $lectures) {
        foreach ($lectures as $lecture) {
            TimeTable::create([
                'day' => $day,
                'subject_id' => $lecture['subject_id'],
                'teacher_id' => $lecture['teacher_id'],
                'subject_time_id' => $lecture['subject_time_id'],
                'class_model_id' => $request->input('class_id'),
            ]);
        }
    }

    return redirect()->back()->with('success', 'تم إنشاء جدول الحصص بنجاح');
}

public function editDay($classId, $day)
{
    $subjects = Subject::all();
    $teachers = Teacher::all();

    // جدول الحصص لليوم ده
    $daySchedule = TimeTable::where('class_model_id', $classId)
        ->where('day', strtoupper($day))
        ->orderBy('subject_time_id')
        ->get();

    return view('admin.EditDayClassTimetable', compact('classId', 'day', 'daySchedule', 'subjects', 'teachers'));
}
public function updateDay(Request $request, $classId, $day)
{
    $data = $request->input('timetable');
    foreach ($data as $index => $item) {
        $existing = TimeTable::where('class_model_id', $classId)
            ->where('day', strtoupper($day))
            ->where('subject_time_id', $index + 1)
            ->first();
        if ($existing) {
            $existing->update([
                'subject_id' => $item['subject_id'],
                'teacher_id' => $item['teacher_id'],
            ]);
        }
    }

    return redirect()->back()->with('success', 'تم تعديل جدول ' . ucfirst($day) . ' بنجاح.');
}

public function createEvent()
{
    return view('admin.CreateEvent');
}

public function storeEvent(Request $request)
{
    $request->validate([
        'eventName' => 'required|string|max:255',
        'eventDate' => 'required|date',
        'eventTime' => 'required',
        'eventLocation' => 'required|string|max:255',
        'eventDescription' => 'nullable|string',
    ]);
   $storeEvent = Event::create([
        'name' => $request->eventName,
        'date' => $request->eventDate,
        'time' => $request->eventTime,
        'location' => $request->eventLocation,
        'description' => $request->eventDescription,
    ]);

    return redirect()->route('admin.events.create')->with('success', 'Event added successfully!');
}
public function showLogin()
    {
        return view('admin.Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('user_name', 'password');

        // 1. Check Student
        $student = Student::where('user_name', $credentials['user_name'])->first();
        if ($student && Hash::check($credentials['password'], $student->password)) {
            Auth::guard('student')->login($student);

            return redirect()->route('student.dashboard'); // ← صفحات الطالب
        }

        // 2. Check Guardian
        $guardian = Guardian::where('user_name', $credentials['user_name'])->first();
        if ($guardian && Hash::check($credentials['password'], $guardian->password)) {
            Auth::guard('guardian')->login($guardian);

            return redirect()->route('guardian.dashboard'); // ← صفحات ولي الأمر
        }

        // 3. Check Teacher
        $teacher = Teacher::where('user_name', $credentials['user_name'])->first();
        if ($teacher && Hash::check($credentials['password'], $teacher->password)) {
            Auth::guard('teacher')->login($teacher);
            return redirect()->route('teacher.dashboard'); // ← صفحات المدرس
        }

        // 4. Check Admin (Manager)
        $manager = Manager::where('user_name', $credentials['user_name'])->first();
        if ($manager && Hash::check($credentials['password'], $manager->password)) {
            Auth::guard('manager')->login($manager);

            return redirect()->route('admin.dashboard'); // ← صفحات الأدمن
        }

        // فشل تسجيل الدخول
        return redirect()->route('login')->with('error', 'بيانات الدخول غير صحيحة');
    }
    public function createExamTable()
    {
        $grades = Stage::all();
        $subjects = Subject::all();
        $examTypes = ['Final Exam', 'Midterm', 'Quiz'];

        return view('admin.CreateExamTimetable', compact('grades', 'subjects', 'examTypes'));
    }

    public function storeExamTable(Request $request)
    {
        $request->validate([
            'stage_id' => 'required|exists:stages,id',
            'subject_id' => 'required|exists:subjects,id',
            'name' => 'required|string',
            'day' => 'required|string',
            'time' => 'required|string',
            'location' => 'required|string'
        ]);

        ExamsTimetable::create([
            'stage_id' => $request->stage_id,
            'subject_id' => $request->subject_id,
            'name' => $request->name,
            'day' => $request->day,
            'time' => $request->time,
            'location' => $request->location,
        ]);

        return redirect()->back()->with('success', 'Exam timetable created successfully!');
    }
    public function deleteClass($id)
    {
        $class = ClassModel::where('id', $id)->first();
        if($class)
        {
            $class->delete();
            return redirect()->back();

        }else{
                        return redirect()->back();
        }
    }
    public function deleteStudent($id)
    {
        $student = Student::where('id', $id)->first();
        if($student)
        {
            $student->delete();
            return redirect()->back();

        }else{
                        return redirect()->back();
        }
    }

    public function deleteTeacher($id)
    {
        $teacher = Teacher::where('id', $id)->first();
        if($teacher)
        {
            $teacher->delete();
            return redirect()->back();

        }else{
                        return redirect()->back();
        }
    }
}
