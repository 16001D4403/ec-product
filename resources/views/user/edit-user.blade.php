@extends('layout')

@section('content')
<div class="container mt-4">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <h3>Edit User</h3>
    <hr>
    <a href="{{ url('user-list') }}" class="btn btn-warning">User List</a>
    <hr>
    <form method="post" action="{{ url('update-user') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        
        <!-- Input fields for other user details -->
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name<span style="color: red;">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" placeholder="Enter Name" required>
                @error('name')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email<span style="color: red;">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="email" name="email" value="{{ $data->email }}" placeholder="Enter Email" required>
                @error('email')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="role" class="col-sm-2 col-form-label">Role<span style="color: red;">*</span></label>
            <div class="col-sm-6">
                <select class="form-control" id="role" name="role" required>
                    <option value="user" {{ $data->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $data->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Password<span style="color: red;">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="password" name="password" placeholder="Enter password" value="{{ $data->password }}" required>
                @error('password')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<!-- Bootstrap JavaScript (Optional: if you need Bootstrap JS components) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Optional: Include jQuery if Bootstrap components require it -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
@endsection
