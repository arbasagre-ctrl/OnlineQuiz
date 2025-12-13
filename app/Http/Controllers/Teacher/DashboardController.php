<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher = auth()->user();

        $stats = [
            'total_quizzes' => Quiz::where('instructor_id', $teacher->id)->count(),
            'published_quizzes' => Quiz::where('instructor_id', $teacher->id)
                ->where('is_published', true)
                ->count(),
            'draft_quizzes' => Quiz::where('instructor_id', $teacher->id)
                ->where('is_published', false)
                ->count(),
            'total_courses' => Course::where('instructor_id', $teacher->id)->count(),
            'total_submissions' => QuizSubmission::whereHas('quiz', function($query) use ($teacher) {
                $query->where('instructor_id', $teacher->id);
            })->count(),
            'pending_grading' => QuizSubmission::whereHas('quiz', function($query) use ($teacher) {
                $query->where('instructor_id', $teacher->id);
            })->where('is_graded', false)->count(),
        ];

        $recent_quizzes = Quiz::where('instructor_id', $teacher->id)
            ->with('course')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recent_submissions = QuizSubmission::whereHas('quiz', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })
            ->with(['student', 'quiz'])
            ->orderBy('submitted_at', 'desc')
            ->take(5)
            ->get();

        // Chart Data: Submissions over time (Last 7 days)
        $submission_chart_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $submission_chart_data['labels'][] = now()->subDays($i)->format('M d');
            $submission_chart_data['data'][] = QuizSubmission::whereHas('quiz', function($query) use ($teacher) {
                $query->where('instructor_id', $teacher->id);
            })->whereDate('submitted_at', $date)->count();
        }

        // Bar Chart: Quiz Status Distribution
        $quiz_status_data = [
            'labels' => ['Published', 'Draft'],
            'data' => [
                Quiz::where('instructor_id', $teacher->id)->where('is_published', true)->count(),
                Quiz::where('instructor_id', $teacher->id)->where('is_published', false)->count(),
            ]
        ];

        return view('teacher.dashboard', compact('stats', 'recent_quizzes', 'recent_submissions', 'submission_chart_data', 'quiz_status_data'));
    }
}
