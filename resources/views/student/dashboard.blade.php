@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<h2 style="margin-bottom: 2rem; color: #333;">My Dashboard</h2>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);">
            <span style="font-size: 2rem;">📝</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['available_quizzes'] }}</div>
            <div class="stat-label">Available Quizzes</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <span style="font-size: 2rem;">✅</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['completed_quizzes'] }}</div>
            <div class="stat-label">Completed</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <span style="font-size: 2rem;">📊</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['graded_quizzes'] }}</div>
            <div class="stat-label">Graded</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
            <span style="font-size: 2rem;">⏳</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['pending_grading'] }}</div>
            <div class="stat-label">Pending Grade</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <span style="font-size: 2rem;">🎯</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['average_score'] }}%</div>
            <div class="stat-label">Average Score</div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="card">
        <div class="card-header">Recent Quiz Scores</div>
        <div class="card-body">
            <canvas id="scoreChart" height="250"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Quiz Completion Status</div>
        <div class="card-body">
            <canvas id="completionChart" height="250"></canvas>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
    <!-- Upcoming Quizzes -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Upcoming Quizzes</span>
            <a href="{{ route('student.quizzes.index') }}" class="btn btn-primary btn-sm">View All</a>
        </div>
        <div class="card-body">
            @forelse($upcoming_quizzes as $quiz)
                <div style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div style="flex: 1;">
                            <strong>{{ $quiz->title }}</strong>
                            <div style="font-size: 0.9rem; color: #555;">{{ $quiz->course->name }}</div>
                            @if($quiz->available_until)
                                <small style="color: #dc3545;">
                                    Due: {{ $quiz->available_until->format('M d, Y h:i A') }}
                                </small>
                            @endif
                        </div>
                        <a href="{{ route('student.quizzes.show', $quiz) }}" class="btn btn-primary btn-sm">Take</a>
                    </div>
                </div>
            @empty
                <p style="color: #6c757d; text-align: center;">No upcoming quizzes</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Submissions -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Recent Results</span>
            <a href="{{ route('student.results.index') }}" class="btn btn-primary btn-sm">View All</a>
        </div>
        <div class="card-body">
            @forelse($recent_submissions as $submission)
                <div style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div style="flex: 1;">
                            <strong>{{ $submission->quiz->title }}</strong>
                            <div style="font-size: 0.9rem; color: #555;">
                                Submitted: {{ $submission->submitted_at->format('M d, Y') }}
                            </div>
                        </div>
                        @if($submission->is_graded)
                            <span class="badge badge-{{ $submission->grade >= 75 ? 'success' : ($submission->grade >= 50 ? 'warning' : 'danger') }}">
                                {{ $submission->grade }}%
                            </span>
                        @else
                            <span class="badge badge-warning">Grading</span>
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
    // Recent Scores Line Chart
    const scoreCtx = document.getElementById('scoreChart').getContext('2d');
    new Chart(scoreCtx, {
        type: 'line',
        data: {
            labels: @json($score_chart_data['labels']),
            datasets: [{
                label: 'Score (%)',
                data: @json($score_chart_data['data']),
                borderColor: 'rgb(74, 222, 128)',
                backgroundColor: 'rgba(74, 222, 128, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgb(74, 222, 128)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5
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
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            }
        }
    });

    // Completion Bar Chart
    const completionCtx = document.getElementById('completionChart').getContext('2d');
    new Chart(completionCtx, {
        type: 'bar',
        data: {
            labels: @json($completion_data['labels']),
            datasets: [{
                label: 'Quizzes',
                data: @json($completion_data['data']),
                backgroundColor: [
                    'rgba(74, 222, 128, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(79, 172, 254, 0.8)'
                ],
                borderColor: [
                    'rgb(74, 222, 128)',
                    'rgb(34, 197, 94)',
                    'rgb(79, 172, 254)'
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
