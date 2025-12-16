<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎓</text></svg>">
    <title>Login - LMS Quiz System</title>
    <style>
        /* Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }

        /* Base */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f9;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            color: #222;
        }

        /* Top header (brand only) */
        .navbar {
            height: 60px;
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }

        .navbar .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 16px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.05rem;
        }

        .brand-mark {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255,255,255,0.12);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        /* Page wrapper - center the card, place a bit lower */
        main.page {
            max-width: 900px;
            margin: 0 auto;
            padding: 24px 16px;
            min-height: calc(100vh - 60px);
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        /* Single centered login card (no left side) */
        .login-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 12px 36px rgba(16,24,40,0.06);
            width: 100%;
            max-width: 480px;
            padding: 28px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 18px;
        }

        .login-header h1 {
            font-size: 1.4rem;
            color: #111;
            margin-bottom: 6px;
        }

        .login-header p {
            color: #6b7280;
            font-size: 0.95rem;
            margin: 0;
        }

        .form { margin-top: 12px; }
        .form-group { margin-bottom: 12px; }
        .form-label { display:block; margin-bottom:6px; font-weight:600; color:#374151; }
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #e6e6e6;
            font-size: 1rem;
            background: #fff;
        }
        .form-control:focus { outline: none; border-color: #4ade80; box-shadow: 0 0 0 6px rgba(74,222,128,0.06); }

        .form-check { display:flex; align-items:center; gap:8px; margin-bottom:12px; color:#374151; }
        .form-check input[type="checkbox"] { width:16px; height:16px; }

        /* Buttons - consistent with app */
        .btn, .btn-login {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            cursor: pointer;
            border: none;
            line-height: 1;
        }

        .btn-login {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: #fff;
            width: 100%;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            background: #fcebea;
            color: #611a15;
            border: 1px solid #f5c6cb;
            margin-bottom: 12px;
        }

        /* Global loader */
        .global-loader {
            position: fixed; inset: 0; display: none; align-items:center; justify-content:center; background: rgba(0,0,0,0.6); z-index:9999;
        }
        .global-loader.active { display:flex; }
        .loader-content { color: white; font-weight:700; padding:12px; }

        @media (max-width: 520px) {
            .login-card { padding: 18px; max-width: 420px; }
            .navbar .container { padding: 0 12px; }
        }
    </style>
</head>
<body>
    <!-- Global Loader -->
    <div class="global-loader" id="globalLoader" aria-hidden="true">
        <div class="loader-content">Loading...</div>
    </div>

    <!-- Header -->
    <header class="navbar" role="banner">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand" aria-label="LMS Quiz System home">
                <span class="brand-mark" aria-hidden="true">🎓</span>
                <span>LMS Quiz System</span>
            </a>
        </div>
    </header>

    <main class="page" role="main">
        <section class="login-card" aria-labelledby="login-heading">
            <div class="login-header">
                <h1 id="login-heading">Sign in to your account</h1>
                <p>Access the Quiz Maker and your quizzes after signing in.</p>
            </div>

            @if ($errors->any())
                <div class="alert" role="alert">
                    <ul style="margin:0 0 0 14px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="form" id="loginForm" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email address</label>
                    <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="name@example.com">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" class="form-control" required placeholder="Enter your password">
                </div>

                <div class="form-check">
                    <input id="remember" name="remember" type="checkbox" />
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn-login" aria-label="Sign in">Sign in</button>
            </form>
        </section>
    </main>

    <script>
        const globalLoader = document.getElementById('globalLoader');
        function showLoader(){ if(globalLoader) globalLoader.classList.add('active'); }
        function hideLoader(){ if(globalLoader) globalLoader.classList.remove('active'); }

        document.addEventListener('DOMContentLoaded', function(){
            const form = document.getElementById('loginForm');
            if (form) {
                form.addEventListener('submit', function(){
                    showLoader();
                });
            }
        });
    </script>
</body>
</html>