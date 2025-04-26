<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Order::whereDate('created_at', today())->sum('order_quantity');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        
        return view('dashboard.index', compact('totalSales', 'totalOrders', 'totalProducts'));
    }
}