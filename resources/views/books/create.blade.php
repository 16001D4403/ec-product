<!-- resources/views/books/create.blade.php -->
@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .main {
            padding-left: 30%;
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
        <div class="btn_div">
          <a href="/books">  <button> Books list</button></a>
        </div>
        <div class="container">

            <h1>Add New Book</h1>
            <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="Title" required>
                </div>

                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="Author" required>
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="ISBN" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre:</label>
                    <select id="genre" name="Genre">
                        <option value="Fiction">Fiction</option>
                        <option value="Non-Fiction">Non-Fiction</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Sci-Fi">Sci-Fi</option>
                        <option value="Biography">Biography</option>
                        <!-- Add more genres as needed -->
                    </select>
                </div>


                <div class="form-group">
                    <label for="publisher">Publisher:</label>
                    <input type="text" id="publisher" name="Publisher" required>
                </div>

                <div class="form-group">
                    <label for="year">Year of Publication:</label>
                    <input type="number" id="year" name="Year" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" id="price" name="Price" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" cols="10" rows="10" style="width: 100%;" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Book Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <button type="submit">Add Book</button>
            </form>
        </div>
    </div>
</body>

</html>

@endsection