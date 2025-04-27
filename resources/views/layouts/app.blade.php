<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Dashboard - DOKAN</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="logo" style="color: rgb(127, 157, 255);">Shop Dashboard</div>
            <ul class="nav">
                <li class="{{ request()->is('/') ? 'active' : '' }}"><span class="icon">🏠</span> <a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><span class="icon">📊</span> Leaderboard</li>
                <li id="orders-nav" class="{{ request()->is('orders*') ? 'active' : '' }}"><span class="icon">🛒</span> <a href="{{ route('orders.index') }}">Orders</a> <span class="badge">{{ App\Models\Order::count() }}</span></li>
                <li><span class="icon">📦</span><a href="#">Products</a></li>
                <li><span class="icon">📈</span><a href="#">PaymentType</a></li>
                <li><span class="icon">✉️</span><a href="#">Messages</a></li>
                <li><span class="icon">⚙️</span><a href="#">Settings</a></li>
                <!-- Logout Form -->
                <li>
                    <span class="icon">🚪</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none; border:none; color: inherit; padding: 0; font: inherit; cursor: pointer;">
                            Sign Out
                        </button>
                    </form>
                </li>
            </ul>
            <div class="upgrade-box">
                <div class="logo">shop</div>
                <p>Premium</p>
            </div>
        </div>
        <!-- Overlay for mobile sidebar -->
        <div class="overlay" id="overlay"></div>
        <!-- Main Content -->
        <div class="main-content">
            @if(session('user'))
                <div class="welcome-message">
                    Welcome, {{ session('user')->name }}!
                </div>
            @endif
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>
