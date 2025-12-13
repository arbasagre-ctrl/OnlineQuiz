@extends('layouts.app')

@section('title', 'Available Quizzes')

@section('content')
<div class="card">
    <div class="card-header">Available Quizzes</div>
    <div class="card-body">
        @if($quizzes->count() > 0)
            <div style="display: grid; gap: 1.5rem;">
                @foreach($quizzes as $quiz)
                    @php
                        $submission = $quiz->submissions->first();
                        $hasSubmitted = $submission !== null;
                    @endphp

                    <div style="background: white; border: 1px solid #ddd; border-radius: 8px; padding: 1.5rem; {{ $hasSubmitted ? 'opacity: 0.7;' : '' }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div style="flex: 1;">
                                <h3 style="margin: 0 0 0.5rem;">{{ $quiz->title }}</h3>
                                <p style="margin: 0 0 0.5rem; color: #6c757d;">{{ $quiz->course->name }}</p>
                                @if($quiz->description)
                                    <p style="margin: 0.5rem 0;">{{ $quiz->description }}</p>
                                @endif

                                <div style="margin-top: 1rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                                    <span style="color: #6c757d;">
                                        <strong>Points:</strong> {{ $quiz->total_points }}
                                    </span>
                                    @if($quiz->time_limit)
                                        <span style="color: #6c757d;">
                                            <strong>Time Limit:</strong> {{ $quiz->time_limit }} minutes
                                        </span>
                                    @endif
                                    @if($quiz->available_until)
                                        <span style="color: #6c757d;">
                                            <strong>Deadline:</strong> {{ $quiz->available_until->format('M d, Y H:i') }}
                                        </span>
                                    @endif
                                    @if($quiz->category)
                                        <span class="badge badge-info">{{ $quiz->category }}</span>
                                    @endif
                                </div>
                            </div>

                            <div style="margin-left: 1rem;">
                                @if($hasSubmitted)
                                    <span class="badge badge-success">Completed</span>
                                    <a href="{{ route('student.results.show', $submission) }}" class="btn btn-primary btn-sm" style="display: block; margin-top: 0.5rem;">
                                        View Results
                                    </a>
                                @else
                                    <a href="{{ route('student.quizzes.show', $quiz) }}" class="btn btn-primary">
                                        Take Quiz
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center" style="padding: 3rem; color: #6c757d;">
                <p style="font-size: 1.2rem; margin: 0;">No quizzes available at the moment.</p>
                <p style="margin: 0.5rem 0 0;">Check back later for new quizzes.</p>
            </div>
        @endif
    </div>
</div>
@endsection
