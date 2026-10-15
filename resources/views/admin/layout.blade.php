<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FurniHome Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="admin-app">

    <aside class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="admin-logo">
            <span>F</span>
            FurniHome
        </a>

        <div class="admin-menu-label">Main Menu</div>

        <nav class="admin-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M4 13H10V20H4V13Z"></path><path d="M14 4H20V20H14V4Z"></path><path d="M4 4H10V9H4V4Z"></path></svg>
                Overview
            </a>

            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M6 2H18L20 6V21L12 18L4 21V6L6 2Z"></path><path d="M8 8H16"></path><path d="M8 12H16"></path></svg>
                Orders
            </a>

            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M4 7L12 3L20 7L12 11L4 7Z"></path><path d="M4 7V17L12 21L20 17V7"></path><path d="M12 11V21"></path></svg>
                Products
            </a>

            <a href="{{ route('home') }}">
                <svg viewBox="0 0 24 24"><path d="M3 11L12 4L21 11"></path><path d="M5 10V20H19V10"></path></svg>
                Website
            </a>
        </nav>

        <div class="admin-menu-label">Account</div>

        <form action="{{ route('logout') }}" method="POST" class="admin-logout-form">
            @csrf
            <button type="submit">
                <svg viewBox="0 0 24 24"><path d="M15 7L20 12L15 17"></path><path d="M20 12H9"></path><path d="M12 20H5V4H12"></path></svg>
                Logout
            </button>
        </form>
    </aside>

    <main class="admin-main">

        <header class="admin-topbar">
            <div>
                <h1>@yield('page-title')</h1>
                <p>@yield('page-subtitle')</p>
            </div>

            <div class="admin-user-pill">
                <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                <div>
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>Admin</small>
                </div>
            </div>
        </header>

        @if(session('success'))
            <div class="admin-alert">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </main>

</div>

</body>
</html>