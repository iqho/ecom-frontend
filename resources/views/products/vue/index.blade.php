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
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: .4s;
    }

    .card-content:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, .2);
        transform: translate(0px, -8px);
        transition: .6s;
    }
    .card-content a {
        text-decoration: none;
        color:black;
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

    .card-content button {
        text-align: center;
        font-size: 18px;
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
<div id="app">
    <div class="card-gallery">
        <div class="card-content" v-for="(value, key) in products" :key="key">
            <div v-if="value.image !== null ">
                <img :src="'http://127.0.0.1:8000/product-images/'+value.image" class="card-img-top" alt="...">
            </div>
            <div v-else>
                <img src="https://www.freeiconspng.com/uploads/no-image-icon-11.PNG" class="card-img-top" alt="...">
            </div>
            <h5 class="mt-1 mb-0">@{{ value.name }}</h5>
            <p>@{{ value.description }}</p>
            <h6>$100.00</h6>
            <ul>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                <li><i class="fa fa-star" aria-hidden="true"></i></li>
            </ul>
            <button class="buy-2 col-6">Add to Cart</button><button class="buy-1 col-6">Add to Wishlist</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    message: 'Hello Vue!',
                    products: null,
                }
            },
            created: function() {
                axios
                    .get("http://127.0.0.1:8000/api/api-products")
                    .then(res => {
                        this.products = res.data.product;
                    })
            }
        }).mount('#app')
</script>
@endpush
