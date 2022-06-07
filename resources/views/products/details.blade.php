@extends('layouts.app')
@section('title', 'Product Details Page')
@push('styles')
<style>
    .card-content ul {
        list-style-type: none;
        display: flex;
        justify-content: left;
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
</style>
@endpush
@section('content')

<div class="container p-2 h-100">
    <div class="row mx-4 my-2 g-0 border border-gray">
        <div class="col-md-8 d-flex align-items-center" style="font-size: 18px;">
            <a href="{{ url('/') }}" class="ms-2 font-weight-bold me-1" style="text-decoration: none">Home </a> > <span
                class="ms-1">{!! Str::limit($product['name'], 100) !!}</span>
        </div>
        <div class="col-md-4">
            <a href="{{ url('/') }}" class="btn btn-success float-end">Back to Home</a>
        </div>
    </div>

    @if(session('success'))
    <div class="row g-0 my-2">
        <div id="success" class="col-12 text-center text-success" style="font-size: 18px">{{ session('success') }}</div>
    </div>
    @endif

    <div class="row g-0 border border-gray-500 mx-4">
        <div class="col-md-4">
            @if ($product['image'])
            <img src="{{ config('app.backend_url') }}/product-images/{{ $product['image'] }}"
                class="img-fluid rounded mx-auto d-block" alt="{{ $product['name'] }}"
                style="max-height: 250px; width:100%">
            @else
            <img src="https://www.freeiconspng.com/uploads/no-image-icon-11.PNG"
                class="img-fluid rounded mx-auto d-block" alt="{{ $product['name'] }}">
            @endif
        </div>
        <div class="col-md-8 p-2 card-content">
            <h3 class="card-title pt-0 pb-2 px-1 border-bottom border-gray">{{ $product['name'] }}</h3>
            <div class="badge bg-danger" style="font-size: 14px">{{ $product['category']['name'] ?? '' }}</div>
            <h6 style="font-size: 18px;" class="mb-0 mt-2">
                {{ \Carbon\Carbon::now() }}
                @foreach ($product['product_prices'] as $price)
                @if (($price['start_date'] <= \Carbon\Carbon::now()) && ($price['end_date']> \Carbon\Carbon::now()))
                    <div class="mr-1">{{ $price['price_types']['name'] ?? '' }} : ৳ {{ $price['amount'] }}</div>
                    @break
                    @elseif ($price['price_type_id'] == 1)
                    <div class="mr-1">{{ $price['price_type']['name'] ?? '' }} : ৳{{
                        $price['amount'] }}</div>
                    @break
                    @else
                    <div class="mr-1">No Price</div>
                    @endif
                    @endforeach
            </h6>
            <div style="font-size: 18px; text-left">
                <ul>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
                <a class="btn btn-primary" href="{{ route('add.to.cart', $product['id']) }}">Add to Cart</a>
                <button class="btn btn-success">Order Now</button>
                <button class="btn btn-warning">Add to Wishlist</button>
            </div>
            <p class="card-text" style="text-align: justify;">
                <strong>Description: </strong> <br>
                {{ $product['description'] }}
            </p>
        </div>
    </div>
</div>
@endsection