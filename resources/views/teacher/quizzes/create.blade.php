@extends('layouts.app')

@section('title', 'Create Quiz')

@section('content')
<div class="card">
    <div class="card-header">Create New Quiz</div>
    <div class="card-body">
        <form action="{{ route('teacher.quizzes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Quiz Title *</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_id" class="form-label">Course *</label>
                <select name="course_id" id="course_id" class="form-control" required>
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="total_points" class="form-label">Total Points *</label>
                <input type="number" name="total_points" id="total_points" class="form-control" value="{{ old('total_points', 100) }}" required>
                @error('total_points')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="time_limit" class="form-label">Time Limit (minutes)</label>
                <input type="number" name="time_limit" id="time_limit" class="form-control" value="{{ old('time_limit') }}">
                @error('time_limit')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="available_from" class="form-label">Available From</label>
                <input type="datetime-local" name="available_from" id="available_from" class="form-control" value="{{ old('available_from') }}">
                @error('available_from')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="available_until" class="form-label">Available Until (Deadline)</label>
                <input type="datetime-local" name="available_until" id="available_until" class="form-control" value="{{ old('available_until') }}">
                @error('available_until')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}" placeholder="e.g., Midterm, Final, Quiz">
                @error('category')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="year_level_id" class="form-label">Year Level (Optional - leave blank for all)</label>
                <select name="year_level_id" id="year_level_id" class="form-control">
                    <option value="">All Year Levels</option>
                    @foreach($yearLevels as $yearLevel)
                        <option value="{{ $yearLevel->id }}" {{ old('year_level_id') == $yearLevel->id ? 'selected' : '' }}>
                            {{ $yearLevel->name }}
                        </option>
                    @endforeach
                </select>
                @error('year_level_id')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="section_id" class="form-label">Section (Optional - leave blank for all in year level)</label>
                <select name="section_id" id="section_id" class="form-control">
                    <option value="">All Sections</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                            {{ $section->name }} ({{ $section->yearLevel->name }})
                        </option>
                    @endforeach
                </select>
                @error('section_id')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Quiz</button>
                <a href="{{ route('teacher.quizzes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
