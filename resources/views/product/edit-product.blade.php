@extends('layout')

@section('content')
<div class="container mt-4">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <h3>Edit Product</h3>
    <hr>
    <a href="{{ url('product-list') }}" class="btn btn-warning">Product List</a>
    <hr>
    <form method="post" action="{{ url('update-product') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        
        <!-- Input fields for other product details -->
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
            <label for="price" class="col-sm-2 col-form-label">Price<span style="color: red;">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="price" name="price" value="{{ $data->price }}" placeholder="Enter Price" required>
                @error('price')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Description<span style="color: red;">*</span></label>
            <div class="col-sm-6">
                <textarea class="form-control" id="description" name="description" placeholder="Enter Description" required>{{ $data->description }} </textarea>
                @error('description')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
                <!-- Display image -->
            <div class="form-group row">
            <label for="image" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-6">
                @if($data->image)
                    <img src="{{ asset($data->image) }}" alt="Product Image" class="img-thumbnail">
                @else
                    <p>No image available</p>
                @endif
                <input type="file" name="image" accept="image/*">
                <p style="font-size: 12px;" > Only png, jpeg and gif are accepted.</p>
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
