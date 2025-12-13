<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎓</text></svg>">
    <title>Login - LMS Quiz System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 1000px;
            overflow: hidden;
            display: flex;
            min-height: 600px;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            color: white;
            position: relative;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .logo-container {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .logo-icon {
            font-size: 8rem;
            margin-bottom: 1.5rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .logo-container h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .logo-container p {
            font-size: 1.1rem;
            opacity: 0.95;
            line-height: 1.6;
        }

        .login-right {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 2rem;
        }

        .login-header h2 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .login-header p {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #4ade80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.1);
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .form-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 0.5rem;
            cursor: pointer;
        }

        .form-check label {
            cursor: pointer;
            user-select: none;
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 222, 128, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 0.875rem;
            margin-bottom: 1.5rem;
            border-radius: 6px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.25rem;
        }

        .alert li {
            margin: 0.25rem 0;
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

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 450px;
                min-height: auto;
            }

            .login-left {
                padding: 2rem;
                min-height: 250px;
            }

            .logo-icon {
                font-size: 5rem;
            }

            .logo-container h1 {
                font-size: 1.8rem;
            }

            .logo-container p {
                font-size: 0.95rem;
            }

            .login-right {
                padding: 2rem;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .login-left {
                padding: 1.5rem;
            }

            .login-right {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Global Loader -->
    <div class="global-loader" id="globalLoader">
        <div class="loader-content">
            <div class="loader-icon">🎓</div>
            <div class="loader-text">Loading...</div>
        </div>
    </div>

    <div class="login-container">
        <!-- Left Side - Logo/Illustration -->
        <div class="login-left">
            <div class="logo-container">
                <div class="logo-icon">🎓</div>
                <h1>LMS Quiz System</h1>
                <p>Empowering education through interactive learning and assessment</p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="login-header">
                <h2>Welcome Back!</h2>
                <p>Sign in to access your account</p>
            </div>

            @if ($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           class="form-control" 
                           value="{{ old('email') }}" 
                           placeholder="Enter your email"
                           required 
                           autofocus>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control" 
                           placeholder="Enter your password"
                           required>
                </div>

                <div class="form-check">
                    <input type="checkbox" 
                           name="remember" 
                           id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn-login">
                    Sign In
                </button>
            </form>
        </div>
    </div>

    <script>
        // Global loader functionality
        const globalLoader = document.getElementById('globalLoader');

        function showLoader() {
            if (globalLoader) {
                globalLoader.classList.add('active');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.querySelector('form');

            loginForm.addEventListener('submit', function(e) {
                showLoader();
            });
        });
    </script>
</body>
</html>
