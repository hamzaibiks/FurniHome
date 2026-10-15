<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'items.product',
            'items.variant',
            'payment',
            'delivery',
            'installation',
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load([
            'items.product',
            'items.variant',
            'payment',
            'delivery',
            'installation',
        ]);

        return view('orders.show', compact('order'));
    }
}