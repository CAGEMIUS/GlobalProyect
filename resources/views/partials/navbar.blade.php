<nav class="navbar navbar-expand-md navbar-dark fixed-top shadow-sm" style="background-color: #000000;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo page.jpg') }}" alt="Logo" style="height: 100px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ Auth::check() ? route('dashboard') : route('welcome') }}">{{ __('Top page') }}</a>
                        </li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Log in') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                    @endauth
                        <li class="nav-item">
                            <a class="nav-link text-white" href="">{{ __('Products') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('shop') }}">{{ __('Shop') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('service') }}">{{ __('Customer service') }}</a>
                        </li>
                @endif
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle"
                       href="#" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"
                    >
                        <span class="badge badge-pill badge-dark">
                            <i class="fa fa-shopping-cart"></i> {{ \Cart::getTotalQuantity()}}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width: 450px; padding: 0px; border-color: #9DA0A2">
                        <ul class="list-group" style="margin: 20px;">
                            @include('partials.cart-drop')
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
