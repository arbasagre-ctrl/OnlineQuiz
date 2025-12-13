<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\YearLevel;
use App\Models\Section;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_students' => User::where('role', 'student')->count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_courses' => Course::count(),
            'active_courses' => Course::where('is_active', true)->count(),
            'inactive_courses' => Course::where('is_active', false)->count(),
            'total_quizzes' => Quiz::count(),
            'published_quizzes' => Quiz::where('is_published', true)->count(),
            'total_year_levels' => YearLevel::count(),
            'total_sections' => Section::count(),
        ];

        $recent_activities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $recent_users = User::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Chart Data: User Registrations (Last 7 days)
        $user_chart_data = [];
        $quiz_chart_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $user_chart_data['labels'][] = now()->subDays($i)->format('M d');
            $user_chart_data['data'][] = User::whereDate('created_at', $date)->count();
            
            $quiz_chart_data['labels'][] = now()->subDays($i)->format('M d');
            $quiz_chart_data['data'][] = Quiz::whereDate('created_at', $date)->count();
        }

        // Bar Chart: Users by Role
        $role_chart_data = [
            'labels' => ['Students', 'Teachers', 'Admins'],
            'data' => [
                User::where('role', 'student')->count(),
                User::where('role', 'teacher')->count(),
                User::where('role', 'admin')->count(),
            ]
        ];

        return view('admin.dashboard', compact('stats', 'recent_activities', 'recent_users', 'user_chart_data', 'quiz_chart_data', 'role_chart_data'));
    }
}
