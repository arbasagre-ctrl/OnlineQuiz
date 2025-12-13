@extends('layouts.app')

@section('title', 'Create Course')

@section('content')
<div class="card">
    <div class="card-header">Create Course</div>
    <div class="card-body">
        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="code" class="form-label">Course Code *</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" placeholder="e.g., CS101, MATH201" required>
                @error('code')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Course Name *</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="e.g., Introduction to Computer Science" required>
                @error('name')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="instructor_id" class="form-label">Instructor *</label>
                <select name="instructor_id" id="instructor_id" class="form-control" required>
                    <option value="">Select Instructor</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('instructor_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }} ({{ $teacher->email }})
                        </option>
                    @endforeach
                </select>
                @error('instructor_id')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-check" style="margin-bottom: 1.5rem;">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active">Active</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Course</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
