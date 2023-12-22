<!-- resources/views/books/edit.blade.php -->
@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .main {
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 2px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background: #0056b3;
        }

        .btn_div {
            width: 20%;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="main">
        <div style="padding-left: 30%;">
            <div class="btn_div">
                <a href="/books"> <button> Books list</button></a>
            </div>
        </div>
        <div class="container">
            <h1>Edit Book</h1>
            <form method="POST" action="{{ route('books.update', $book->BookID) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="Title" value="{{ $book->Title }}" required>
                </div>

                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" id="author" name="Author" value="{{ $book->Author }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <!-- <input type="text" class="form-control" id="author" name="Author" value="{{ $book->description }}" required> -->
                    <textarea id="description" name="description" style="width: 100%;" cols="10" rows="5"  required> {{ $book->description }}</textarea>
                </div>

                <div>
                    <div class="form-group">
                        <label for="author">Author:</label>
                        @if ($book->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . str_replace('public/', '', $book->image)) }}" alt="Book Image" width="150">

                        </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload New Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <!-- Add other fields as necessary -->

                    <button type="submit" class="btn btn-primary">Update Book</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.12/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
@endsection