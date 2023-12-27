<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        body {
            background-color: #3b4465;
        }
    </style>
</head>

<body>
    <div class="login_start">
        <div class="card-container">
            <div class="container">
                <form method="POST" action="{{ route('login') }}">
                    <div class="log-card">
                        <p class="heading" style="text-align:center">PHP Council</p>
                            <p style="text-align:center">Log in to your account to continue.</p>
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('status'))
                        <p style="color: red;">{{ session('status') }}</p>
                        @endif
                        <div class="input-group">
                            @csrf
                            <p class="text">Email</p>
                            <input class="input" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="For Ex: user@gmail.com" required autofocus>
                            @error('email')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                            <!-- <input class="input" type="username" placeholder="For Ex: Jayakrishna007"> -->
                            <p class="text">Password</p>
                            <input type="password" class="input" id="password" name="password" placeholder="Enter Password" required>
                            @error('password')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="password-group">
                            <div class="checkbox-group">
                            </div>
                            <!-- <a href="" class="forget-password">Forget Password</a> -->
                        </div>

                        <button class="btn" type="submit">Sign In</button>

                        <p class="no-account">Don't Have an Account ?<a class="link" href="{{ url('/register') }}"> Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>