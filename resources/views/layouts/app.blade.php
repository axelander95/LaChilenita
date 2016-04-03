<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>La Chilenita | @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <style>
        body 
        {
            font-family: 'Raleway', sans-serif;
        }
        #map {
            min-height: 200px;
            width: 100%;
        }
        .panel-default .panel-title {
            color: #fff;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <b>LaChilenita</b>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}"><b>INICIO</b></a></li>
                    @if (!Auth::guest())
                        @if (Auth::user()->role_id == 1)
                            <li>
                                <a href="{{ url('/admin') }}">
                                    <strong>PANEL DE ADMINISTRACIÓN</strong>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role_id == 2)
                            <li>
                                <a href="{{ url('/supervisor') }}">
                                    <strong>PANEL DE SUPERVISIÓN</strong>
                                </a>
                            </li>
                        @endif
                    @endif 
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"><strong>ACCEDER</strong></a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <strong>{{ Auth::user()->name }}</strong> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i><strong>Cerrar sesión</strong></a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
