<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Komuna') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/komuna.css') }}" rel="stylesheet">
    <style>
        .navbar {
            background-color: darkblue;
            color: chartreuse;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 5;
        }

        * a:hover {
            background-color: black;
            color: white;
            text-decoration: none!important;
        }

        .py-4 {

            @if (Auth::guard('admin')->check() && Auth::guard('web')->check())
                margin-top: 144px;
            @else
                margin-top: 72px;
            @endif
        }

        #dashboard-button {
            z-index: 3; 
            position: fixed; 

            @if (Auth::guard('admin')->check() && Auth::guard('web')->check())
                top: 78px;
            @else
                top: 33px;
            @endif
            
            left: 50px; 
            border-radius: 50%;
            background-color: darkred;
            color: white;
            line-height:100%;
            padding-left: 15px;
            padding-right: 15px;
            padding-top: 36px;
            padding-bottom: 36px;
        }

        #dashboard-button:hover {
            background-color: darkgreen;
            color: white;
        }
        
        #start_project {
            border-radius: 50%; 
            height: 100px; 
            background-color:darkgreen; 
            color:white; 
            padding: 25px; 
            line-height:100%;
        }

        #start_project:hover {
            background-color: blue;
        }

    </style>
</head>
<body>
    <div id="app">        
        {{--  <nav style="position:fixed; top:0; width:100%;" class="navbar navbar-expand-md navbar-laravel navbar-fixed-top">  --}}
        
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container">
                @guest
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h1>{{ config('app.name', 'Komuna') }}</h1>
                </a>
                @else
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <h1>{{ config('app.name', 'Komuna') }}</h1>
                </a>
                @endguest

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <form action="/home" method="get" role="form">
                        {{ csrf_field() }}
                        <button id="dashboard-button" name="dashboard-button" value="dashboard-button" type="submit"><b>Naar<br />Dashboard</b></button>
                    </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('user.login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            @component('components.who')

                            @endcomponent
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>

</html>
