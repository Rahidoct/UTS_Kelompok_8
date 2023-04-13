<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pusat Belanja</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    Pusat Belanja
                </a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto justify-content-end">
                        <!-- Navbar links -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto text-white">
                        <li class="nav-item active">
                            <a href="{{ url('/') }}" class="nav-link text-white">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('carts.index') }}">Cart 
                                {{-- <span class="badge badge-pill badge-success">{{ $cartCount }}</span> --}}
                            </a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                {{-- <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li> --}}
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div class="vr"></div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"> 
                                        {{-- href="{{ route('profile') }}" --}}
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item"> 
                                        {{-- href="{{ route('transactions') }}" --}}
                                        {{ __('Transactions') }}
                                    </a>
                                    <div class="dropdown-divider"></div> <!-- Ini adalah garis pemisah menu dropdown -->
                                    <a class="dropdown-item" href="{{ route('categories.index') }}">
                                        {{ __('Categories') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('products.index') }}">
                                        {{ __('Products') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>                                
                            </li>                                       
                        @endguest
                        
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        $(document).ready(function() {
            $('.btn-number').click(function(e) {
                e.preventDefault();
    
                var fieldName = $(this).attr('data-field');
                var type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());
    
                if (!isNaN(currentVal)) {
                    if (type == 'minus') {
                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                    } else if (type == 'plus') {
                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                    }
                }
            });
    
            $('.input-number').change(function() {
                $('#update-form').submit();
            });
        });
    </script>
</body>
</html>
