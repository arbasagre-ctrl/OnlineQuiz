@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<h2 style="margin-bottom: 2rem; color: #333;">Edit Profile</h2>

<div class="card">
    <div class="card-header">Profile Information</div>
    <div class="card-body">
        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Picture Section -->
            <div class="form-group">
                <label class="form-label">Profile Picture</label>
                <div style="display: flex; align-items: center; gap: 2rem; flex-wrap: wrap;">
                    <div>
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                 alt="Profile Picture" 
                                 style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid #4ade80;">
                        @else
                            <div style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: bold;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div style="flex: 1;">
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
                        <small style="color: #6c757d;">Max file size: 2MB. Allowed: JPG, PNG, GIF</small>
                        @error('profile_picture')
                            <br><small style="color: #dc3545;">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                @if($user->profile_picture)
                    <div style="margin-top: 1rem;">
                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Remove profile picture?')) { document.getElementById('remove-student-picture-form').submit(); }">
                            Remove Profile Picture
                        </button>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Full Name *</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address *</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Account Information</label>
                <div style="background: #f8f9fa; padding: 1rem; border-radius: 4px;">
                    <p style="margin: 0.5rem 0;"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                    @if($user->yearLevel)
                        <p style="margin: 0.5rem 0;"><strong>Year Level:</strong> {{ $user->yearLevel->name }}</p>
                    @endif
                    @if($user->section)
                        <p style="margin: 0.5rem 0;"><strong>Section:</strong> {{ $user->section->name }}</p>
                    @endif
                </div>
            </div>

            <hr style="margin: 2rem 0;">

            <h4 style="margin-bottom: 1rem;">Change Password (Optional)</h4>

            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                @error('password')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        @if($user->profile_picture)
            <form id="remove-student-picture-form" action="{{ route('student.profile.remove-picture') }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </div>
</div>
@endsection
