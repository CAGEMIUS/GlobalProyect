<style>
    .MainNav{
        background-color: #ffffff; 
        border-bottom: 5px solid #F0314C; 
        font-size: 20px;
    }

    .ButtonLogin{
        background: none; 
        border: none; 
        display: flex; 
        align-items: center; 
        font-size: 20px;
    }

    .ToggleUser{
        background-color: red;
    }

    .Items{
        text-align: center;
    }

</style>

<nav class="MainNav navbar navbar-expand-md navbar-dark fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/2.jpg') }}" alt="Logo" style="height: 100px; width: auto;">
        </a>
        <button class="navbar-toggler bg-danger" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ Auth::check() ? route('dashboard') : route('welcome') }}">{{ __('Top page') }}</a>
                </li>
                <!-- Fin del botón -->
                @if (Route::has('login'))
                    @auth
                    <!-- Aquí se agrega el botón -->
                    <li class="nav-item dropdown">
                        @guest
                            <a class="nav-link btn btn-link text-danger" href="{{ route('login') }}">{{ __('Log in') }}</a>
                        @else
                            <button class="ButtonLogin nav-link btn btn-link text-danger dropdown-toggle" onclick="toggleUserMenu()">
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                                <ul class="ToggleUser dropdown-menu dropdown-menu-right " id="userMenu" style="border: none;">
                                    <div class="Items">
                                        <li>
                                            <h6 class="dropdown-item text-warning " href="{{ route('profile.edit') }}"><b>{{ Auth::user()->email }}</b></h6>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-warning " href="{{ route('profile.edit') }}"><b>{{ __('Your profile') }}</b></a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-warning " href="{{ route('checkcompra') }}"><b>{{ __('Your orders') }}</b></a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-warning "><b>{{ __('Logout') }}</b></button>
                                            </form>
                                        </li>
                                    </div>
                                </ul>
                        @endguest
                    </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="{{ route('login') }}">{{ __('Log in') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('shop') }}">{{ __('Shop') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('service') }}">{{ __('Customer service') }}</a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-pill badge-dark" style="background-color: #F0314C;">
                            <i class="fa fa-shopping-cart" style="font-size: 24px;"></i> {{ \Cart::getTotalQuantity()}}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width: 450px; padding: 0px; border-color: #9DA0A2;">
                        <ul class="list-group" style="margin: 20px;">
                            @include('partials.cart-drop')
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    function toggleUserMenu() {
        var menu = document.getElementById("userMenu");
        menu.classList.toggle("show");
    }

    document.addEventListener("click", function(event) {
        var menu = document.getElementById("userMenu");
        var button = document.querySelector(".ButtonLogin");
        
        if (menu.classList.contains("show") && event.target !== menu && event.target !== button && !button.contains(event.target)) {
            menu.classList.remove("show");
        }
    });
</script>

