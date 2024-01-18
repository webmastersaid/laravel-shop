<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('order.index', compact('orders'));
    }
    public function delete(Order $order)
    {
        $order->user()->dissociate();
        $order->delete();
        return redirect()->route('order.index');
    }
}
