<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎓</text></svg>">
    <title>@yield('title', 'LMS - Quiz System')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f7f9;
        }

        .navbar {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .navbar-nav a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .navbar-nav a:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #17a2b8;
            color: #0c5460;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
            padding: 1rem 1.5rem;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: #4ade80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.1);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-info {
            background-color: #17a2b8;
            color: white;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }

        .pagination {
            display: flex;
            list-style: none;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            text-decoration: none;
            color: #4ade80;
        }

        .pagination .active span {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
            border-color: #4ade80;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        /* Global Full-Screen Loader */
        .global-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(3px);
        }

        .global-loader.active {
            display: flex;
        }

        .loader-content {
            padding: 3rem;
            border-radius: 12px;
            text-align: center;
        }

        .loader-icon {
            font-size: 4rem;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .loader-text {
            font-size: 1.2rem;
            color: white;
            font-weight: 600;
            animation: bounce 1s infinite;
        }

        @keyframes rotateLoader {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 100% { 
                transform: translateY(0);
            }
            50% { 
                transform: translateY(-15px);
            }
        }

        @keyframes loadingDots {
            0% { content: 'Loading'; }
            25% { content: 'Loading.'; }
            50% { content: 'Loading..'; }
            75% { content: 'Loading...'; }
            100% { content: 'Loading'; }
        }

        .layout-wrapper {
            display: flex;
            min-height: calc(100vh - 60px);
        }

        .sidebar {
            width: 250px;
            background: white;
            box-shadow: 2px 0 4px rgba(0,0,0,0.1);
            padding: 1.5rem 0;
            position: sticky;
            top: 0;
            height: calc(100vh - 60px);
            overflow-y: auto;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: #555;
            text-decoration: none;
            transition: all 0.3s;
            gap: 0.75rem;
        }

        .sidebar-menu a:hover {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
            border-right: 4px solid #22c55e;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
        }

        .sidebar-divider {
            height: 1px;
            background: #dee2e6;
            margin: 1rem 0;
        }

        .sidebar-header {
            padding: 0 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #999;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .navbar .container {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-nav {
                flex-direction: column;
                gap: 0.5rem;
                width: 100%;
                text-align: center;
            }

            .layout-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                max-height: none;
                overflow-x: auto;
            }

            .sidebar-menu {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
                padding: 0 1rem;
            }

            .sidebar-menu li {
                flex: 1 1 45%;
                margin-bottom: 0;
                min-width: 140px;
            }

            .sidebar-menu a {
                padding: 0.5rem;
                font-size: 0.9rem;
                justify-content: center;
                text-align: center;
            }

            .sidebar-divider,
            .sidebar-header {
                display: none;
            }

            .main-content {
                padding: 1rem;
            }

            .container {
                padding: 0 10px;
                margin: 1rem auto;
            }

            /* Responsive tables */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            table {
                font-size: 0.85rem;
                min-width: 600px;
            }

            .table th,
            .table td {
                padding: 0.5rem;
                white-space: nowrap;
            }

            /* Stat cards responsive */
            .stat-card {
                flex-direction: row;
            }

            /* Form adjustments */
            .form-control,
            input,
            select,
            textarea {
                font-size: 16px !important; /* Prevents zoom on iOS */
            }

            /* Button groups */
            .d-flex.gap-2 {
                flex-direction: column;
            }

            .d-flex.gap-2 .btn {
                width: 100%;
            }

            /* Card adjustments */
            .card-header.d-flex {
                flex-direction: column;
                gap: 0.5rem;
                align-items: stretch !important;
            }

            .card-header .btn {
                width: 100%;
            }

            /* Grid layouts */
            [style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .stat-card {
                flex-direction: column;
                text-align: center;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .stat-label {
                font-size: 0.8rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .btn {
                padding: 0.6rem 1.2rem;
            }

            .sidebar-menu li {
                flex: 1 1 100%;
            }

            /* Profile picture upload responsive */
            [style*="display: flex; align-items: center; gap: 2rem"] {
                flex-direction: column;
                gap: 1rem !important;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Global Loader -->
    <div class="global-loader" id="globalLoader">
        <div class="loader-content">
            <div class="loader-icon">🎓</div>
            <div class="loader-text">Loading...</div>
        </div>
    </div>

    <nav class="navbar">
        <div class="container">
            <a href="/" class="navbar-brand">LMS Quiz System</a>
            <ul class="navbar-nav">
                @auth
                    <li style="display: flex; align-items: center; gap: 0.5rem;">
                        @if(auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
                                 alt="Profile" 
                                 style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 2px solid white;">
                        @endif
                        <span>{{ auth()->user()->name }}</span>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;" id="logoutForm">
                            @csrf
                            <button type="submit" class="logout-btn" style="background: none; border: none; color: white; cursor: pointer; font-size: inherit; font-family: inherit;">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    @auth
    <div class="layout-wrapper">
        <aside class="sidebar">
            <ul class="sidebar-menu">
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span>📊</span> Dashboard
                    </a></li>
                    <div class="sidebar-divider"></div>
                    <div class="sidebar-header">User Management</div>
                    <li><a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <span>👥</span> Users
                    </a></li>
                    <div class="sidebar-divider"></div>
                    <div class="sidebar-header">Course Management</div>
                    <li><a href="{{ route('admin.courses.index') }}" class="{{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                        <span>📚</span> Courses
                    </a></li>
                    <div class="sidebar-divider"></div>
                    <div class="sidebar-header">Academic</div>
                    <li><a href="{{ route('admin.year-levels.index') }}" class="{{ request()->routeIs('admin.year-levels.*') ? 'active' : '' }}">
                        <span>🎓</span> Year Levels
                    </a></li>
                    <li><a href="{{ route('admin.sections.index') }}" class="{{ request()->routeIs('admin.sections.*') ? 'active' : '' }}">
                        <span>📚</span> Sections
                    </a></li>
                    <div class="sidebar-divider"></div>
                    <div class="sidebar-header">System</div>
                    <li><a href="{{ route('admin.configuration.index') }}" class="{{ request()->routeIs('admin.configuration.*') ? 'active' : '' }}">
                        <span>⚙️</span> Configuration
                    </a></li>
                @elseif(auth()->user()->isTeacher())
                    <li><a href="{{ route('teacher.dashboard') }}" class="{{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                        <span>📊</span> Dashboard
                    </a></li>
                    <div class="sidebar-divider"></div>
                    <div class="sidebar-header">Quiz Management</div>
                    <li><a href="{{ route('teacher.quizzes.index') }}" class="{{ request()->routeIs('teacher.quizzes.*') || request()->routeIs('teacher.questions.*') ? 'active' : '' }}">
                        <span>📝</span> My Quizzes
                    </a></li>
                    <li><a href="{{ route('teacher.grading.index') }}" class="{{ request()->routeIs('teacher.grading.*') ? 'active' : '' }}">
                        <span>✅</span> Grading
                    </a></li>
                    <div class="sidebar-divider"></div>
                    <div class="sidebar-header">Account</div>
                    <li><a href="{{ route('teacher.profile.edit') }}" class="{{ request()->routeIs('teacher.profile.*') ? 'active' : '' }}">
                        <span>👤</span> My Profile
                    </a></li>
                @elseif(auth()->user()->isStudent())
                    <li><a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                        <span>📊</span> Dashboard
                    </a></li>
                    <div class="sidebar-divider"></div>
                    <div class="sidebar-header">My Quizzes</div>
                    <li><a href="{{ route('student.quizzes.index') }}" class="{{ request()->routeIs('student.quizzes.*') ? 'active' : '' }}">
                        <span>📝</span> Available Quizzes
                    </a></li>
                    <li><a href="{{ route('student.results.index') }}" class="{{ request()->routeIs('student.results.*') ? 'active' : '' }}">
                        <span>📊</span> My Results
                    </a></li>
                    <div class="sidebar-divider"></div>
                    <div class="sidebar-header">Account</div>
                    <li><a href="{{ route('student.profile.edit') }}" class="{{ request()->routeIs('student.profile.*') ? 'active' : '' }}">
                        <span>👤</span> My Profile
                    </a></li>
                @endif
            </ul>
        </aside>

        <main class="main-content">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        @yield('content')
        </main>
    </div>
    @else
    <div class="container">
        @yield('content')
    </div>
    @endauth

    <script>
        // Global loader functionality
        const globalLoader = document.getElementById('globalLoader');

        function showLoader() {
            if (globalLoader) {
                globalLoader.classList.add('active');
            }
        }

        function hideLoader() {
            if (globalLoader) {
                globalLoader.classList.remove('active');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Handle logout button specifically with delay to show loader
            const logoutForm = document.getElementById('logoutForm');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent immediate submit
                    showLoader();
                    // Give loader time to display before submitting
                    setTimeout(() => {
                        logoutForm.submit();
                    }, 300);
                });
            }

            // Handle all form submissions
            document.querySelectorAll('form:not(#logoutForm)').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    showLoader();
                    setTimeout(() => {
                        form.submit();
                    }, 300);
                });
            });

            // Handle all button clicks
            document.querySelectorAll('.btn, button').forEach(button => {
                button.addEventListener('click', function(e) {
                    // Skip if it's a cancel/secondary button or has href="#"
                    if (this.classList.contains('btn-secondary') || this.getAttribute('href') === '#') {
                        return;
                    }

                    // For buttons with confirmation dialogs
                    if (this.getAttribute('onclick') && this.getAttribute('onclick').includes('confirm')) {
                        // Delay to allow confirmation dialog
                        setTimeout(() => {
                            // Only show loader if user didn't cancel
                            const form = this.closest('form');
                            if (form) {
                                showLoader();
                            }
                        }, 100);
                    } else if (this.tagName === 'BUTTON' && this.type === 'submit') {
                        // Form submit buttons handled by form submit event
                        return;
                    } else if (this.tagName === 'A') {
                        // Navigation links
                        if (!this.hasAttribute('target') && this.href && this.href !== 'javascript:void(0)') {
                            e.preventDefault();
                            showLoader();
                            setTimeout(() => {
                                window.location.href = this.href;
                            }, 300);
                        }
                    }
                });
            });

            // Handle all sidebar navigation links
            document.querySelectorAll('.sidebar-menu a, .navbar-nav a').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!this.hasAttribute('target') && this.href && this.href !== '#' && this.href !== 'javascript:void(0)') {
                        e.preventDefault();
                        showLoader();
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 300);
                    }
                });
            });

            // Handle all regular links with btn class
            document.querySelectorAll('a.btn:not(.btn-secondary)').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!this.hasAttribute('target') && this.href && this.href !== '#' && this.href !== 'javascript:void(0)') {
                        e.preventDefault();
                        showLoader();
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 300);
                    }
                });
            });

            // Hide loader when page is about to unload (optional, for cleanup)
            window.addEventListener('beforeunload', function() {
                hideLoader();
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
