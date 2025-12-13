@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h2 style="margin-bottom: 2rem; color: #333;">Dashboard Overview</h2>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);">
            <span style="font-size: 2rem;">👥</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Total Users</div>
            <div class="stat-details">
                Students: {{ $stats['total_students'] }} | Teachers: {{ $stats['total_teachers'] }}
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <span style="font-size: 2rem;">📚</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['total_courses'] }}</div>
            <div class="stat-label">Total Courses</div>
            <div class="stat-details">Active: {{ $stats['active_courses'] }} | Inactive: {{ $stats['inactive_courses'] }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <span style="font-size: 2rem;">📝</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['total_quizzes'] }}</div>
            <div class="stat-label">Total Quizzes</div>
            <div class="stat-details">Published: {{ $stats['published_quizzes'] }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <span style="font-size: 2rem;">🎓</span>
        </div>
        <div class="stat-content">
            <div class="stat-value">{{ $stats['total_year_levels'] }}</div>
            <div class="stat-label">Year Levels</div>
            <div class="stat-details">Sections: {{ $stats['total_sections'] }}</div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="card">
        <div class="card-header">User Registrations (Last 7 Days)</div>
        <div class="card-body">
            <canvas id="userChart" height="250"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Users by Role</div>
        <div class="card-body">
            <canvas id="roleChart" height="250"></canvas>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header">Recent Activity</div>
        <div class="card-body" style="overflow-x: auto;">
            @forelse($recent_activities as $activity)
                <div style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between;">
                        <strong>{{ $activity->user->name }}</strong>
                        <small style="color: #6c757d;">{{ $activity->created_at->diffForHumans() }}</small>
                    </div>
                    <div style="color: #555; font-size: 0.9rem;">{{ $activity->action }}</div>
                </div>
            @empty
                <p style="color: #6c757d; text-align: center;">No recent activity</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Users -->
    <div class="card">
        <div class="card-header">Recently Added Users</div>
        <div class="card-body">
            @forelse($recent_users as $user)
                <div style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <strong>{{ $user->name }}</strong>
                            <div style="font-size: 0.9rem; color: #555;">{{ $user->email }}</div>
                        </div>
                        <span class="badge badge-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'teacher' ? 'info' : 'success') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>
            @empty
                <p style="color: #6c757d; text-align: center;">No users yet</p>
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

    .stat-details {
        color: #999;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // User Registrations Line Chart
    const userCtx = document.getElementById('userChart').getContext('2d');
    new Chart(userCtx, {
        type: 'line',
        data: {
            labels: @json($user_chart_data['labels']),
            datasets: [{
                label: 'New Users',
                data: @json($user_chart_data['data']),
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

    // Users by Role Bar Chart
    const roleCtx = document.getElementById('roleChart').getContext('2d');
    new Chart(roleCtx, {
        type: 'bar',
        data: {
            labels: @json($role_chart_data['labels']),
            datasets: [{
                label: 'Users',
                data: @json($role_chart_data['data']),
                backgroundColor: [
                    'rgba(67, 233, 123, 0.8)',
                    'rgba(79, 172, 254, 0.8)',
                    'rgba(250, 112, 154, 0.8)'
                ],
                borderColor: [
                    'rgb(67, 233, 123)',
                    'rgb(79, 172, 254)',
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
