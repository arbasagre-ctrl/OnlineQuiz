@extends('layouts.app')

@section('title', 'Sections')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Sections</span>
        <a href="{{ route('admin.sections.create') }}" class="btn btn-success btn-sm">Add Section</a>
    </div>
    <div class="card-body">
        <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Year Level</th>
                    <th>Students</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sections as $section)
                    <tr>
                        <td><strong>{{ $section->name }}</strong></td>
                        <td><span class="badge badge-secondary">{{ $section->code }}</span></td>
                        <td><span class="badge badge-info">{{ $section->yearLevel->name }}</span></td>
                        <td>{{ $section->users_count }}</td>
                        <td>
                            @if($section->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.sections.edit', $section) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No sections found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
