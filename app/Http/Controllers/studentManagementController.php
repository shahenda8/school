<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Models\StudentDegree;
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
}
