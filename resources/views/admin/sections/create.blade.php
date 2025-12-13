@extends('layouts.app')

@section('title', 'Create Section')

@section('content')
<div class="card">
    <div class="card-header">Create Section</div>
    <div class="card-body">
        <form action="{{ route('admin.sections.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Name *</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="e.g., Section A, Block 1" required>
                @error('name')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="code" class="form-label">Code *</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" placeholder="e.g., SEC-A, BLOCK-1" required>
                @error('code')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="year_level_id" class="form-label">Year Level *</label>
                <select name="year_level_id" id="year_level_id" class="form-control" required>
                    <option value="">Select Year Level</option>
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
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-check" style="margin-bottom: 1.5rem;">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label for="is_active">Active</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Create Section</button>
                <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
