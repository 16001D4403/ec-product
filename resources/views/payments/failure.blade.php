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
    
    <h1>Payment failed</h1>

    <p>Sorry, your payment could not be processed. Please try again.</p>

    <!-- Display the error message, if available -->
    @isset($error)
        <p>Error: {{ $error }}</p>
    @endisset

    <!-- Bootstrap JavaScript (Optional: if you need Bootstrap JS components) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Optional: Include jQuery if Bootstrap components require it -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
@endsection