<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Watch Movies</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('css')
</head>
<body>
    <div id="app">
        <nav id="MainNavBar" class="navbar navbar-expand-md shadow-sm py-2 fixed-top">
            <div class="container">
                <a class="navbar-brand" href="@isset($User) /home @else / @endisset ">
                    Watch Movies
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @isset($User)
                        <!-- Search Engine * I'm going to remove it for now.-->
                        
                        <!--<ul class="navbar-nav mr-auto">
                            <form id="NavSearchEngine" class="form" action="" method="get">
                                <input type="text" placeholder="Search movie" 
                                name="SearchString" class="form-control">
                            </form>
                        </ul>-->
                    @endisset
                   
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/">Create an Account</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a  id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img id="NavProfileImage" src="{{"/storage/".$User->profile_image ?? "/storage/profile/images/default.jpeg"}}" alt=""> 
                                    {{ strtoupper($User->nickname) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ "/profile/".$User->nickname }}">
                                        Configurations
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>


    @yield('vue')
</body>
</html>
