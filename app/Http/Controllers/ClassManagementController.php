<?php

namespace App\Http\Controllers;

use App\Models\Stage;
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
use Illuminate\Support\Facades\Hash;

class ClassManagementController extends Controller
{
    public function stageDetails(){
        $data = Stage::get();
        $columnHeadName = ['ID', 'NO.CLASSES', 'NO.STUDENTS', 'NO.SUBJECTS', 'NO.TEACHERS', 'ACTIONS'];
        $columnNames     = [
                                ['column' => 'name',          'link' => null],
                                ['column' => 'no_classes',     'link' => 'class-view'],
                                ['column' => 'no_students',    'link' => 'students-stage-view'],
                                ['column' => 'no_subjects',    'link' => null],
                                ['column' => 'no_teachers',    'link' => 'class-view/teacher-view'],
                            ];

        return view('admin/classManagement', compact('data','columnHeadName', 'columnNames'));
    }

    public function viewClasses($stageId){
        $data = ClassModel::where('stage_id', $stageId)->get();

        $columnHeadName = ['NAME', 'NO.STUDENTS', 'TIME TABLE', 'NO.TEACHER', 'ACTIONS'];
        $columnNames     = [
                                ['column' => 'name',        'link' => null],
                                ['column' => 'no_student',  'link' => 'students-view'],
                                ['column' => '',            'link' => 'view-class-table'],
                                ['column' => '',            'link' => 'teacher-class-view'],
                           ];

        return view('admin/classManagement', compact('data','columnHeadName', 'columnNames'));
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

    $class = ClassModel::find($student->class_model_id);
    $class->updateStudentsCount();

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

    return redirect()->route('admin.classes.create')->with('success', 'Added');
}
}
