@extends('layout')

@section('content')
<section class="dashboard">
    <div class="main-content">
        <div class="product-list">
            <table id="productTable" class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price(Rs.)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="Product Image" width="100" height="100">
                            @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image" width="100" height="100">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <form>
                                <script src="
https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_NE9dbvYX8OxLvz" async> </script>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection