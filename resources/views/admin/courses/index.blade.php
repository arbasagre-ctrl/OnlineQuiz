@extends('layouts.app')

@section('title', 'Courses')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Courses</span>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-success btn-sm">Add Course</a>
    </div>
    <div class="card-body">
        <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Instructor</th>
                    <th>Quizzes</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td><span class="badge badge-secondary">{{ $course->code }}</span></td>
                        <td><strong>{{ $course->name }}</strong></td>
                        <td>{{ $course->instructor->name }}</td>
                        <td>{{ $course->quizzes->count() }}</td>
                        <td>
                            @if($course->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure? This will also delete all related quizzes!')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No courses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
