
@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="header">
    <div class="menu-toggle" id="menu-toggle">☰</div>
    <h1>Store Dashboard</h1>
    <div class="header-right">
        <input type="text" placeholder="Search here..." class="search-bar">
        <select id="language-select">
            <option value="en">ENG (US)</option>
            <option value="km">Khmer (KM)</option>
        </select>
        <span class="notification">🔔</span>
        <div class="user">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/000/439/863/small/Basic_Ui__28186_29.jpg" alt="User">
        </div>
    </div>
</div>
<!-- Widgets -->
<div class="widgets">
    <!-- Total Sales Widget -->
    <div class="widget sales-widget">
        <h3>Today's Sales</h3>
        <div class="sales-amount">${{ number_format($totalSales, 2) }}</div>
        <div class="sales-trend">+8% from yesterday</div>
    </div>
    <!-- Total Orders Widget -->
    <div class="widget orders-widget">
        <h3>Total Orders</h3>
        <div class="orders-count">{{ $totalOrders }}</div>
        <div class="orders-trend">+5% from yesterday</div>
    </div>
    <!-- Total Products Widget -->
    <div class="widget products-widget">
        <h3>Total Products</h3>
        <div class="products-count">{{ $totalProducts }}</div>
        <div class="products-trend">+3 new today</div>
    </div>
</div>
@endsection