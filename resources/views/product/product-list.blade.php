@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: Font Awesome for icons (if needed) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .custom-width {
        max-width: 100px; /* Set your desired maximum width here */
    }
    </style>
</head>

<body>
    <div class="container mt-4">
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
        @endif

        <h3>Product List</h3>
        <hr>
        <a href="{{url('add-product')}}" class="btn btn-primary mb-3">Add New Product</a>

        <table class="table">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach ($data as $prod)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$prod->name}}</td>
                    <td>{{$prod->price}}</td>
                    <td>{{$prod->description}}</td>
                    <td>
                        <a href="{{url('edit-product/'.$prod->id)}}" class="btn btn-primary custom-width">Edit</a>
                        <button type="button" class="btn btn-danger custom-width" onclick="confirmDelete({{ $prod->id }})">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JavaScript (Optional: if you need Bootstrap JS components) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Optional: Include jQuery if Bootstrap components require it -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this item!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with redirection to delete URL
                    window.location.href = "{{ url('delete-product') }}/" + productId;
                }
            });
        }
    </script>
</body>

</html>
@endsection
