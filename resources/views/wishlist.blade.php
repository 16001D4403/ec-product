@extends('layout')

@section('content')
<section class="wishlist">
    <div class="container">
        <h2>My Wishlist</h2>
        <ul>
            @foreach ($wishlistItems as $wishlistItem)
            <li>
                <div>
                    <img src="{{ asset($wishlistItem->product->image) }}" alt="Product Image" width="100" height="100">
                </div>
                <div>
                    <h3>{{ $wishlistItem->product->name }}</h3>
                    <p>{{ $wishlistItem->product->description }}</p>
                    <p>Price: {{ $wishlistItem->product->price }}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection
