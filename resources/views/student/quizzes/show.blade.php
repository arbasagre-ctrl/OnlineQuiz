@extends('layouts.app')

@section('title', $quiz->title)

@section('content')
<div class="card">
    <div class="card-header">
        <h2 style="margin: 0;">{{ $quiz->title }}</h2>
    </div>
    <div class="card-body">
        <div style="background: #f8f9fa; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
            <p><strong>Course:</strong> {{ $quiz->course->name }}</p>
            <p><strong>Total Points:</strong> {{ $quiz->total_points }}</p>
            @if($quiz->time_limit)
                <p><strong>Time Limit:</strong> {{ $quiz->time_limit }} minutes</p>
            @endif
            @if($quiz->available_until)
                <p><strong>Deadline:</strong> {{ $quiz->available_until->format('M d, Y H:i') }}</p>
            @endif
            @if($quiz->description)
                <p style="margin-top: 1rem;">{{ $quiz->description }}</p>
            @endif
        </div>

        <form action="{{ route('student.quizzes.submit', $quiz) }}" method="POST" onsubmit="return confirm('Are you sure you want to submit? You cannot change your answers after submission.')">
            @csrf

            @foreach($quiz->questions as $index => $question)
                <div style="background: white; border: 1px solid #ddd; padding: 1.5rem; margin-bottom: 1.5rem; border-radius: 4px;">
                    <h4 style="margin: 0 0 1rem;">Question {{ $index + 1 }} ({{ $question->points }} points)</h4>
                    <p style="font-size: 1.1rem; margin-bottom: 1rem;">{{ $question->question_text }}</p>

                    @if($question->type === 'multiple_choice')
                        <div style="margin-left: 1rem;">
                            @foreach($question->options as $option)
                                <div style="margin-bottom: 0.75rem;">
                                    <label style="display: flex; align-items: center; cursor: pointer;">
                                        <input type="radio" 
                                               name="answers[{{ $question->id }}]" 
                                               value="{{ $option->id }}" 
                                               style="margin-right: 0.5rem;"
                                               required>
                                        <span>{{ $option->option_text }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    @elseif($question->type === 'true_false')
                        <div style="margin-left: 1rem;">
                            @foreach($question->options as $option)
                                <div style="margin-bottom: 0.75rem;">
                                    <label style="display: flex; align-items: center; cursor: pointer;">
                                        <input type="radio" 
                                               name="answers[{{ $question->id }}]" 
                                               value="{{ $option->id }}" 
                                               style="margin-right: 0.5rem;"
                                               required>
                                        <span>{{ $option->option_text }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    @elseif($question->type === 'short_answer')
                        <input type="text" 
                               name="answers[{{ $question->id }}]" 
                               class="form-control" 
                               placeholder="Enter your answer"
                               required>

                    @elseif($question->type === 'essay')
                        <textarea name="answers[{{ $question->id }}]" 
                                  class="form-control" 
                                  rows="6" 
                                  placeholder="Write your essay answer here..."
                                  required></textarea>
                    @endif
                </div>
            @endforeach

            <div style="background: #fff3cd; border: 1px solid #ffc107; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
                <strong>⚠️ Important:</strong> Once you submit, you cannot change your answers. Please review all questions before submitting.
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Submit Quiz</button>
                <a href="{{ route('student.quizzes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@if($quiz->time_limit)
    @section('scripts')
    <script>
        // Simple timer implementation
        let timeLimit = {{ $quiz->time_limit }} * 60; // Convert to seconds
        let startTime = Date.now();

        function updateTimer() {
            let elapsed = Math.floor((Date.now() - startTime) / 1000);
            let remaining = timeLimit - elapsed;

            if (remaining <= 0) {
                alert('Time is up! Submitting quiz...');
                document.querySelector('form').submit();
                return;
            }

            let minutes = Math.floor(remaining / 60);
            let seconds = remaining % 60;

            console.log(`Time remaining: ${minutes}:${seconds.toString().padStart(2, '0')}`);
        }

        setInterval(updateTimer, 1000);
    </script>
    @endsection
@endif
@endsection
