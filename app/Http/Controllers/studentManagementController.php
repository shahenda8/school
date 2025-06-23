<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Models\StudentDegree;
use App\Models\Subject;
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

}
