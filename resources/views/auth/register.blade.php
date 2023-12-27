<!-- resources/views/auth/register.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        body {
            background-color: #3b4465;
        }
    </style>
</head>

<body>
    <div class="register_start">
        <div class="card-container">
            <div class="container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="log-card">
                        <p class="title">Register </p>
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li style = "color:red;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <p class="message">Signup now and get full access to our app. </p>
                        <div class="input-group">
                            <p class="text" for="name">Name:</p>
                            <input type="text" placeholder="For Ex: Username" class="input" name="name" required>

                            <p class="text" for="email">Email:</p>
                            <input type="email" placeholder="For Ex: user@gmail.com" class="input" name="email" required>

                            <p class="text" for="password">Password:</p>
                            <input type="password" placeholder="For Ex: Welcome@123" class="input" name="password" required>

                            <p class="text" for="password_confirmation">Confirm Password:</p>
                            <input type="password" placeholder="For Ex: Welcome@123" class="input" name="password_confirmation" required>
                        </div>
                        <button class="btn" type="submit">Sign Up</button>
                        <p class="no-account">Already have an account ?<a class="link" href="{{url('/login')}}"> Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>