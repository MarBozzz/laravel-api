<nav class="header-navbar navbar navbar-expand-md navbar-light bg-dark shadow-sm bg-black">
    <div class="container-fluid ">
        <a class="navbar-brand d-flex align-items-center" href="{{route('home')}}">
            <div class="logo">
                MyLogo
            </div>
            {{-- config('app.name', 'Laravel') --}}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link " href="{{route('home')}}"><i class="fa-solid fa-earth-americas"></i>&ensp;Sito Guest</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li>
                    <form action="{{route('admin.projects.index')}}" class="navbar-search d-flex justify-center align-items-center" method="GET">
                        @csrf
                        <input class="form-control d-inline-block w-75" name="search" type="text" placeholder="Type name">
                        <button class="btn btn-primary d-inline-block" type="submit">Search</button>
                    </form>
                </li>
                <li class="nav-item mx-3 d-flex justify-content-evenly align-items-center">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        User: {{Auth::user()->name}}
                        &ensp;{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
