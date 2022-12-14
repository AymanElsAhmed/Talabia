<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Talabia</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    @yield('links')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body class="bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm mb-5">
            <div class="container">
                <a class="navbar-brand d-flex justify-content-between align-items-center" href="{{ url('/') }}">
                    <i class="fa-solid fa-truck fa-2x"></i>&nbsp;
                    <em>Talabia</em>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('??????????????????') }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item "
                                            href="{{ route('posts.index') }}">{{ __('???? ??????????????????') }}</a>
                                        @authVendor
                                    <li><a class="dropdown-item "
                                            href="{{ route('posts.create') }}">{{ __('?????????? ????????') }}</a>
                                        @endauthVendor
                                </ul>
                            </li>
                            @authVendor
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('????????????????') }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item "
                                            href="{{ route('products.index') }}">{{ __('???? ????????????????') }}</a></li>
                                    <li><a class="dropdown-item "href="{{ route('products.create') }}">
                                            {{ __('???????? ????????') }}</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('??????????????') }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('clients.index') }}">{{ __('???? ??????????????') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"href="{{ route('clients.create') }}">{{ __('???????? ????????') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endauthVendor

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('????????????????') }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item " href="{{ route('orders.index') }}">
                                            {{ __('???? ????????????????') }}
                                        </a>

                                    <li>
                                        @authVendor
                                        <a class="dropdown-item " href="{{ route('vendors.index') }}">
                                            {{ __('???????????????? ??????????????') }}
                                        </a>
                                    </li>
                                    @endauthVendor

                                </ul>
                            </li>
                            @authDelivery

                            <a class="nav-item nav-link position-relative" href="{{ route('wishlist.index') }}"
                                role="button">
                                ??????????????
                                <span class="position-absolute top-0 translate-middle badge rounded-pill bg-danger">
                                    {{ auth()->user()->wishlists->count() }}
                                </span>
                            </a>

                            @endauthDelivery

                            @if (auth()->user()->is_admin == '1')
                                <a class="nav-item nav-link" href="{{ route('admin.products.index') }}" role="button">
                                    ???????? ????????????
                                </a>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('login') }}">{{ __('????????') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('?????????? ??????????') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" v-pre href="#">
                                    <div class="d-flex flex-md-row-reverse">
                                        <div
                                            class="d-flex flex-column justify-content-center align-items-center text-capitalize">
                                            <span class="text-white">
                                                {{ Auth::user()->name }}
                                            </span>
                                            <small class="text-muted fw-bold">
                                                @if (Auth::user()->role === 'vendor')
                                                    ????????
                                                @else
                                                    ??????????
                                                @endif
                                            </small>
                                        </div>
                                        <div class="mx-2 d-sm-none d-md-block">
                                            <img src="{{ asset('profilepic') . '/' . auth()->user()->profile_pic }}"
                                                class="rounded-circle card-img-top"
                                                style="width:50px; height:50px; object-fit:cover">
                                        </div>
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profiles.show', auth()->user()->id) }}">
                                        {{ __('??????????') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('profiles.edit', auth()->user()->id) }}">
                                        {{ __('??????????') }}
                                    </a>


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('????????') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 min-vh-100">
            @yield('content')
        </main>

        <footer class="mt-5 p-3 bg-dark text-white position-absolute w-100">

            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-12 col-12 border-bottom pb-5 mb-5">
                        <div class="d-flex">
                            <a href="/" class="navbar-brand">
                                <span class="brand-text">Talabia</span>
                            </a>

                            <ul class="list-unstyled d-flex justify-content-between ms-auto">
                                <li>
                                    <a href="#" class="">
                                        <i class="fa-brands fa-square-facebook fa-2x"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="">
                                        <i class="fa-brands fa-square-instagram fa-2x"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="">
                                        <i class="fa-brands fa-square-whatsapp fa-2x"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="">
                                        <i class="fa-brands fa-youtube fa-2x"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-7 col-12">
                        <ul class="d-flex list-unstyled">
                            <li class="me-3">
                                <a href="#section_1" class="">????????????????</a>
                            </li>

                            <li class="me-3">
                                <a href="#section_2" class="">??????????</a>
                            </li>

                            <li class=""><a href="#section_7" class="footer-menu-link">??????????????</a>
                            </li>
                        </ul>
                    </div>


                    <div class="col-lg-5 col-12 ms-lg-auto">
                        <div class="copyright-text-wrap d-flex align-items-center">
                            <p class="copyright-text ms-lg-auto me-4 mb-0">???????? ?????????? &copy; Talabia.

                                <br>???? ???????????? ????????????.
                                <a href="#section_1" class="bi-arrow-up arrow-icon custom-link"></a>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

    </div>
    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>
