<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\SubmissionAnswer;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get available quizzes for the student based on section and year level
        $quizzes = Quiz::where('is_published', true)
            ->with(['course', 'section', 'yearLevel', 'submissions' => function($query) {
                $query->where('student_id', auth()->id());
            }])
            ->where(function($query) use ($user) {
                $query->where(function($q) use ($user) {
                    // Quiz assigned to student's section
                    $q->where('section_id', $user->section_id);
                })->orWhere(function($q) use ($user) {
                    // Quiz assigned to student's year level
                    $q->where('year_level_id', $user->year_level_id)
                      ->whereNull('section_id');
                })->orWhere(function($q) {
                    // Quiz available to all (no section or year level restriction)
                    $q->whereNull('section_id')
                      ->whereNull('year_level_id');
                });
            })
            ->get()
            ->filter(function($quiz) {
                return $quiz->isAvailable();
            });

        return view('student.quizzes.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        // Check if quiz is available
        if (!$quiz->isAvailable()) {
            return redirect()->route('student.quizzes.index')
                ->with('error', 'This quiz is not currently available.');
        }

        // Check if student has already submitted
        $existingSubmission = QuizSubmission::where('quiz_id', $quiz->id)
            ->where('student_id', auth()->id())
            ->first();

        if ($existingSubmission) {
            return redirect()->route('student.results.show', $existingSubmission)
                ->with('info', 'You have already submitted this quiz.');
        }

        $quiz->load('questions.options');

        return view('student.quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        // Check if quiz is available and not past deadline
        if (!$quiz->isAvailable() || $quiz->isPastDeadline()) {
            return redirect()->route('student.quizzes.index')
                ->with('error', 'Cannot submit. Quiz deadline has passed.');
        }

        // Check for existing submission
        $existingSubmission = QuizSubmission::where('quiz_id', $quiz->id)
            ->where('student_id', auth()->id())
            ->first();

        if ($existingSubmission) {
            return redirect()->route('student.results.show', $existingSubmission)
                ->with('error', 'You have already submitted this quiz.');
        }

        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'nullable',
        ]);

        // Create submission
        $submission = QuizSubmission::create([
            'quiz_id' => $quiz->id,
            'student_id' => auth()->id(),
            'submitted_at' => Carbon::now(),
        ]);

        $totalPoints = 0;

        // Process answers
        foreach ($quiz->questions as $question) {
            $answerValue = $validated['answers'][$question->id] ?? null;
            $pointsEarned = 0;
            $isCorrect = false;
            $selectedOptionId = null;

            // Auto-grade based on question type
            if ($question->type === 'multiple_choice') {
                $selectedOptionId = $answerValue;
                $selectedOption = $question->options()->find($selectedOptionId);
                
                if ($selectedOption && $selectedOption->is_correct) {
                    $isCorrect = true;
                    $pointsEarned = $question->points;
                }
            } elseif ($question->type === 'true_false') {
                $selectedOptionId = $answerValue;
                $selectedOption = $question->options()->find($selectedOptionId);
                
                if ($selectedOption && $selectedOption->is_correct) {
                    $isCorrect = true;
                    $pointsEarned = $question->points;
                }
            } elseif ($question->type === 'short_answer') {
                // For short answer, compare with correct answer (case-insensitive)
                if ($question->correct_answer && 
                    strtolower(trim($answerValue)) === strtolower(trim($question->correct_answer))) {
                    $isCorrect = true;
                    $pointsEarned = $question->points;
                }
            }
            // Essay questions require manual grading

            SubmissionAnswer::create([
                'submission_id' => $submission->id,
                'question_id' => $question->id,
                'answer_text' => $answerValue,
                'selected_option_id' => $selectedOptionId,
                'is_correct' => $isCorrect,
                'points_earned' => $pointsEarned,
            ]);

            $totalPoints += $pointsEarned;
        }

        // Update submission grade
        $submission->grade = $totalPoints;
        $submission->save();

        ActivityLog::log(
            'quiz_submitted',
            "Submitted quiz: {$quiz->title}",
            'QuizSubmission',
            $submission->id,
            ['grade' => $totalPoints]
        );

        return redirect()->route('student.results.show', $submission)
            ->with('success', 'Quiz submitted successfully!');
    }
}
