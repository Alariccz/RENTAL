<x-guest-layout>
    <head>
        <title>Sign In</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        /* Main container */
        .login-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f5f6fa;
            padding: 2rem 1rem;
        }
        
        /* Content wrapper */
        .login-content {
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        
        /* Title styling */
        .login-title {
            font-size: 28px;
            font-weight: 750;
            color: #0a1442;
            margin-bottom: 8px;
            font-family: 'Poppins';
        }
        
        /* Subtitle styling */
        .login-subtitle {
            font-size: 16px;
            color: #9ca3af;
            margin-bottom: 24px;
        }
        
        /* Card styling */
        .login-card {
            background-color: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        /* Form group */
        .form-group {
            margin-bottom: 24px;
            text-align: left;
        }
        
        /* Form label */
        .form-label {
            display: block;
            font-size: 16px;
            font-weight: 600;
            color: #0a1442;
            margin-bottom: 12px;
            font-family: 'Poppins';
        }
        
        /* Form input */
        .form-input {
            width: 100%;
            padding: 14px 20px;
            border: 1px solid #e5e7eb;
            border-radius: 9999px;
            font-size: 15px;
            color: #1f2937;
            transition: border-color 0.2s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
        }
        
        /* Forgot password link */
        .forgot-password {
            display: block;
            text-align: right;
            font-size: 14px;
            color: #a5b4fc;
            text-decoration: none;
            margin-top: 8px;
        }
        
        .forgot-password:hover {
            color: #818cf8;
        }
        
        /* Primary button (Sign In) */
        .btn-primary {
            display: block;
            width: 100%;
            padding: 14px;
            background-color: #4743FB;
            color: white;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            border: none;
            border-radius: 9999px;
            cursor: pointer;
            margin-top: 24px;
            transition: background-color 0.2s;
            box-shadow: 0 10px 30px rgba(99, 90, 229, 0.7); /* Shadow ungu kebiruan */
        }
        
        .btn-primary:hover {
            background-color: #437afb;
        }
        
        /* Secondary button (Create Account) */
        .btn-secondary {
            margin-top: 30px;
            display: block;
            width: 100%;
            padding: 14px;
            background-color: white;
            color: #1f2937;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            border: 1px solid #e5e7eb;
            border-radius: 9999px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        
        .btn-secondary:hover {
            background-color: #f9fafb;
        }
        
        /* Hide Jetstream validation errors by default - we'll style them if needed */
        .validation-errors {
            margin-bottom: 16px;
            color: #ef4444;
            font-size: 14px;
        }
    </style>

    <div class="login-container">
        <div class="login-content">
            <h2 class="login-title">Sign In & Drive</h2>
            <p class="login-subtitle">We will help you get ready today</p>
            
            <div class="login-card">
                <div class="validation-errors">
                    <x-validation-errors />
                </div>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="form-input" placeholder="ppG0m@example.com" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="form-input">
                        
                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">
                                Forgot My Password
                            </a>
                            
                        @endif
                    </div>

                    <button type="submit" class="btn-primary">
                        Sign In
                    </button>
                    <a href="{{ route('register') }}" class="btn-secondary">
                        Create New Account
                    </a>    
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>
