@extends('layouts.app')

@section('title', 'Grading')

@section('content')
<div class="card">
    <div class="card-header">Quiz Submissions</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Quiz</th>
                    <th>Submitted</th>
                    <th>Status</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $submission)
                    <tr>
                        <td>{{ $submission->student->name }}</td>
                        <td>{{ $submission->quiz->title }}</td>
                        <td>{{ $submission->submitted_at->format('M d, Y H:i') }}</td>
                        <td>
                            @if($submission->is_graded)
                                <span class="badge badge-success">Graded</span>
                            @else
                                <span class="badge badge-warning">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($submission->grade !== null)
                                {{ $submission->grade }} / {{ $submission->quiz->total_points }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('teacher.grading.show', $submission) }}" class="btn btn-primary btn-sm">
                                {{ $submission->is_graded ? 'View' : 'Grade' }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No submissions yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $submissions->links() }}
        </div>
    </div>
</div>
@endsection
