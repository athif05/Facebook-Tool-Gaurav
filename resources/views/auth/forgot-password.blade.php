@extends('layouts.guest')

@section('title', 'Forgot Password')
@section('subtitle', 'Reset your password')

@section('content')

<!-- Success Message Display -->
@if (session('status'))
<div class="alert alert-success" style="margin-bottom: 1.5rem; padding: 1rem; background-color: #d1fae5; border: 1px solid #6ee7b7; border-radius: 0.5rem;">
    <div style="display: flex; align-items: start; gap: 0.75rem;">
        <div style="flex-shrink: 0; color: #059669;">
            <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        </div>
        <p style="color: #065f46; margin: 0; font-weight: 500;">{{ session('status') }}</p>
    </div>
</div>
@endif

<form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm">
    @csrf

    <p style="margin-bottom: 1.5rem; color: #6b7280; font-size: 0.875rem;">
        Enter your email address and we'll send you a link to reset your password.
    </p>

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
            value="{{ old('email') }}"
            placeholder="Enter your email"
            required
            autofocus
        >
        
    </div>

    <!-- Submit Button with Loading State -->
    <button 
        type="submit" class="btn btn-primary" id="submitBtn" style="width: 100%; padding: 0.75rem 1rem; background-color: #3b82f6; color: white; font-weight: 500; border: none; border-radius: 0.5rem; cursor: pointer; font-size: 1rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
        <span id="btnText">Send Reset Link</span>
        <span id="btnLoading" style="display: none;">
            <svg style="width: 1rem; height: 1rem; animation: spin 1s linear infinite;" fill="none" viewBox="0 0 24 24">
                <circle style="opacity: 0.25;" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path style="opacity: 0.75;" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Sending...
        </span>
    </button>
</form>

<style>
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

#submitBtn:disabled {
    background-color: #93c5fd;
    cursor: not-allowed;
}
</style>

<script>
document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnLoading = document.getElementById('btnLoading');
    
    // Disable button
    submitBtn.disabled = true;
    
    // Show loading state
    btnText.style.display = 'none';
    btnLoading.style.display = 'inline-flex';
});
</script>

@endsection

@section('footer')
<p>
    Remember your password? 
    <a href="{{ route('login') }}">Sign in here</a>
</p>
@endsection