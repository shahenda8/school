<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Event;
use App\Models\Stage;
use App\Models\Subject;
use App\Models\Homework;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\StudentDegree;
use App\Models\ExamsTimetable;
use Illuminate\Support\Facades\Auth;

class studentManagementController extends Controller
{
public function showExam($examId)
{
    $exam = Exam::with('questions')->findOrFail($examId);
    return view('admin.ViewExam', compact('exam'));
}
public function submitExam(Request $request, $examId)
{
    $exam = Exam::with('questions')->findOrFail($examId);

    // استخرج الطالب من السيشن أو auth
    $studentId = !empty(Auth::user()->id) ? Auth::user()->id : 1;

    $totalScore = 0;

    foreach ($exam->questions as $question) {
        $studentAnswer = $request->input('question_' . $question->id);
        if ($studentAnswer == $question->answer) {
            $totalScore += $question->degree;
        }
    }

    // تخزين الدرجة في جدول student_degrees
    StudentDegree::create([
        'student_id' => $studentId,
        'exam_id' => $exam->id,
        'degree' => $totalScore,
    ]);

    return redirect()->route('student.exam.show', $examId)->with('success', 'تم تسليم الامتحان. درجتك: ' . $totalScore);
}

public function showResults()
{
    $studentId = Auth::id();

    $degrees = StudentDegree::with(['exam.subject'])
        ->where('student_id', $studentId)
        ->get();

    //
    $grouped = $degrees->groupBy(function ($item) {
        return $item->exam->subject->name;
    });

    $results = [];

    foreach ($grouped as $subjectName => $records) {
        $coursework = $records->filter(function ($d) {
            return $d->exam->type === 'pre-exam';
        })->sum('degree');

        $final = $records->filter(function ($d) {
            return $d->exam->type === 'final';
        })->sum('degree');

        $results[] = [
            'subject' => $subjectName,
            'coursework' => $coursework,
            'final' => $final,
            'total' => $coursework + $final,
        ];
    }

    return view('admin.ViewResultsToUser', compact('results'));
}

public function showPreExamTable()
{
    $student = Auth::user();
    $stageId = !empty($student->stage_id) ? $student->stage_id : 1;

    $subjects = Subject::where('stage_id', $stageId)->get();
    $results = [];
    foreach ($subjects as $subject) {
        $allExams = Exam::where('type', 'pre-exam')
            ->where('stage_id', $stageId)
            ->where('subject_id', $subject->id)
            ->get();

        $answeredExamIds = StudentDegree::where('student_id', $student->id)
            ->whereIn('exam_id', $allExams->pluck('id'))
            ->pluck('exam_id')
            ->toArray();

        $unansweredExam = $allExams->firstWhere(function ($exam) use ($answeredExamIds) {
            return !in_array($exam->id, $answeredExamIds);
        });

        $answeredExams = StudentDegree::where('student_id', $student->id)
            ->whereIn('exam_id', $allExams->pluck('id'))
            ->get();

        $cumulative = $answeredExams->sum('degree');

        $results[] = [
            'subject' => $subject->name,
            'available_exam' => $unansweredExam,
            'previous' => $answeredExams->count(),
            'cumulative' => $cumulative,
        ];
    }

    return view('admin.ViewAvailExams', compact('results'));
}

    public function show($id)
    {
        $grade = Stage::findOrFail($id);

        $timetable = ExamsTimetable::where('stage_id', $id)
            ->with('subject')
            ->get();

        return view('admin.ViewExamTimetable', compact('timetable', 'grade'));
    }
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            abort(403, 'Student account not found.');
        }

        $stageId = $student->stage_id;

        $subjects = Subject::where('stage_id', $stageId)->get();

        return view('admin.ViewSubjects', compact('subjects'));
    }

    public function showMaterials($id)
    {
        return "Show materials for subject ID: " . $id;
    }
    public function showBySubject($subjectId)
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            abort(403, 'Student not found.');
        }

        // Get subject only if it belongs to student stage
        $subject = Subject::where('id', $subjectId)
                          ->where('stage_id', $student->stage_id)
                          ->firstOrFail();

        $materials = Material::where('subject_id', $subjectId)->get();

        // Get homeworks for the same subject and the student’s class
        $homeworks = Homework::where('subject_id', $subjectId)
                             ->where('class_model_id', $student->class_model_id)
                             ->get();

        return view('admin.ViewMaterial', compact('materials', 'subject', 'homeworks'));
    }
     public function viewEvent()
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.ViewEvents', compact('events'));
    }

}
