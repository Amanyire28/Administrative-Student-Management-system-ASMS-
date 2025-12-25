<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: #ffffff;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            padding: 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .school-logo {
            width: 80px;
            height: 80px;
            background: #800000;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 32px;
            font-weight: bold;
        }

        .school-name {
            color: #000000;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .portal-subtitle {
            color: #000000;
            font-size: 14px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .login-title {
            color: #000000;
            font-size: 16px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .form-control {
            border: 2px solid #cccccc;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            margin-bottom: 15px;
            transition: border-color 0.3s;
            height: auto;
            line-height: 1.5;
            color: #000000;
        }

        .form-control:focus {
            border-color: #000000;
            box-shadow: none;
            outline: none;
        }

        .input-group-text {
            background: transparent;
            border: 2px solid #cccccc;
            border-right: none;
            border-radius: 8px 0 0 8px;
            color: #666666;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 15px;
            transition: border-color 0.3s;
        }

        .input-group:focus-within .input-group-text {
            border-color: #000000;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 8px 8px 0;
            margin-bottom: 0;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .btn-login {
            background: #800000;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 14px;
            font-weight: 600;
            width: 100%;
            margin-top: 8px;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background: #5f0000;
            color: white;
        }

        .forgot-password {
            color: #800000;
            text-decoration: none;
            font-size: 13px;
            margin-top: 15px;
            display: inline-block;
        }

        .forgot-password:hover {
            color: #5f0000;
            text-decoration: underline;
        }

        .footer-text {
            color: #999;
            font-size: 11px;
            margin-top: 20px;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .form-check-input {
            border: 2px solid #cccccc;
            background-color: transparent;
        }

        .form-check-input:checked {
            background-color: #800000;
            border-color: #800000;
        }

        .form-check-input:focus {
            border-color: #800000;
            box-shadow: none;
            outline: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- School Logo -->
            <div class="school-logo w-11 h-11">
    <img src="{{ asset('storage/' . school_setting('school_logo')) }}"
         alt="{{ school_setting('school_name') }}"
         class="w-full h-full object-contain rounded-lg">
</div>

            <!-- School Name -->
            <h1 class="school-name">{{ config('app.name') }}</h1>
            <p class="portal-subtitle">ADMIN PORTAL</p>

            <!-- Login Title -->
            <h2 class="login-title">LOGIN TO YOUR ACCOUNT</h2>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="fas fa-user" style="color: #666666;"></i>
                    </span>
                    <input type="email"
                           class="form-control"
                           name="email"
                           placeholder="Email Address"
                           value="{{ old('email') }}"
                           required
                           autofocus>
                </div>

                <!-- Password Input -->
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="fas fa-lock" style="color: #666666;"></i>
                    </span>
                    <input type="password"
                           class="form-control"
                           name="password"
                           placeholder="Password"
                           required>
                </div>

                <!-- Remember Me -->
                <div class="form-check text-start mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="color: #000000;">
                        Remember me
                    </label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-login">
                    SIGN IN
                </button>
            </form>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-password">
                    Forgot your Password? Reset Here!
                </a>
            @endif

            <!-- Footer -->
            <div class="footer-text">
                © {{ date('Y') }} ASMS System. All rights Reserved.
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
