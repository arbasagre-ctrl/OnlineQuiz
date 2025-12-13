@extends('layouts.app')

@section('title', 'Edit Quiz')

@section('content')
<div class="card">
    <div class="card-header">Edit Quiz: {{ $quiz->title }}</div>
    <div class="card-body">
        <form action="{{ route('teacher.quizzes.update', $quiz) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="form-label">Quiz Title *</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $quiz->title) }}" required>
                @error('title')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $quiz->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="course_id" class="form-label">Course *</label>
                <select name="course_id" id="course_id" class="form-control" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $quiz->course_id) == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="total_points" class="form-label">Total Points *</label>
                <input type="number" name="total_points" id="total_points" class="form-control" value="{{ old('total_points', $quiz->total_points) }}" required>
            </div>

            <div class="form-group">
                <label for="time_limit" class="form-label">Time Limit (minutes)</label>
                <input type="number" name="time_limit" id="time_limit" class="form-control" value="{{ old('time_limit', $quiz->time_limit) }}">
            </div>

            <div class="form-group">
                <label for="available_from" class="form-label">Available From</label>
                <input type="datetime-local" name="available_from" id="available_from" class="form-control" 
                    value="{{ old('available_from', $quiz->available_from ? $quiz->available_from->format('Y-m-d\TH:i') : '') }}">
            </div>

            <div class="form-group">
                <label for="available_until" class="form-label">Available Until (Deadline)</label>
                <input type="datetime-local" name="available_until" id="available_until" class="form-control" 
                    value="{{ old('available_until', $quiz->available_until ? $quiz->available_until->format('Y-m-d\TH:i') : '') }}">
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $quiz->category) }}">
            </div>

            <div class="form-group">
                <label for="year_level_id" class="form-label">Year Level (Optional - leave blank for all)</label>
                <select name="year_level_id" id="year_level_id" class="form-control">
                    <option value="">All Year Levels</option>
                    @foreach($yearLevels as $yearLevel)
                        <option value="{{ $yearLevel->id }}" {{ old('year_level_id', $quiz->year_level_id) == $yearLevel->id ? 'selected' : '' }}>
                            {{ $yearLevel->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="section_id" class="form-label">Section (Optional - leave blank for all in year level)</label>
                <select name="section_id" id="section_id" class="form-control">
                    <option value="">All Sections</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ old('section_id', $quiz->section_id) == $section->id ? 'selected' : '' }}>
                            {{ $section->name }} ({{ $section->yearLevel->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Quiz</button>
                <a href="{{ route('teacher.quizzes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Questions</div>
    <div class="card-body">
        @if($quiz->is_published)
            <div class="alert alert-info">
                This quiz is published. You cannot add, edit, or delete questions while it's published.
            </div>
        @endif

        @foreach($quiz->questions as $index => $question)
            <div style="background: #f8f9fa; padding: 1rem; margin-bottom: 1rem; border-radius: 4px; border-left: 4px solid #4ade80;">
                <div class="d-flex justify-content-between align-items-center">
                    <strong>Question {{ $index + 1 }} ({{ $question->points }} points)</strong>
                    @if(!$quiz->is_published)
                        <form action="{{ route('teacher.questions.destroy', [$quiz, $question]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this question?')">Delete</button>
                        </form>
                    @endif
                </div>
                <p style="margin: 0.5rem 0;">{{ $question->question_text }}</p>
                <small style="color: #6c757d;">Type: {{ ucfirst(str_replace('_', ' ', $question->type)) }}</small>
                
                @if(in_array($question->type, ['multiple_choice', 'true_false']))
                    <ul style="margin-top: 0.5rem;">
                        @foreach($question->options as $option)
                            <li style="color: {{ $option->is_correct ? '#28a745' : '#333' }};">
                                {{ $option->option_text }}
                                @if($option->is_correct)
                                    <strong>(Correct)</strong>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach

        @if(!$quiz->is_published)
            <button type="button" class="btn btn-success" onclick="document.getElementById('addQuestionForm').style.display='block'">
                Add Question
            </button>

            <div id="addQuestionForm" style="display: none; margin-top: 1rem; padding: 1rem; background: #fff; border: 1px solid #ddd; border-radius: 4px;">
                <h3>Add New Question</h3>
                <form action="{{ route('teacher.questions.store', $quiz) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="question_text" class="form-label">Question Text *</label>
                        <textarea name="question_text" id="question_text" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="type" class="form-label">Question Type *</label>
                        <select name="type" id="type" class="form-control" required onchange="toggleOptions(this.value)">
                            <option value="">Select Type</option>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="true_false">True/False</option>
                            <option value="short_answer">Short Answer</option>
                            <option value="essay">Essay</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="points" class="form-label">Points *</label>
                        <input type="number" name="points" id="points" class="form-control" value="1" required>
                    </div>

                    <div id="optionsContainer" style="display: none;">
                        <label class="form-label">Options</label>
                        <div id="optionsList"></div>
                        <button type="button" class="btn btn-secondary btn-sm mt-3" onclick="addOption()">Add Option</button>
                    </div>

                    <div id="correctAnswerContainer" style="display: none;">
                        <div class="form-group">
                            <label for="correct_answer" class="form-label">Correct Answer</label>
                            <input type="text" name="correct_answer" id="correct_answer" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">Add Question</button>
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('addQuestionForm').style.display='none'">Cancel</button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>

@section('scripts')
<script>
let optionCount = 0;

function toggleOptions(type) {
    const optionsContainer = document.getElementById('optionsContainer');
    const correctAnswerContainer = document.getElementById('correctAnswerContainer');
    const optionsList = document.getElementById('optionsList');
    
    optionsList.innerHTML = '';
    optionCount = 0;
    
    if (type === 'multiple_choice') {
        optionsContainer.style.display = 'block';
        correctAnswerContainer.style.display = 'none';
        addOption();
        addOption();
    } else if (type === 'true_false') {
        optionsContainer.style.display = 'block';
        correctAnswerContainer.style.display = 'none';
        optionsList.innerHTML = `
            <div style="margin-bottom: 0.5rem;">
                <input type="hidden" name="options[0][text]" value="True">
                <input type="radio" name="correct_option" value="0" id="opt0" required>
                <label for="opt0">True (Correct Answer)</label>
            </div>
            <div style="margin-bottom: 0.5rem;">
                <input type="hidden" name="options[1][text]" value="False">
                <input type="radio" name="correct_option" value="1" id="opt1" required>
                <label for="opt1">False (Correct Answer)</label>
            </div>
        `;
    } else if (type === 'short_answer') {
        optionsContainer.style.display = 'none';
        correctAnswerContainer.style.display = 'block';
    } else {
        optionsContainer.style.display = 'none';
        correctAnswerContainer.style.display = 'none';
    }
}

function addOption() {
    const optionsList = document.getElementById('optionsList');
    const div = document.createElement('div');
    div.style.marginBottom = '0.5rem';
    div.innerHTML = `
        <input type="text" name="options[${optionCount}][text]" class="form-control" placeholder="Option ${optionCount + 1}" required style="display: inline-block; width: 70%;">
        <input type="checkbox" name="options[${optionCount}][is_correct]" value="1" id="correct${optionCount}" style="margin-left: 1rem;">
        <label for="correct${optionCount}">Correct</label>
    `;
    optionsList.appendChild(div);
    optionCount++;
}
</script>
@endsection
@endsection
