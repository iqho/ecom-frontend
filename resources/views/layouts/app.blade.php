<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title', 'Welcome to Win Win Service Provider') </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    @stack('styles')
</head>

<body>
    <span class="screen-darken"></span>
    <header class="section-header py-4">
        <div class="container">
            <h2>Win WIn Service Provider</h2>
        </div>
    </header>
    <div class="container">

        <button data-trigger="navbar_main" class="d-lg-none btn btn-warning" type="button"> Show navbar </button>
        <button data-trigger="card_mobile" class="d-lg-none btn btn-warning" type="button"> Show card </button>

        <!-- ============= NAVBAR ============== -->
        <nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <div class="offcanvas-header">
                    <button class="btn-close float-end"></button>
                </div>
                <a class="navbar-brand" href="#">Win WIn Service Provider</a>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#"> Menu item </a></li>
                    <li class="nav-item"><a class="nav-link" href="#"> Menu item </a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> Dropdown right </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
                            <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <section class="section-content py-5">
            <main>
                <div class="p-4">
                    @yield('content')
                </div>
            </main>
            <article class="card mobile-offcanvas bg-light" id="card_mobile">
                <div class="card-body">
                    <div class="offcanvas-header">
                        <button class="btn-close float-end"></button>
                    </div>
                    <h5>This card becomes offcanvas on mobile view</h5>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </article>
        </section>

    </div><!-- container //  -->

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Vuejs CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
    <script src="https://unpkg.com/vue@next"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/custom-scripts.js') }}"></script>
    @stack('scripts')

</body>

</html>