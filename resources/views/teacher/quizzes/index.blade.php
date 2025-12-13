@extends('layouts.app')

@section('title', 'My Quizzes')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>My Quizzes</span>
        <a href="{{ route('teacher.quizzes.create') }}" class="btn btn-success btn-sm">Create New Quiz</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Course</th>
                    <th>Points</th>
                    <th>Status</th>
                    <th>Submissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($quizzes as $quiz)
                    <tr>
                        <td><strong>{{ $quiz->title }}</strong></td>
                        <td>{{ $quiz->course->name }}</td>
                        <td>{{ $quiz->total_points }}</td>
                        <td>
                            @if($quiz->is_published)
                                <span class="badge badge-success">Published</span>
                            @else
                                <span class="badge badge-warning">Draft</span>
                            @endif
                        </td>
                        <td>{{ $quiz->submissions()->count() }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('teacher.quizzes.edit', $quiz) }}" class="btn btn-primary btn-sm">Edit</a>
                                @if(!$quiz->is_published)
                                    <form action="{{ route('teacher.quizzes.publish', $quiz) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Publish</button>
                                    </form>
                                @else
                                    <form action="{{ route('teacher.quizzes.unpublish', $quiz) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn-sm">Unpublish</button>
                                    </form>
                                @endif
                                <form action="{{ route('teacher.quizzes.destroy', $quiz) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No quizzes found. Create your first quiz!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $quizzes->links() }}
        </div>
    </div>
</div>
@endsection
