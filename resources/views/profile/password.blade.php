@extends('layouts.app')

@section('title', 'Change Password')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
<div class="profile-container">
    <!-- Left Sidebar -->
    <aside class="profile-sidebar">
        <div class="profile-sidebar-header">
            <h2 class="profile-sidebar-title">Profile Settings</h2>
        </div>
        <ul class="profile-sidebar-menu">
            <li>
                <a href="{{ route('profile.show') }}">
                    <svg class="profile-sidebar-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <span>My Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.password') }}" class="active">
                    <svg class="profile-sidebar-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>Change Password</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="profile-content">
        <div class="profile-header">
            <h1 class="profile-title">Change Password</h1>
            <p class="profile-subtitle">Update your password to keep your account secure</p>
        </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-error">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="profile-card">
            <form method="POST" action="{{ route('profile.password.update') }}" id="changePasswordForm">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div class="form-group">
                    <label for="current_password" class="form-label">
                        Current Password <span class="required">*</span>
                    </label>
                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        class="form-input {{ $errors->has('current_password') ? 'error' : '' }}"
                        placeholder="Enter your current password"
                        required
                    >
                    @error('current_password')
                        <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        New Password <span class="required">*</span>
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                        placeholder="Enter new password (min 8 characters)"
                        required
                    >
                    <p class="form-help">Must be at least 8 characters long</p>
                    @error('password')
                        <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        Confirm New Password <span class="required">*</span>
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-input"
                        placeholder="Re-enter your new password"
                        required
                    >
                </div>

                <!-- Password Requirements Info -->
                <div class="password-requirements">
                    <h4>Password Requirements:</h4>
                    <ul>
                        <li>At least 8 characters long</li>
                        <li>New password must be different from current password</li>
                        <li>Both password fields must match</li>
                    </ul>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary" id="submitBtn" style="margin-top: 1.5rem;">
                    <span id="btnText">Update Password</span>
                    <span id="btnLoading" style="display: none;">Updating...</span>
                </button>
            </form>
        </div>
    </main>
</div>

@push('scripts')
<script>
document.getElementById('changePasswordForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    document.getElementById('btnText').style.display = 'none';
    document.getElementById('btnLoading').style.display = 'inline';
});
</script>
@endpush
@endsection