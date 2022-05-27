@extends('layouts.app')
@section('title', 'Product Details Page')
@section('content')
    <div class="container p-2 h-100">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('/') }}" class="btn btn-success float-end mb-2">Back to Home</a>
            </div>
        </div>
        <div class="row g-0 border border-gray-500">
            <div class="col-md-5">
                @if ($product['image'])
                    <img src="{{ config('app.backend_url') }}/product-images/{{ $product['image'] }}"
                        class="img-fluid rounded mx-auto d-block" alt="{{ $product['name'] }}">
                @else
                    <img src="https://www.freeiconspng.com/uploads/no-image-icon-11.PNG"
                        class="img-fluid rounded mx-auto d-block" alt="{{ $product['name'] }}">
                @endif
            </div>
            <div class="col-md-7 p-2 position-relative">
                <h3 class="card-title pt-0 pb-2 px-1 border-bottom border-gray">{{ $product['name'] }}</h3>
                <div class="badge p-2" style="font-size: 18px; background-color: #3b3e6e;">
                    @foreach ($product['product_prices'] as $price)
                        {{ $price['price_type']['name'] }} : <strong>৳{{ $price['amount'] }}</strong>
                    @endforeach
                </div>
                <p class="card-text">
                    <strong>Description: </strong> <br>
                    {{ $product['description'] }}
                </p>
                <div class="position-absolute bottom-0 start-0 ms-2 mb-2">
                    <button class="btn btn-lg btn-primary">Add to Cart</button>
                </div>
                <div class="position-absolute bottom-0 start-0 mb-2" style="margin-left:150px ">
                    <button class="btn btn-lg btn-warning">Add to Wishlist</button>
                </div>
            </div>
        </div>
    </div>
@endsection
