@extends('layouts.app')

@section('title', 'My Profile')

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
                <a href="{{ route('profile.show') }}" class="active">
                    <svg class="profile-sidebar-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <span>My Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.password') }}">
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
            <h1 class="profile-title">My Profile</h1>
            <p class="profile-subtitle">View your profile information</p>
        </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="profile-card">
            <!-- Profile Avatar -->
            <div class="profile-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <!-- Profile Information -->
            <div class="profile-section">
                <div class="profile-label">Full Name</div>
                <div class="profile-value">{{ auth()->user()->name }}</div>
            </div>

            <div class="profile-section">
                <div class="profile-label">Email Address</div>
                <div class="profile-value">{{ auth()->user()->email }}</div>
            </div>

            <div class="profile-section">
                <div class="profile-label">Email Verified</div>
                <div class="profile-value">
                    @if (auth()->user()->email_verified_at)
                        <span style="color: #059669;">✓ Verified on {{ auth()->user()->email_verified_at->format('M d, Y') }}</span>
                    @else
                        <span style="color: #dc2626;">✗ Not verified</span>
                    @endif
                </div>
            </div>

            <div class="profile-section">
                <div class="profile-label">Member Since</div>
                <div class="profile-value">{{ auth()->user()->created_at->format('F d, Y') }}</div>
            </div>

            <!-- Account Stats -->
            <div class="profile-stats">
                <div class="stat-card">
                    <div class="stat-label">Account Status</div>
                    <div class="stat-value" style="color: #059669;">Active</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Last Login</div>
                    <div class="stat-value" style="font-size: 0.875rem;">{{ now()->format('M d, Y') }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Campaigns</div>
                    <div class="stat-value"></div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection