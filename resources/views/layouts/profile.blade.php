<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - FaceBook-Ads</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
        }

        /* Top Navigation */
        .top-nav {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-email {
            color: #6b7280;
            font-size: 0.875rem;
        }

        /* Main Container */
        .container {
            display: flex;
            min-height: calc(100vh - 70px);
        }

        /* Left Sidebar */
        .sidebar {
            width: 280px;
            background: white;
            border-right: 1px solid #e5e7eb;
            padding: 2rem 0;
        }

        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .sidebar-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
        }

        .sidebar-menu li {
            margin-bottom: 0.25rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sidebar-menu a:hover {
            background-color: #f9fafb;
            color: #1f2937;
        }

        .sidebar-menu a.active {
            background-color: #eff6ff;
            color: #2563eb;
            border-right: 3px solid #2563eb;
        }

        .sidebar-icon {
            width: 20px;
            height: 20px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
            max-width: 1200px;
        }

        .content-header {
            margin-bottom: 2rem;
        }

        .content-title {
            font-size: 1.875rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .content-subtitle {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        /* Success/Error Messages */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
        }

        .alert-error {
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            
            .main-content {
                padding: 1rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Top Navigation -->
    <nav class="top-nav">
        <div class="logo">FaceBook-Ads</div>
        <div class="user-menu">
            <span class="user-email">{{ auth()->user()->email }}</span>
            <a href="{{ route('dashboard') }}" style="color: #6b7280; text-decoration: none;">Dashboard</a>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container">
        <!-- Left Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">Profile Settings</h2>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.show') ? 'active' : '' }}">
                        <svg class="sidebar-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        <span>My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.password') }}" class="{{ request()->routeIs('profile.password') ? 'active' : '' }}">
                        <svg class="sidebar-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Change Password</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>