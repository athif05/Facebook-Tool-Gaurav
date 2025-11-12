@extends('layouts.guest')

@section('title', 'Reset Password')
@section('subtitle', 'Enter your new password')

@section('content')

<!-- Validation Errors Summary -->
@if ($errors->any())
<!-- <div style="margin-bottom: 1.5rem; padding: 1rem; background-color: #fee2e2; border: 1px solid #fca5a5; border-radius: 0.5rem;">
    <div style="display: flex; align-items: start; gap: 0.75rem;">
        <div style="flex-shrink: 0; color: #dc2626;">
            <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div>
            <p style="color: #991b1b; margin: 0; font-weight: 600; margin-bottom: 0.5rem;">Please fix the following errors:</p>
            <ul style="margin: 0; padding-left: 1.25rem; color: #991b1b;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div> -->
@endif


<form method="POST" action="{{ route('password.store') }}" id="resetPasswordForm">
    @csrf
    
    <!-- Hidden Token -->
    <input type="hidden" name="token" value="{{ $token }}">

    <!-- Email -->
    <div class="form-group">
        <label for="email" class="form-label">
            Email Address <span class="required">*</span>
        </label>
        <input
            type="email"
            id="email"
            name="email"
            class="form-input"
            value="{{ old('email', $email) }}"
            required
            readonly
            style="background-color: #f9fafb; {{ $errors->has('email') ? 'border-color: #ef4444;' : '' }}"
        >
    </div>

    <!-- Password -->
    <div class="form-group">
        <label for="password" class="form-label">
            New Password <span class="required">*</span>
        </label>
        <input
            type="password"
            id="password"
            name="password"
            class="form-input"
            placeholder="Enter new password (min 8 characters)"
            required
            style="{{ $errors->has('password') ? 'border-color: #ef4444;' : '' }}"
        >
        <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">Minimum 8 characters required</p>
     </div>

    <!-- Confirm Password -->
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
            style="{{ $errors->has('password') ? 'border-color: #ef4444;' : '' }}"
        >
    </div>

    <!-- Submit Button -->
    <button 
        type="submit" 
        class="btn btn-primary" 
        id="submitBtn"
        style="width: 100%; padding: 0.75rem 1rem; background-color: #3b82f6; color: white; font-weight: 500; border: none; border-radius: 0.5rem; cursor: pointer; font-size: 1rem;"
    >
        <span id="btnText">Reset Password</span>
        <span id="btnLoading" style="display: none;">Resetting...</span>
    </button>
</form>

<style>
#submitBtn:disabled {
    background-color: #93c5fd;
    cursor: not-allowed;
    opacity: 0.7;
}

.form-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
</style>

<script>
// Only loading state - NO validation
document.getElementById('resetPasswordForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    document.getElementById('btnText').style.display = 'none';
    document.getElementById('btnLoading').style.display = 'inline';
});
</script>
@endsection

@section('footer')
<p>
    Remember your password? 
    <a href="{{ route('login') }}">Sign in here</a>
</p>
@endsection