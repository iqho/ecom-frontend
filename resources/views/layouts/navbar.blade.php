<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container g-0 shadow-sm pb-2 px-md-4 px-2">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="https://winwinsp.com/site/images/logo.png" style="max-height: 30px; width:200px" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ps-sm-2 mb-sm-5">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('products.index') ? 'active' : '' }} py-0 custom-border-right"
                        aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-0 custom-border-right {{ Request::routeIs('products.vue.index') ? 'active' : '' }}"
                        href="{{ url('/vue') }}">Vue Page</a>
                </li>

                @guest
                @if (Route::has('login'))
                <li class="nav-item" id="LoginButton">
                    <a class="nav-link py-0 custom-border-right {{ Request::routeIs('login') ? 'active' : '' }}"
                        href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item" id="RegisterButton">
                    <a class="nav-link py-0 custom-border-right {{ Request::routeIs('register') ? 'active' : '' }}"
                        href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link py-0 custom-border-right dropdown-toggle" href="#"
                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
                <li class="nav-item" id="userNameButton" v-cloak>
                    <a class="nav-link py-0 custom-border-right" href="#" id="myName">userName</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-0 custom-border-right {{ Request::routeIs('cart') ? 'active' : '' }}"
                        href="{{ route('cart') }}">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-0 custom-border-bottom" href="#">Contact</a>
                </li>
                <li class="nav-item custom-border-left" id="logoutButton" v-cloak>
                    <a class="nav-link py-0" href="javascript:onLogout()">Logout</a>
                </li>
            </ul>

            <div class="btn-group mx-auto">
                <button type="button" class="btn btn-outline position-relative cart-btn dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-cart-shopping fa-xl"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count((array) session('cart')) }}
                    </span>
                </button>
                <div class="dropdown-menu" style="width: 200px">

                    @if (session('cart'))
                    @foreach (session('cart') as $id => $details)
                    <div class="row cart-detail">
                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                            @if ($details['image'])
                            <img src="{{ config('app.backend_url') }}/product-images/{{ $details['image'] }}" />
                            @else
                            <img src="https://www.freeiconspng.com/uploads/no-image-icon-11.PNG" />
                            @endif

                        </div>
                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                            <p>{{ $details['name'] }}</p>
                            <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count">
                                Quantity:{{ $details['quantity'] }}</span>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center">
                            <a href="{{ route('cart') }}" class="btn btn-primary w-100">View all</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>
@push('scripts')
<script>
    document.getElementById("logoutButton").style.display = "none";
        document.getElementById("userNameButton").style.display = "none";
        function onLogout() {
            if (localStorage.getItem('authToken') !== null) {
                localStorage.removeItem('authToken');
                localStorage.removeItem('userData');
                window.location.href = "/login";
                alert('Logout Successfully !');

            }
        }

        if (localStorage.getItem('userData') !== null) {
            document.getElementById("logoutButton").style.display = "block";
            document.getElementById("userNameButton").style.display = "block";

            document.getElementById("LoginButton").style.display = "none";
            document.getElementById("RegisterButton").style.display = "none";

             var userName = JSON.parse(localStorage.getItem("userData"));
             $('a#myName').text(userName.name);
        }
</script>
@endpush
