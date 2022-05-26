@extends('layouts.app')
@section('content')
    <div id="app">
        <h1>@{{ message }}</h1>

        <div>
            <div v-for="(value, key) in products" :key="key" class="border border-danger">
                <h1>@{{ value.name }}</h1>
                <p>@{{ value.description }}</p>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                      <div class="card h-100">
                        <img src="@{{ value.image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">@{{ value.name }}</h5>
                          <p class="card-text">T@{{ value.description }}</p>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">@{{ value.created_at }}</small>
                        </div>
                      </div>
                    </div>
                  </div>
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
