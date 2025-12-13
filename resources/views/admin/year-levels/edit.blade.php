@extends('layouts.app')

@section('title', 'Edit Year Level')

@section('content')
<div class="card">
    <div class="card-header">Edit Year Level</div>
    <div class="card-body">
        <form action="{{ route('admin.year-levels.update', $yearLevel) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Name *</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $yearLevel->name) }}" required>
                @error('name')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="code" class="form-label">Code *</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $yearLevel->code) }}" required>
                @error('code')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $yearLevel->description) }}</textarea>
            </div>

            <div class="form-check" style="margin-bottom: 1.5rem;">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $yearLevel->is_active) ? 'checked' : '' }}>
                <label for="is_active">Active</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Year Level</button>
                <a href="{{ route('admin.year-levels.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
