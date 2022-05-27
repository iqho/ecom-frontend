@extends('layouts.app')
@push('styles')
<style type="text/css">
    body {
        margin: 0;
        font-family: Nunito Sans;
    }

    h3 {
        text-align: center;
        font-size: 30px;
        margin: 0;
        padding-top: 10px;
    }

    a {
        text-decoration: none;
    }

    .gallery {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        justify-content: center;
        align-items: center;
        margin: 10px 0;
    }

    .content {
        width: 22%;
        margin: 12px;
        box-sizing: border-box;
        float: left;
        text-align: center;
        border-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        padding-top: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: .4s;
    }

    .content:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        transform: translate(0px, -8px);
        transition: .6s;
    }

    img {
        width: 200px;
        height: 200px;
        text-align: center;
        margin: 0 auto;
        display: block;
    }

    p {
        text-align: center;
        color: #505050;
        padding: 5px;
        margin: 0px;
        font-size: 15px;
    }

    h6 {
        font-size: 16px;
        text-align: center;
        color: #222f3e;
        margin: 0;
    }

    ul {
        list-style-type: none;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0px;
        margin: 0px;
    }

    li {
        padding: 5px;
    }

    .fa {
        color: #ff9f43;
        font-size: 15px;
        transition: .4s;
        cursor: pointer;
    }

    .fa:hover {
        transform: scale(1.3);
        transition: .6s;
    }

    button {
        text-align: center;
        font-size: 18px;
        color: #fff;
        width: 100%;
        padding: 5px;
        border: 0px;
        outline: none;
        cursor: pointer;
        margin-top: 5px;
    }

    .buy-1 {
        background-color: #2183a2;
        border-bottom-right-radius: 10px;
    }

    .buy-2 {
        background-color: #3b3e6e;
        border-bottom-left-radius: 10px;
    }

    .buy-1:hover {
        background-color: #470058;
    }

    .buy-2:hover {
        background-color: #583500;
    }

    @media(max-width: 1000px) {
        .content {
            width: 25%;
        }
    }

    @media(max-width: 750px) {
        .content {
            width: 100%;
        }
    }
</style>
@endpush
@section('content')

<div class="gallery">
    @foreach ($products as $product)
    <div class="content">
        <div class="border border-secondary">
            <a href="{{ route('products.details', $product['id']) }}">
                @if ($product['image'])
                <img src="{{ config('app.backend_url') }}/product-images/{{ $product['image'] }}" class="card-img-top"
                    alt="...">
                @else
                <img src="https://www.freeiconspng.com/uploads/no-image-icon-11.PNG" class="card-img-top" alt="...">
                @endif
            </a>
        </div>
        <h5 class="mt-1 mb-0"><a href="{{ route('products.details', $product['id']) }}">{{ $product['name'] }}</a></h5>
        <p class="d-inline-block text-truncate" style="max-width: 250px;">{{ $product['description'] }}</p>
        <h6>
            @foreach ($product['product_prices'] as $price)
            {{ $price['price_type']['name'] }} : <strong class="text-danger">৳{{ $price['amount'] }}</strong><br>
            @endforeach
        </h6>
        <ul>
            <li><i class="fa fa-star" aria-hidden="true"></i></li>
            <li><i class="fa fa-star" aria-hidden="true"></i></li>
            <li><i class="fa fa-star" aria-hidden="true"></i></li>
            <li><i class="fa fa-star" aria-hidden="true"></i></li>
            <li><i class="fa fa-star" aria-hidden="true"></i></li>
        </ul>
        <button class="buy-2 col-6">Add to Cart</button><button class="buy-1 col-6">Add to Wishlist</button>
    </div>
    @endforeach
</div>

@endsection
