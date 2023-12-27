@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

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
        <h3>Add Product</h3>
        <hr>
        <a href="{{url('product-list')}}" class="btn btn-warning">Product List</a>
        <hr>
        <form method="post" action="{{url('save-product')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name<span style="color: red;">*</span></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" maxlength="255" placeholder="Enter Product Name" required pattern="^[a-zA-Z0-9\s]+$" title="Only letters, numbers, and spaces are allowed." required>
                    @error('name')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price<span style="color: red;">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" required>
                @error('price')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description<span style="color: red;">*</span></label>
            <div class="col-sm-6">
                <textarea class="form-control" id="description" name="description" maxlength="255" placeholder="Enter Description" required></textarea>
                @error('description')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control-file" id="image" name="image" accept="image/jpeg, image/png, image/jpg, image/gif">
                    <p style="font-size: 12px;" > Only png, jpeg and gif are accepted.</p>
                    @error('image')
                        <div class="alert alert-danger mt-2" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>
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