<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $completedOrders = Schema::hasColumn('orders', 'status')
            ? Order::where('status', 'completed')->count()
            : 0;

        $cancelledOrders = Schema::hasColumn('orders', 'status')
            ? Order::where('status', 'cancelled')->count()
            : 0;

        $customers = User::where('role', 'customer')->count();

        $totalColumn = null;

        if (Schema::hasColumn('orders', 'total')) {
            $totalColumn = 'total';
        } elseif (Schema::hasColumn('orders', 'total_amount')) {
            $totalColumn = 'total_amount';
        }

        $totalSales = $totalColumn ? Order::sum($totalColumn) : 0;

        $latestOrders = Order::with(['user', 'items'])
            ->latest()
            ->take(6)
            ->get();

        $topProducts = Product::with('category')
            ->latest()
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'completedOrders',
            'cancelledOrders',
            'customers',
            'totalSales',
            'latestOrders',
            'topProducts'
        ));
    }
}