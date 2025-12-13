@extends('layouts.app')

@section('title', 'Create Year Level')

@section('content')
<div class="card">
    <div class="card-header">Create Year Level</div>
    <div class="card-body">
        <form action="{{ route('admin.year-levels.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Name *</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="e.g., 1st Year, Grade 7" required>
                @error('name')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="code" class="form-label">Code *</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" placeholder="e.g., YEAR1, GRADE7" required>
                @error('code')
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

            <div class="form-check" style="margin-bottom: 1.5rem;">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active">Active</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Year Level</button>
                <a href="{{ route('admin.year-levels.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
