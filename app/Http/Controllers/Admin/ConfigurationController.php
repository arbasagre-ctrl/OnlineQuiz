<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        $categories = Quiz::distinct()->pluck('category')->filter();
        $totalQuizzes = Quiz::count();
        $totalSubmissions = QuizSubmission::count();
        $recentLogs = ActivityLog::with('user')
            ->latest()
            ->take(50)
            ->get();

        return view('admin.configuration.index', compact(
            'categories',
            'totalQuizzes',
            'totalSubmissions',
            'recentLogs'
        ));
    }

    public function deleteQuiz(Quiz $quiz)
    {
        $quizTitle = $quiz->title;
        $quiz->delete();

        ActivityLog::log(
            'quiz_deleted',
            "Deleted quiz: {$quizTitle}",
            'Quiz',
            $quiz->id
        );

        return redirect()->back()
            ->with('success', 'Quiz deleted successfully.');
    }

    public function deleteSubmission(QuizSubmission $submission)
    {
        $submission->delete();

        ActivityLog::log(
            'submission_deleted',
            "Deleted submission for quiz ID: {$submission->quiz_id}",
            'QuizSubmission',
            $submission->id
        );

        return redirect()->back()
            ->with('success', 'Submission deleted successfully.');
    }
}
