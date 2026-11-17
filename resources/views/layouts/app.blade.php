<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="d-flex {{ request()->is('/') ? 'flex-column' : '' }}" style="min-height: 100vh;">


        
        @if(!request()->is('/' ,'login', 'register'  , 'password*'))
            <div class=" text-white p-3 d-flex flex-column flex-shrink-0" style="width: 260px; min-height: 100vh; background-color: #0B1F3A;">
                
                <!-- Brand Logo / Name -->
                 <div class="d-flex align-items-center mb-4 text-white text-decoration-none border-bottom border-secondary pb-3">
                    <span class="fs-4 fw-bold text-primary">🏗️ Constra<span class="text-warning">HR</span></span>
                </div>

                
                <ul class="nav nav-pills flex-column mb-auto">
                    
                    <!-- Home / Dashboard -->
                    <li class="nav-item mb-1">
                        <a href="/home" class="nav-link text-white {{ request()->is('home') ? 'active bg-warning text-dark fw-bold' : '' }}">
                            📊 {{ __('Dashboard') }}
                        </a>
                    </li>

                    <!-- Topic 1: My Site -->
                    <li class="nav-item mb-1">
                        <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#siteMenu" role="button" aria-expanded="false">
                            <span>🏗️ {{ __('My Site') }}</span>
                            <small>▼</small>
                        </a>
                        <div class="collapse {{ request()->is('*site*') ? 'show' : '' }}" id="siteMenu">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-3 mt-1">
                                <li><a href="/view-site" class="nav-link text-white-50 py-1">📋 {{ __('View Site') }}</a></li>
                                <li><a href="/create-site" class="nav-link text-white-50 py-1">➕ {{ __('Create Site') }}</a></li>
                            </ul>
                        </div>
                    </li>

                                <!-- Topic 2: Employee Management -->
                    <li class="nav-item mb-1">
                        <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#empMenu" role="button" aria-expanded="false">
                            <span>👷 {{ __('Employee Management') }}</span>
                            <small>▼</small>
                        </a>
                        <div class="collapse {{ request()->is('*employee*') ? 'show' : '' }}" id="empMenu">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-3 mt-1">
                                <li><a href="{{ route('employees.index') }}" class="nav-link text-white-50 py-1">👥 {{ __('View Employee') }}</a></li>
                                <li><a href="{{ route('employees.create') }}" class="nav-link text-white-50 py-1">➕ {{ __('Add Employee') }}</a></li>
                            </ul>
                        </div>
                    </li>

                    <!-- Topic 3: User Management -->
                    <li class="nav-item mb-1">
                        <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#userMenu" role="button" aria-expanded="false">
                            <span>👥 {{ __('User Management') }}</span>
                            <small>▼</small>
                        </a>
                        <div class="collapse {{ request()->is('*user*') ? 'show' : '' }}" id="userMenu">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-3 mt-1">
                                <li><a href="/view_user" class="nav-link text-white-50 py-1">📋 {{ __('View User') }}</a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}" class="nav-link text-white-50 py-1">➕ {{ __('Register New User') }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </li>

                </ul>

                <!-- Sidebar Bottom: User Info & Logout -->
                <hr class="border-secondary">
                @auth
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="badge bg-warning text-dark me-2">Admin</span>
                            <strong>{{ Auth::user()->name }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    🚪 Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        @endif

        <!-- Content Area -->
        <div class="flex-grow-1 d-flex flex-column bg-light">
            
            <!-- Top Navbar (Landing page  Logo) -->
            <nav class="navbar navbar-expand-md navbar-dark  border-bottom shadow-sm px-4"
              style= "background-color: #0B1F3A;" >
                <div class="container-fluid {{ request()->is('/') ? 'container' : '' }}">
                    @if(request()->is('/'))
                        <a href="{{ url('/') }}" class="navbar-brand fw-bold text-primary">
                            🏗️ Constra<span class="text-warning">HR</span>
                        </a>
                    @endif

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <span class="nav-link text-white">Welcome, <strong>{{ Auth::user()->name }}</strong>!</span>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>

            <!-- Main Page Content Loading -->
            <main class="p-4 flex-grow-1">
                @yield('content')
            </main>

            <!-- Footer (Full Width) -->
            <footer class="bg-white border-top py-3 text-center text-muted small mt-auto">
                &copy; {{ date('Y') }} <strong>ConstraHR</strong>. All rights reserved.
            </footer>

        </div>

    </div>
</body>
</html>