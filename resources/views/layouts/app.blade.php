<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>{{ config('app.name', 'Facebook Ads Tool') }}</title>
    
    <!-- Main CSS - Remove Tailwind CDN -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <div class="header-content">
                <!-- Left Side -->
                <div class="header-left">
                    <!-- Logo -->
                    <a href="{{ route('dashboard') }}" class="logo">
                        FaceBook-Ads
                    </a>

                    <!-- Main Navigation -->
                    <nav class="main-nav">
                        <a href="{{ route('dashboard') }}" 
                           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('stats') }}" 
                           class="nav-link {{ request()->routeIs('stats') ? 'active' : '' }}">
                            Stats
                        </a>
                        <a href="{{ route('ads.index') }}" 
                           class="nav-link {{ request()->routeIs('ads.*') || request()->routeIs('campaigns.*') || request()->routeIs('adsets.*') ? 'active' : '' }}">
                            Ads
                        </a>
                        <a href="{{ route('benchmarks') }}" 
                           class="nav-link {{ request()->routeIs('benchmarks') ? 'active' : '' }}">
                            Benchmarks
                        </a>
                        <a href="{{ route('notifications') }}" 
                           class="nav-link {{ request()->routeIs('notifications') ? 'active' : '' }}">
                            Notifications
                        </a>
                    </nav>
                </div>

                <!-- Right Side -->
                <div class="header-right">
                    <span class="user-email">
                        {{ auth()->user()?->email ?? '' }}
                    </span>
                    
                    <!-- Setting/Gear Icons -->
                    <a href="{{ route('settings.connections') }}" class="icon-button" title="Settings">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 15.5A3.5 3.5 0 0 1 8.5 12 3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5 3.5 3.5 0 0 1-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97 0-.33-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.39-1.06-.73-1.69-.98l-.37-2.65A.506.506 0 0 0 14 2h-4c-.25 0-.46.18-.5.42l-.37 2.65c-.63.25-1.17.59-1.69.98l-2.49-1c-.22-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.34-.07.67-.07 1 0 .33.03.65.07.97l-2.11 1.66c-.19.15-.25.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1.01c.52.4 1.06.74 1.69.99l.37 2.65c.04.24.25.42.5.42h4c.25 0 .46-.18.5-.42l.37-2.65c.63-.26 1.17-.59 1.69-.99l2.49 1.01c.22.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.66z"/>
                        </svg>
                    </a>

                    <!-- User Icons -->
                    <button class="icon-button" onclick="toggleProfileDropdown()">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>

                    <!-- Profile Dropdown (optional) -->
                    <div id="profileDropdown" style="display: none; position: absolute; right: 1rem; top: 4rem; background: white; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); padding: 0.5rem; min-width: 200px; z-index: 50;">
                        <div style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">
                            <p style="font-weight: 600; margin: 0;">{{ Auth::user()?->name }}</p>
                            <p style="font-size: 0.875rem; color: #6b7280; margin: 0.25rem 0 0 0;">{{ Auth::user()?->email }}</p>
                        </div>
                        <div style="padding: 0.5rem 0;">
                            <a href="{{ route('profile.show') }}" style="display: block; padding: 0.5rem 0.75rem; color: #374151; text-decoration: none; border-radius: 0.375rem; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f3f4f6'" onmouseout="this.style.backgroundColor='transparent'">
                                Profile Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; background: none; border: none; color: #ef4444; cursor: pointer; border-radius: 0.375rem; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#fef2f2'" onmouseout="this.style.backgroundColor='transparent'">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    @stack('scripts')

    <script>
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const button = event.target.closest('.icon-button');
            if (!button && dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
            }
        });
        </script>

    <script>
    // Prevent back button after logout
    window.onload = function() {
        // Check if user is authenticated
        @guest
            // If not authenticated, prevent going back to protected pages
            window.history.forward();
            
            // Disable back button
            function preventBack() {
                window.history.forward();
            }
            setTimeout("preventBack()", 0);
            window.onunload = function() { null };
        @endguest
    };

    // Clear cache on page unload
    window.addEventListener('beforeunload', function() {
        @guest
            // Clear any cached data
            if (typeof(Storage) !== "undefined") {
                sessionStorage.clear();
            }
        @endguest
    });
    </script>

</body>
</html>