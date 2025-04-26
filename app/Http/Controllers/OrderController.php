<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\CustomerType;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['product', 'customerType', 'paymentType'])->get();
        $products = Product::all();
        $customerTypes = CustomerType::all();
        $paymentTypes = PaymentType::all();
        
        return view('dashboard.orders', compact('orders', 'products', 'customerTypes', 'paymentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'customer_type_id' => 'required|exists:customer_types,customer_type_id',
            'payment_type_id' => 'required|exists:payment_types,payment_type_id',
            'order_quantity' => 'required|integer|min:1',
            'order_date_time' => 'required|date',
            'order_status' => 'required|string'
        ]);

        $lastOrder = Order::orderBy('order_id', 'desc')->first();
        $lastId = $lastOrder ? (int) substr($lastOrder->order_id, 3) : 0;
        $orderId = 'ORD' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

        Order::create([
            'order_id' => $orderId,
            'product_id' => $request->product_id,
            'customer_type_id' => $request->customer_type_id,
            'payment_type_id' => $request->payment_type_id,
            'order_quantity' => $request->order_quantity,
            'order_date_time' => $request->order_date_time,
            'order_status' => $request->order_status
        ]);

        return redirect()->route('orders.index')->with('success', 'Order added successfully');
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'customer_type_id' => 'required|exists:customer_types,customer_type_id',
            'payment_type_id' => 'required|exists:payment_types,payment_type_id',
            'order_quantity' => 'required|integer|min:1',
            'order_date_time' => 'required|date',
            'order_status' => 'required|string'
        ]);

        $order->update([
            'product_id' => $request->product_id,
            'customer_type_id' => $request->customer_type_id,
            'payment_type_id' => $request->payment_type_id,
            'order_quantity' => $request->order_quantity,
            'order_date_time' => $request->order_date_time,
            'order_status' => $request->order_status
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully'
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully'
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}
