@extends('layouts.app')

@section('title', 'System Configuration')

@section('content')
<div class="card">
    <div class="card-header">System Statistics</div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
            <div style="background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%); color: white; padding: 1.5rem; border-radius: 8px;">
                <h3 style="margin: 0; font-size: 2rem;">{{ $totalQuizzes }}</h3>
                <p style="margin: 0.5rem 0 0; opacity: 0.9;">Total Quizzes</p>
            </div>
            <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 1.5rem; border-radius: 8px;">
                <h3 style="margin: 0; font-size: 2rem;">{{ $totalSubmissions }}</h3>
                <p style="margin: 0.5rem 0 0; opacity: 0.9;">Total Submissions</p>
            </div>
            <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 1.5rem; border-radius: 8px;">
                <h3 style="margin: 0; font-size: 2rem;">{{ $categories->count() }}</h3>
                <p style="margin: 0.5rem 0 0; opacity: 0.9;">Quiz Categories</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Quiz Categories</div>
    <div class="card-body">
        @if($categories->count() > 0)
            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                @foreach($categories as $category)
                    <span class="badge badge-info">{{ $category }}</span>
                @endforeach
            </div>
        @else
            <p style="color: #6c757d;">No categories defined yet.</p>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-header">Recent Activity Logs</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLogs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                        <td>{{ $log->user ? $log->user->name : 'System' }}</td>
                        <td><span class="badge badge-secondary">{{ $log->action }}</span></td>
                        <td>{{ $log->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No activity logs yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
