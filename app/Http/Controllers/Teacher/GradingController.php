<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GradingController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $submissions = QuizSubmission::whereHas('quiz', function ($query) {
            $query->where('instructor_id', auth()->id());
        })
        ->with(['quiz', 'student'])
        ->orderBy('submitted_at', 'desc')
        ->paginate(20);

        return view('teacher.grading.index', compact('submissions'));
    }

    public function show(QuizSubmission $submission)
    {
        $this->authorize('view', $submission);

        $submission->load([
            'quiz.questions.options',
            'student',
            'answers.question.options',
            'answers.selectedOption'
        ]);

        return view('teacher.grading.show', compact('submission'));
    }

    public function update(Request $request, QuizSubmission $submission)
    {
        $this->authorize('update', $submission);

        $validated = $request->validate([
            'feedback' => 'nullable|string',
            'answers' => 'nullable|array',
            'answers.*.answer_id' => 'required|exists:submission_answers,id',
            'answers.*.points_earned' => 'required|numeric|min:0',
        ]);

        // Update individual answer scores
        if (isset($validated['answers'])) {
            foreach ($validated['answers'] as $answerData) {
                $answer = $submission->answers()->findOrFail($answerData['answer_id']);
                $answer->points_earned = $answerData['points_earned'];
                $answer->save();
            }
        }

        // Calculate total grade
        $totalGrade = $submission->calculateGrade();

        // Update submission
        $submission->feedback = $validated['feedback'] ?? $submission->feedback;
        $submission->is_graded = true;
        $submission->graded_at = now();
        $submission->graded_by = auth()->id();
        $submission->save();

        ActivityLog::log(
            'submission_graded',
            "Graded submission for quiz: {$submission->quiz->title}",
            'QuizSubmission',
            $submission->id,
            ['grade' => $totalGrade]
        );

        return redirect()->route('teacher.grading.index')
            ->with('success', 'Submission graded successfully.');
    }
}
