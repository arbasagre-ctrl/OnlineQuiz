@extends('layouts.app')

@section('title', 'Grade Submission')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <span>Grade Submission</span>
            <a href="{{ route('teacher.grading.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
        </div>
    </div>
    <div class="card-body">
        <div style="background: #f8f9fa; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
            <h3 style="margin: 0 0 0.5rem;">{{ $submission->quiz->title }}</h3>
            <p style="margin: 0;"><strong>Student:</strong> {{ $submission->student->name }}</p>
            <p style="margin: 0;"><strong>Submitted:</strong> {{ $submission->submitted_at->format('M d, Y H:i:s') }}</p>
            <p style="margin: 0;"><strong>Current Grade:</strong> {{ $submission->grade ?? 0 }} / {{ $submission->quiz->total_points }}</p>
        </div>

        <form action="{{ route('teacher.grading.update', $submission) }}" method="POST">
            @csrf
            @method('PUT')

            @foreach($submission->quiz->questions as $index => $question)
                @php
                    $answer = $submission->answers->firstWhere('question_id', $question->id);
                @endphp

                <div style="background: white; border: 1px solid #ddd; padding: 1.5rem; margin-bottom: 1.5rem; border-radius: 4px;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div style="flex: 1;">
                            <h4 style="margin: 0 0 0.5rem;">Question {{ $index + 1 }}</h4>
                            <p style="margin-bottom: 1rem;">{{ $question->question_text }}</p>
                            <p style="color: #6c757d; margin: 0;"><small>Type: {{ ucfirst(str_replace('_', ' ', $question->type)) }} | Points: {{ $question->points }}</small></p>
                        </div>
                    </div>

                    @if(in_array($question->type, ['multiple_choice', 'true_false']))
                        <div style="margin-top: 1rem; padding: 1rem; background: #f8f9fa; border-radius: 4px;">
                            <strong>Options:</strong>
                            <ul style="margin: 0.5rem 0;">
                                @foreach($question->options as $option)
                                    <li style="color: {{ $option->is_correct ? '#28a745' : '#333' }}; {{ $answer && $answer->selected_option_id === $option->id ? 'font-weight: bold;' : '' }}">
                                        {{ $option->option_text }}
                                        @if($option->is_correct)
                                            <span class="badge badge-success">Correct Answer</span>
                                        @endif
                                        @if($answer && $answer->selected_option_id === $option->id)
                                            <span class="badge badge-info">Student's Answer</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif($question->type === 'short_answer')
                        <div style="margin-top: 1rem;">
                            <strong>Student's Answer:</strong>
                            <p style="background: #f8f9fa; padding: 1rem; border-radius: 4px; margin: 0.5rem 0;">
                                {{ $answer ? $answer->answer_text : 'No answer provided' }}
                            </p>
                            @if($question->correct_answer)
                                <strong>Correct Answer:</strong>
                                <p style="color: #28a745; margin: 0.5rem 0;">{{ $question->correct_answer }}</p>
                            @endif
                        </div>
                    @elseif($question->type === 'essay')
                        <div style="margin-top: 1rem;">
                            <strong>Student's Answer:</strong>
                            <div style="background: #f8f9fa; padding: 1rem; border-radius: 4px; margin: 0.5rem 0; white-space: pre-wrap;">{{ $answer ? $answer->answer_text : 'No answer provided' }}</div>
                        </div>
                    @endif

                    <div style="margin-top: 1rem;">
                        <label class="form-label"><strong>Points Earned:</strong></label>
                        <input type="hidden" name="answers[{{ $loop->index }}][answer_id]" value="{{ $answer ? $answer->id : '' }}">
                        <input type="number" 
                               name="answers[{{ $loop->index }}][points_earned]" 
                               class="form-control" 
                               value="{{ $answer ? $answer->points_earned : 0 }}" 
                               min="0" 
                               max="{{ $question->points }}" 
                               step="0.5"
                               style="width: 150px;">
                        <small style="color: #6c757d;">Max: {{ $question->points }} points</small>
                    </div>

                    @if($answer && $answer->is_correct !== null)
                        <div style="margin-top: 0.5rem;">
                            @if($answer->is_correct)
                                <span class="badge badge-success">Auto-graded: Correct</span>
                            @else
                                <span class="badge badge-danger">Auto-graded: Incorrect</span>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="form-group">
                <label for="feedback" class="form-label">Overall Feedback</label>
                <textarea name="feedback" id="feedback" class="form-control" rows="4">{{ old('feedback', $submission->feedback) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Grade & Feedback</button>
                <a href="{{ route('teacher.grading.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
