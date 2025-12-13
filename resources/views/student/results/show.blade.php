@extends('layouts.app')

@section('title', 'Quiz Results')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <span>Quiz Results</span>
            <a href="{{ route('student.results.index') }}" class="btn btn-secondary btn-sm">Back to Results</a>
        </div>
    </div>
    <div class="card-body">
        <div style="background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%); color: white; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h2 style="margin: 0 0 1rem;">{{ $submission->quiz->title }}</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div>
                    <p style="margin: 0; opacity: 0.9;">Submitted</p>
                    <p style="margin: 0.25rem 0 0; font-size: 1.2rem; font-weight: bold;">
                        {{ $submission->submitted_at->format('M d, Y H:i') }}
                    </p>
                </div>
                <div>
                    <p style="margin: 0; opacity: 0.9;">Your Score</p>
                    <p style="margin: 0.25rem 0 0; font-size: 1.2rem; font-weight: bold;">
                        {{ $submission->grade ?? 0 }} / {{ $submission->quiz->total_points }}
                    </p>
                </div>
                <div>
                    <p style="margin: 0; opacity: 0.9;">Percentage</p>
                    <p style="margin: 0.25rem 0 0; font-size: 1.2rem; font-weight: bold;">
                        {{ number_format((($submission->grade ?? 0) / $submission->quiz->total_points) * 100, 1) }}%
                    </p>
                </div>
                <div>
                    <p style="margin: 0; opacity: 0.9;">Status</p>
                    <p style="margin: 0.25rem 0 0;">
                        @if($submission->is_graded)
                            <span class="badge badge-success">Graded</span>
                        @else
                            <span class="badge badge-warning">Pending Review</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        @if($submission->feedback && $submission->is_graded)
            <div style="background: #d1ecf1; border: 1px solid #17a2b8; padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
                <h4 style="margin: 0 0 0.5rem; color: #0c5460;">Teacher's Feedback</h4>
                <p style="margin: 0; color: #0c5460;">{{ $submission->feedback }}</p>
            </div>
        @endif

        <h3 style="margin-bottom: 1rem;">Your Answers</h3>

        @foreach($submission->quiz->questions as $index => $question)
            @php
                $answer = $submission->answers->firstWhere('question_id', $question->id);
                $isCorrect = $answer && $answer->is_correct === true;
                $isIncorrect = $answer && $answer->is_correct === false;
            @endphp

            <div style="background: white; border: 1px solid #ddd; padding: 1.5rem; margin-bottom: 1.5rem; border-radius: 4px; border-left: 4px solid {{ $isCorrect ? '#28a745' : ($isIncorrect ? '#dc3545' : '#6c757d') }};">
                <div class="d-flex justify-content-between align-items-start">
                    <h4 style="margin: 0 0 0.5rem;">Question {{ $index + 1 }}</h4>
                    <div>
                        @if($answer)
                            <span style="font-weight: bold;">
                                {{ $answer->points_earned }} / {{ $question->points }} points
                            </span>
                            @if($isCorrect)
                                <span class="badge badge-success" style="margin-left: 0.5rem;">Correct</span>
                            @elseif($isIncorrect)
                                <span class="badge badge-danger" style="margin-left: 0.5rem;">Incorrect</span>
                            @endif
                        @endif
                    </div>
                </div>

                <p style="margin: 0.5rem 0 1rem; font-size: 1.1rem;">{{ $question->question_text }}</p>

                @if(in_array($question->type, ['multiple_choice', 'true_false']))
                    <div>
                        <strong>Your Answer:</strong>
                        @if($answer && $answer->selectedOption)
                            <p style="margin: 0.5rem 0; padding: 0.5rem; background: #f8f9fa; border-radius: 4px;">
                                {{ $answer->selectedOption->option_text }}
                            </p>
                        @else
                            <p style="color: #6c757d; margin: 0.5rem 0;">No answer provided</p>
                        @endif

                        @if($submission->is_graded)
                            <strong style="color: #28a745;">Correct Answer:</strong>
                            @php
                                $correctOption = $question->options->firstWhere('is_correct', true);
                            @endphp
                            @if($correctOption)
                                <p style="margin: 0.5rem 0; padding: 0.5rem; background: #d4edda; border-radius: 4px; color: #155724;">
                                    {{ $correctOption->option_text }}
                                </p>
                            @endif
                        @endif
                    </div>

                @elseif($question->type === 'short_answer')
                    <div>
                        <strong>Your Answer:</strong>
                        <p style="margin: 0.5rem 0; padding: 0.5rem; background: #f8f9fa; border-radius: 4px;">
                            {{ $answer ? $answer->answer_text : 'No answer provided' }}
                        </p>

                        @if($submission->is_graded && $question->correct_answer)
                            <strong style="color: #28a745;">Correct Answer:</strong>
                            <p style="margin: 0.5rem 0; padding: 0.5rem; background: #d4edda; border-radius: 4px; color: #155724;">
                                {{ $question->correct_answer }}
                            </p>
                        @endif
                    </div>

                @elseif($question->type === 'essay')
                    <div>
                        <strong>Your Answer:</strong>
                        <div style="margin: 0.5rem 0; padding: 1rem; background: #f8f9fa; border-radius: 4px; white-space: pre-wrap;">{{ $answer ? $answer->answer_text : 'No answer provided' }}</div>
                    </div>
                @endif
            </div>
        @endforeach

        @if(!$submission->is_graded)
            <div style="background: #fff3cd; border: 1px solid #ffc107; padding: 1rem; border-radius: 4px; text-align: center;">
                <p style="margin: 0;">Your submission is being reviewed. Grades and feedback will be available once grading is complete.</p>
            </div>
        @endif
    </div>
</div>
@endsection
