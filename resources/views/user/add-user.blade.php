@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Font Awesome for icons (if needed) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        /* Optional: Custom CSS */
        /* Add your custom styles here */
    </style>
</head>
<body>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="container mt-4">
        <h3>Add User</h3>
        <hr>
        <a href="{{url('user-list')}}" class="btn btn-warning">User List</a>
        <hr>
        <form method="post" action="{{url('save-user')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name<span style="color: red;">*</span></label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter User Name" pattern="[A-Za-z ]+" title="Only letters and spaces are allowed" required>
                    @error('name')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email<span style="color: red;">*</span></label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                    @error('email')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="role" class="col-sm-2 col-form-label">Role<span style="color: red;">*</span></label>
                <div class="col-sm-6">
                    <select class="form-control" id="role" name="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password<span style="color: red;">*</span></label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password"  minlength="8" title = "Password length should be atleast 8 characters." required>
                    @error('password')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <!-- Bootstrap JavaScript (Optional: if you need Bootstrap JS components) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Optional: Include jQuery if Bootstrap components require it -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
@endsection
