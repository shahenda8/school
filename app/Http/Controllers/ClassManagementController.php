<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Stage;
use App\Models\Student;
use App\Models\SubjectTime;
use App\Models\Teacher;
use App\Models\TimeTable;
use Illuminate\Http\Request;
use PHPUnit\Metadata\Uses;

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
// $data = TimeTable::where('class_model_id', $classId)
//     ->with(['classModel', 'subject'])
//     ->orderBy('subject_time_id')
//     ->get()
//     ->groupBy('day');
//         $subjectTimes = SubjectTime::get();

$data= TimeTable::where('class_model_id', $classId)
->with('subject')
->get();
$subjectTimes = SubjectTime::get();
        return view('admin/classtimeTable', compact('data', 'subjectTimes'));
    }

}
