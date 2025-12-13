@extends('layouts.app')

@section('title', 'My Results')

@section('content')
<div class="card">
    <div class="card-header">My Quiz Results</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Quiz</th>
                    <th>Course</th>
                    <th>Submitted</th>
                    <th>Status</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $submission)
                    <tr>
                        <td>{{ $submission->quiz->title }}</td>
                        <td>{{ $submission->quiz->course->name }}</td>
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
                                <strong>{{ $submission->grade }} / {{ $submission->quiz->total_points }}</strong>
                                <br>
                                <small style="color: #6c757d;">
                                    ({{ number_format(($submission->grade / $submission->quiz->total_points) * 100, 1) }}%)
                                </small>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('student.results.show', $submission) }}" class="btn btn-primary btn-sm">
                                View Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No quiz submissions yet.</td>
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
