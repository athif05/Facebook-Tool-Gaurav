@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush

@section('content')
<!-- Settings Sub Header (Common) -->
<div class="settings-subheader">
    <ul class="settings-tabs">
        <li>
            <a href="{{ route('settings.connections') }}" 
               class="{{ request()->routeIs('settings.connections') ? 'active' : '' }}">
                Connections
            </a>
        </li>
        <li>
            <a href="{{ route('settings.ad-accounts') }}" 
               class="{{ request()->routeIs('settings.ad-accounts') ? 'active' : '' }}">
                Ad accounts
            </a>
        </li>
    </ul>
</div>

<!-- Settings Content (Page Specific) -->
<div class="settings-content">
    @yield('settings-content')
</div>
@endsection