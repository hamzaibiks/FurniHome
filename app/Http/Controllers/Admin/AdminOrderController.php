<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product', 'payment', 'delivery', 'installation'])
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['nullable', 'string'],
            'payment_status' => ['nullable', 'string'],
            'delivery_status' => ['nullable', 'string'],
            'installation_status' => ['nullable', 'string'],
        ]);

        if ($request->filled('status') && Schema::hasColumn('orders', 'status')) {
            $order->status = $request->status;
            $order->save();
        }

        if ($order->payment && $request->filled('payment_status')) {
            if (Schema::hasColumn('payments', 'payment_status')) {
                $order->payment->payment_status = $request->payment_status;
            } elseif (Schema::hasColumn('payments', 'status')) {
                $order->payment->status = $request->payment_status;
            }

            $order->payment->save();
        }

        if ($order->delivery && $request->filled('delivery_status') && Schema::hasColumn('deliveries', 'status')) {
            $order->delivery->status = $request->delivery_status;
            $order->delivery->save();
        }

        if ($order->installation && $request->filled('installation_status') && Schema::hasColumn('installations', 'status')) {
            $order->installation->status = $request->installation_status;
            $order->installation->save();
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }
}