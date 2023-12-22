@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>

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
    <h1>Create Order</h1>
    <form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_NE9dbvYX8OxLvz" async> </script> </form>
    {{-- <p>Order ID: {{ $order->id }}</p>
    <p>Amount: {{ $order->amount }}</p> --}}

    {{-- <!-- Add a button or form to initiate the payment -->
    <form action="{{ url('/handle-payment') }}" method="post">
        @csrf
        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="{{ config('services.razorpay.key_id') }}"
            data-amount="{{ $order->amount }}"
            data-currency="INR"
            data-order_id="{{ $order->id }}"
            data-buttontext="Pay with Razorpay"
            data-name="Your Company Name"
            data-description="Payment for Order ID: {{ $order->id }}"
            data-image="https://your-logo-url.png"
            data-prefill.name="Your Name"
            data-prefill.email="your.email@example.com"
            data-theme.color="#F37254"
        ></script>
        <input type="hidden" name="razorpay_order_id" value="{{ $order->id }}">
    </form> --}}


    <!-- Bootstrap JavaScript (Optional: if you need Bootstrap JS components) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Optional: Include jQuery if Bootstrap components require it -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
@endsection