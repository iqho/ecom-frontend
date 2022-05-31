@extends('layouts.app')
@push('styles')
<style type="text/css">
    .card-gallery {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        justify-content: center;
        align-items: center;
        margin: 10px 0;
    }

    .card-content {
        width: 22%;
        margin: 12px;
        box-sizing: border-box;
        float: left;
        text-align: center;
        border-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        padding-top: 10px;
        transition: .4s;
        min-height: 420px;
    }

    .card-content:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        transform: translate(0px, -8px);
        transition: .6s;
    }

    .card-content a {
        text-decoration: none;
        color: black;
    }

    .card-content img {
        width: 100%;
        max-height: 200px;
        text-align: center;
        margin: 0 auto;
        display: block;
    }

    .card-content p {
        text-align: center;
        color: #505050;
        padding: 5px;
        margin: 0px;
        font-size: 15px;
    }

    .card-content h6 {
        font-size: 16px;
        text-align: center;
        color: #222f3e;
        margin: 0;
    }

    .card-content ul {
        list-style-type: none;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0px;
        margin: 0px;
    }

    .card-content li {
        padding: 5px;
    }

    .card-content .fa {
        color: #ff9f43;
        font-size: 15px;
        transition: .4s;
        cursor: pointer;
    }

    .card-content .fa:hover {
        transform: scale(1.3);
        transition: .6s;
    }

    .card-content .button {
        text-align: center;
        font-size: 14px;
        color: #fff;
        width: 50%;
        padding: 5px;
        border: 0px;
        outline: none;
        cursor: pointer;
        margin-top: 5px;
    }

    .card-content .buy-1 {
        background-color: #2183a2;
        border-bottom-right-radius: 10px;
    }

    .card-content .buy-2 {
        background-color: #3b3e6e;
        border-bottom-left-radius: 10px;
    }

    .card-content .buy-1:hover {
        background-color: #470058;
    }

    .card-content .buy-2:hover {
        background-color: #583500;
    }

    @media(max-width: 1000px) {
        .card-content {
            width: 25%;
        }
    }

    @media(max-width: 750px) {
        .card-content {
            width: 100%;
        }
    }
</style>
@endpush
@section('content')

    @if(session('success'))
        <div class="row g-0 mb-2">
                <div id="success" class="col-12 text-center text-success" style="font-size: 18px">{{ session('success') }}</div>
        </div>
    @endif

<script>
swal("Hello world!");
</script>

    <div class="card-gallery">
        @foreach ($products as $product)
        <div class="card-content position-relative shadow">
            <div>
                <a href="{{ route('products.details', $product['id']) }}">
                    @if ($product['image'])
                    <img src="{{ config('app.backend_url') }}/product-images/{{ $product['image'] }}" class="card-img-top"
                        alt="..." style="width:100%; height:200px">
                    @else
                    <img src="https://www.freeiconspng.com/uploads/no-image-icon-11.PNG" class="card-img-top" alt="..."
                        style="width:100%; height:200px">
                    @endif
                </a>
            </div>
            <h4 class="mt-1 mb-0"><a href="{{ route('products.details', $product['id']) }}"
                    class="text-primary font-weight-bold">{{ $product['name'] }}</a></h4>
            <span class="badge bg-danger mt-1" style="font-size: 14px">{{ $product['category']['name'] ?? '' }}</span>
            <h6 class="mt-2">
                @foreach ($product['product_prices'] as $price)
                {{ $price['price_type']['name'] }} : <strong class="text-danger">৳{{ $price['amount'] }}</strong><br>
                @endforeach
            </h6>
            <p class="text-center">{!! Str::limit($product['description'], 60) !!}</p>
            <ul>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
            </ul>
            <div class="row g-0 position-absolute bottom-0 start-0 w-100">
                <a href="{{ route('add.to.cart', $product['id']) }}" class="col-6 button buy-2">Add to Cart</a><a class="col-6 button buy-1">Add to Wishlist</a>
            </div>
        </div>
        @endforeach
    </div>

@endsection
