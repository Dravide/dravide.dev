<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — {{ config('app.name', 'dravide.dev') }}</title>

    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.2.0/dist/css/tabler.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>
<body class="layout-fluid">
    <div class="page">
        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                        <span class="badge bg-white text-dark me-2 px-2 py-1" style="font-family: monospace; font-size: 14px;">D</span>
                        dravide.dev
                    </a>
                </h1>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <span class="nav-link-icon"><i class="ti ti-dashboard"></i></span>
                                <span class="nav-link-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">
                                <span class="nav-link-icon"><i class="ti ti-user"></i></span>
                                <span class="nav-link-title">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.portfolios.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-briefcase"></i>
                                </span>
                                <span class="nav-link-title">Portfolio</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.tech-stack.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.tech-stack.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-stack-2"></i>
                                </span>
                                <span class="nav-link-title">Tech Stack</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.blog-posts.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="ti ti-news"></i>
                                </span>
                                <span class="nav-link-title">Blog</span>
                            </a>
                        </li>
                    </ul>

                    <div class="mt-auto pt-3 border-top border-secondary">
                        <div class="d-flex align-items-center px-2 py-2">
                            <div class="flex-fill">
                                <div class="text-white fw-bold small">{{ Auth::user()->name }}</div>
                                <div class="text-muted small">{{ Auth::user()->email }}</div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-ghost-light btn-icon" title="Logout">
                                    <i class="ti ti-logout"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Page wrapper -->
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="page-pretitle">Admin Panel</div>
                    <h2 class="page-title">@yield('title', 'Dashboard')</h2>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div><i class="ti ti-check icon alert-icon"></i></div>
                                <div>{{ session('success') }}</div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div><i class="ti ti-alert-circle icon alert-icon"></i></div>
                                <div>
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.2.0/dist/js/tabler.min.js"></script>
    @yield('scripts')
</body>
</html>
