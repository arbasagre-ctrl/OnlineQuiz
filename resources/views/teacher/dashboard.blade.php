@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')
<h2 style="margin-bottom: 2rem; color: #333;">My Dashboard</h2>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);">
            <span style="font-size: 2rem;">📝</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['total_quizzes'] }}</div>
            <div class="stat-label">Total Quizzes</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <span style="font-size: 2rem;">✅</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['published_quizzes'] }}</div>
            <div class="stat-label">Published</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
            <span style="font-size: 2rem;">📄</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['draft_quizzes'] }}</div>
            <div class="stat-label">Drafts</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <span style="font-size: 2rem;">📚</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['total_courses'] }}</div>
            <div class="stat-label">Courses</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
            <span style="font-size: 2rem;">📥</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['total_submissions'] }}</div>
            <div class="stat-label">Total Submissions</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">
            <span style="font-size: 2rem;">⏳</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['pending_grading'] }}</div>
            <div class="stat-label">Pending Grading</div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="card">
        <div class="card-header">Quiz Submissions (Last 7 Days)</div>
        <div class="card-body">
            <canvas id="submissionChart" height="250"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Quiz Status Distribution</div>
        <div class="card-body">
            <canvas id="statusChart" height="250"></canvas>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
    <!-- Recent Quizzes -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Recent Quizzes</span>
            <a href="{{ route('teacher.quizzes.index') }}" class="btn btn-primary btn-sm">View All</a>
        </div>
        <div class="card-body">
            @forelse($recent_quizzes as $quiz)
                <div style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div style="flex: 1;">
                            <strong>{{ $quiz->title }}</strong>
                            <div style="font-size: 0.9rem; color: #555;">{{ $quiz->course->name }}</div>
                        </div>
                        <span class="badge badge-{{ $quiz->is_published ? 'success' : 'warning' }}">
                            {{ $quiz->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                </div>
            @empty
                <p style="color: #6c757d; text-align: center;">No quizzes yet</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Submissions -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Recent Submissions</span>
            <a href="{{ route('teacher.grading.index') }}" class="btn btn-primary btn-sm">Grade</a>
        </div>
        <div class="card-body">
            @forelse($recent_submissions as $submission)
                <div style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div style="flex: 1;">
                            <strong>{{ $submission->student->name }}</strong>
                            <div style="font-size: 0.9rem; color: #555;">{{ $submission->quiz->title }}</div>
                            <small style="color: #999;">{{ $submission->submitted_at->diffForHumans() }}</small>
                        </div>
                        @if($submission->is_graded)
                            <span class="badge badge-success">{{ $submission->grade }}%</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    </div>
                </div>
            @empty
                <p style="color: #6c757d; text-align: center;">No submissions yet</p>
            @endforelse
        </div>
    </div>
</div>

<style>
    .stat-card {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-content {
        flex: 1;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        line-height: 1;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Submissions Line Chart
    const submissionCtx = document.getElementById('submissionChart').getContext('2d');
    new Chart(submissionCtx, {
        type: 'line',
        data: {
            labels: @json($submission_chart_data['labels']),
            datasets: [{
                label: 'Submissions',
                data: @json($submission_chart_data['data']),
                borderColor: 'rgb(74, 222, 128)',
                backgroundColor: 'rgba(74, 222, 128, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Quiz Status Bar Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: @json($quiz_status_data['labels']),
            datasets: [{
                label: 'Quizzes',
                data: @json($quiz_status_data['data']),
                backgroundColor: [
                    'rgba(74, 222, 128, 0.8)',
                    'rgba(250, 112, 154, 0.8)'
                ],
                borderColor: [
                    'rgb(67, 233, 123)',
                    'rgb(250, 112, 154)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
