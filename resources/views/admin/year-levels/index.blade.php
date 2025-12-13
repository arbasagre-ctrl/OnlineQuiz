@extends('layouts.app')

@section('title', 'Year Levels')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Year Levels</span>
        <a href="{{ route('admin.year-levels.create') }}" class="btn btn-success btn-sm">Add Year Level</a>
    </div>
    <div class="card-body">
        <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Sections</th>
                    <th>Students</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($yearLevels as $yearLevel)
                    <tr>
                        <td><strong>{{ $yearLevel->name }}</strong></td>
                        <td><span class="badge badge-secondary">{{ $yearLevel->code }}</span></td>
                        <td>{{ $yearLevel->sections_count }}</td>
                        <td>{{ $yearLevel->users_count }}</td>
                        <td>
                            @if($yearLevel->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.year-levels.edit', $yearLevel) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.year-levels.destroy', $yearLevel) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No year levels found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
