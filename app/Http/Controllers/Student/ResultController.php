<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\QuizSubmission;

class ResultController extends Controller
{
    public function index()
    {
        $submissions = QuizSubmission::where('student_id', auth()->id())
            ->with('quiz.course')
            ->orderBy('submitted_at', 'desc')
            ->paginate(15);

        return view('student.results.index', compact('submissions'));
    }

    public function show(QuizSubmission $submission)
    {
        // Ensure student can only view their own submissions
        if ($submission->student_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this submission.');
        }

        $submission->load([
            'quiz.questions.options',
            'answers.question.options',
            'answers.selectedOption'
        ]);

        return view('student.results.show', compact('submission'));
    }
}
