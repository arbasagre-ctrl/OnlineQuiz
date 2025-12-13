<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        // Get available quizzes based on enrollment
        $availableQuizzes = Quiz::where('is_published', true)
            ->where(function($query) use ($student) {
                $query->where('section_id', $student->section_id)
                    ->orWhere(function($q) use ($student) {
                        $q->where('year_level_id', $student->year_level_id)
                          ->whereNull('section_id');
                    })
                    ->orWhere(function($q) {
                        $q->whereNull('section_id')
                          ->whereNull('year_level_id');
                    });
            })
            ->count();

        $completedQuizzes = QuizSubmission::where('student_id', $student->id)
            ->whereNotNull('submitted_at')
            ->count();

        $gradedQuizzes = QuizSubmission::where('student_id', $student->id)
            ->where('is_graded', true)
            ->count();

        $averageScore = QuizSubmission::where('student_id', $student->id)
            ->where('is_graded', true)
            ->avg('grade');

        $stats = [
            'available_quizzes' => $availableQuizzes,
            'completed_quizzes' => $completedQuizzes,
            'graded_quizzes' => $gradedQuizzes,
            'pending_grading' => $completedQuizzes - $gradedQuizzes,
            'average_score' => $averageScore ? round($averageScore, 2) : 0,
        ];

        $recent_submissions = QuizSubmission::where('student_id', $student->id)
            ->with('quiz')
            ->orderBy('submitted_at', 'desc')
            ->take(5)
            ->get();

        $upcoming_quizzes = Quiz::where('is_published', true)
            ->where(function($query) use ($student) {
                $query->where('section_id', $student->section_id)
                    ->orWhere(function($q) use ($student) {
                        $q->where('year_level_id', $student->year_level_id)
                          ->whereNull('section_id');
                    })
                    ->orWhere(function($q) {
                        $q->whereNull('section_id')
                          ->whereNull('year_level_id');
                    });
            })
            ->whereDoesntHave('submissions', function($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->where('available_until', '>=', now())
            ->orderBy('available_until', 'asc')
            ->take(5)
            ->get();

        // Chart Data: Recent Quiz Scores (Last 7 submissions)
        $score_submissions = QuizSubmission::where('student_id', $student->id)
            ->where('is_graded', true)
            ->with('quiz')
            ->orderBy('submitted_at', 'desc')
            ->take(7)
            ->get()
            ->reverse();

        $score_chart_data = [
            'labels' => $score_submissions->map(function($sub) {
                return substr($sub->quiz->title, 0, 15) . '...';
            })->toArray(),
            'data' => $score_submissions->pluck('grade')->toArray()
        ];

        // Bar Chart: Quiz Completion Status
        $completion_data = [
            'labels' => ['Available', 'Completed', 'Graded'],
            'data' => [
                $stats['available_quizzes'],
                $stats['completed_quizzes'],
                $stats['graded_quizzes'],
            ]
        ];

        return view('student.dashboard', compact('stats', 'recent_submissions', 'upcoming_quizzes', 'score_chart_data', 'completion_data'));
    }
}
