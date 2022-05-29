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
<div class="container p-2 h-100" id="app">
    <div class="row mx-4 my-2 g-0 border border-gray">
        <div class="col-md-8 d-flex align-items-center" style="font-size: 18px;">
            <a href="{{ url('/vue') }}" class="ms-2 font-weight-bold me-1" style="text-decoration: none">Home </a> >
            <span class="ms-1">@{{ product.name }}</span>
        </div>
        <div class="col-md-4">
            <a href="{{ url('/vue') }}" class="btn btn-success float-end">Back to Home</a>
        </div>
    </div>
    <div class="row g-0 border border-gray-500 mx-4">
        <div class="col-md-4">
            <div v-if="product.image !== null ">
                <img :src="'http://127.0.0.1:8000/product-images/'+product.image" class="card-img-top" alt="...">
            </div>
            <div v-else>
                <img src="https://www.freeiconspng.com/uploads/no-image-icon-11.PNG" class="card-img-top" alt="...">
            </div>
        </div>
        <div class="col-md-8 p-2 card-content">
            <h3 class="card-title pt-0 pb-2 px-1 border-bottom border-gray">@{{ product.name }}</h3>
            <div v-if="product.category !== null" class="badge bg-danger mt-1" style="font-size: 14px">
                @{{ product.category.name }}
            </div>
            <div class="badge bg-danger mt-1" style="font-size: 14px" v-else>No Category</div>
            <h6 v-if="product.product_prices !== null " class="mt-2" v-for="price in product.product_prices">
                @{{ price.price_type.name }} : <strong class="text-danger">৳@{{ price.amount }}</strong>
            </h6>
            <h6 class="mt-2">No Price</h6>
            <div style="font-size: 18px; text-left">
                <ul>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                </ul>
                <button class="btn btn-primary me-1">Add to Cart</button>
                <button class="btn btn-success me-1">Order Now</button>
                <button class="btn btn-warning">Add to Wishlist</button>
            </div>
            <p v-if="product.description !==null" class="card-text" style="text-align: justify;">
                <strong>Description: </strong> <br>
                @{{ product.description }}
            </p>
            <p v-else>No Description</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const { createApp } = Vue

        createApp({
            data() {
                return {
                    product: null,
                }
            },
            created: function() {
                let uri = `http://127.0.0.1:8000/api/api-products/{{ $id }}`;
                axios
                    .get(uri)
                    .then(res => {
                        this.product = res.data.product;
                    })
            }
        }).mount('#app')
</script>
@endpush
