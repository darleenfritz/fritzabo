<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FritzAbo</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .nav-btn {
            background-color: #ec407a;
            color: white !important;
            padding: 6px 14px;
            border-radius: 8px;
            text-decoration: none;
            margin-right: 8px;
            display: inline-block;
        }
        .nav-btn:hover {
            background-color: #d81b60;
            color: white !important;
        }

        .logo-text {
            font-family: 'Pacifico', cursive;
            font-size: 26px;
            color: #ec407a !important;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        .nav-btn {
        background-color: #ec407a;
        color: white !important;
        padding: 6px 14px;
        border-radius: 8px;
        text-decoration: none;
        margin-right: 8px;
        display: inline-block;
        }
        .nav-btn:hover {
            background-color: #d81b60;
            color: white !important;
        }

        .logo-text {
            font-family: 'Pacifico', cursive;
            font-size: 26px;
            color: #ec407a !important;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        /* Ergänzt: Einheitliches Link- und Button-Styling */
        .nav-link,
        .page-link {
            color: #ec407a !important;
        }
        .nav-link:hover,
        .page-link:hover {
            color: #ec407a !important;
            background-color: transparent !important;
        }
        .page-item.active .page-link {
            background-color: #ec407a !important;
            border-color: #ec407a !important;
            color: white !important;
        }
        .dropdown-menu {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .dropdown-menu .dropdown-item {
            padding: 10px 16px;
            font-size: 15px;
            transition: background-color 0.2s ease;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #fce4ec;
            color: #ec407a;
        }

        .nav-link.dropdown-toggle::after {
            color: #ec407a;
        }
                

    </style>
</head>
<body style="background-color: white; min-height: 100vh; display: flex; flex-direction: column;">
    <div id="app" style="flex: 1;">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand logo-text" href="{{ url('/') }}">
                    FritzAbo
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="manageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                                Verwalten
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="manageDropdown">
                                <li><a class="dropdown-item" href="{{ route('subscriptions.index') }}">Subscriptions</a></li>
                                <li><a class="dropdown-item" href="{{ route('mediatypes.index') }}">Medientypen</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Darleen Fritz
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profil') }}">Profil</a>
                                <a class="dropdown-item" href="#">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
    <footer style="background-color: #f5f5f5; padding: 20px 0; text-align: center; font-size: 14px; color: #666; border-top: 1px solid #ddd;">
    <div class="container">
        © {{ date('Y') }} FritzAbo ·
        <a href="{{ route('impressum') }}" style="color: #ec407a; text-decoration: none;">Impressum</a> ·
        <a href="{{ route('datenschutz') }}" style="color: #ec407a; text-decoration: none;">Datenschutz</a> ·
        <a href="{{ route('kontakt') }}" style="color: #ec407a; text-decoration: none;">Kontakt</a> ·
        <a href="{{ route('feedback.create') }}" style="color: #ec407a; text-decoration: none;">Feedback</a>
    </div>
</footer>
</body>
</html>