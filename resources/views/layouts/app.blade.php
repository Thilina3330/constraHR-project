<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ConstraHR') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons (Optional for icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="d-flex {{ request()->is('/') ? 'flex-column' : '' }}" style="min-height: 100vh;">

        @if(!request()->is('/', 'login', 'register', 'password*'))
            <!-- Left Sidebar Navigation -->
            <div class="text-white p-3 d-flex flex-column flex-shrink-0" style="width: 260px; min-height: 100vh; background-color: #0B1F3A;">
                
                <!-- Brand Logo / Name -->
                <div class="d-flex align-items-center mb-4 text-white text-decoration-none border-bottom border-secondary pb-3">
                    <span class="fs-4 fw-bold text-primary">🏗️ Constra<span class="text-warning">HR</span></span>
                </div>
                
                <!-- Sidebar Menu Items -->
                <ul class="nav nav-pills flex-column mb-auto">
                    
                    <!-- Dashboard -->
                    <li class="nav-item mb-1">
                        <a href="/home" class="nav-link text-white {{ request()->is('home') ? 'active bg-warning text-dark fw-bold' : '' }}">
                            📊 {{ __('Dashboard') }}
                        </a>
                    </li>

                    <!-- Topic 1: My Site (Collapsible Dropdown) -->
                    <li class="nav-item mb-1">
                        <a class="nav-link text-white d-flex justify-content-between align-items-center {{ request()->is('*site*') ? 'bg-warning text-dark fw-bold' : '' }}" data-bs-toggle="collapse" href="#siteMenu" role="button" aria-expanded="{{ request()->is('*site*') ? 'true' : 'false' }}">
                            <span>🏗️ {{ __('My Site') }}</span>
                            <small>▼</small>
                        </a>
                        <div class="collapse {{ request()->is('*site*') ? 'show' : '' }}" id="siteMenu">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-3 mt-1">
                                <li><a href="{{ route('site.view') }}" class="nav-link {{ request()->is('view-site*') || request()->is('site-details*') ? 'text-warning fw-bold' : 'text-white-50' }} py-1">📋 {{ __('View Sites') }}</a></li>
                                <li><a href="{{ route('site.create') }}" class="nav-link {{ request()->is('create-site*') ? 'text-warning fw-bold' : 'text-white-50' }} py-1">➕ {{ __('Create Site') }}</a></li>
                            </ul>
                        </div>
                    </li>

                    <!-- Topic 2: Site Expenses -->
                    <li class="nav-item mb-1">
                        <a href="{{ route('expenses.index') }}" class="nav-link text-white {{ request()->is('*expense*') ? 'active bg-warning text-dark fw-bold' : '' }}">
                            💰 {{ __('Site Expenses') }}
                        </a>
                    </li>

                    <!-- Topic 3: Employee Management -->
                    <li class="nav-item mb-1">
                        <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#empMenu" role="button" aria-expanded="false">
                            <span>👷 {{ __('Employee Management') }}</span>
                            <small>▼</small>
                        </a>
                        <div class="collapse {{ request()->is('*employe*') ? 'show' : '' }}" id="empMenu">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-3 mt-1">
                                <li><a href="/employe" class="nav-link text-white-50 py-1">👥 {{ __('View Employee') }}</a></li>
                            </ul>
                        </div>
                    </li>

                    <!-- Topic 4: User Management -->
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

                <!-- Sidebar Bottom: Need Help Box & User Dropdown -->
                <div class="p-3 mb-3 rounded" style="background-color: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <small class="fw-bold d-block text-white mb-1">Need Help?</small>
                    <small class="text-white-50 d-block mb-2" style="font-size: 11px;">Contact the system administrator</small>
                    <a href="mailto:support@constrahr.com" class="btn btn-sm btn-outline-warning w-100 py-1" style="font-size: 12px;">Contact Support</a>
                </div>

                <hr class="border-secondary my-2">

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
            
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-md navbar-dark border-bottom shadow-sm px-4" style="background-color: #0B1F3A;">
                <div class="container-fluid {{ request()->is('/') ? 'container' : '' }}">
                    @if(request()->is('/'))
                        <a href="{{ url('/') }}" class="navbar-brand fw-bold text-primary">
                            🏗️ Constra<span class="text-warning">HR</span>
                        </a>
                    @else
                        <span class="navbar-text text-white-50 small">
                            <i class="bi bi-clock me-1"></i> {{ date('l, d F Y') }}
                        </span>
                    @endif

                    <ul class="navbar-nav ms-auto align-items-center">
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
                            <li class="nav-item me-3 text-white">
                                <span class="badge bg-warning text-dark me-1">Admin</span>
                                <strong>{{ Auth::user()->name }}</strong>
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