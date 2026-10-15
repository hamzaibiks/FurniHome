@extends('admin.layout')

@section('page-title', 'Good Morning, Admin!')
@section('page-subtitle', 'Here is what is happening with FurniHome today.')

@section('content')

<div class="admin-stats-grid">

    <div class="admin-stat-card">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24"><path d="M4 7L12 3L20 7L12 11L4 7Z"></path><path d="M4 7V17L12 21L20 17V7"></path></svg>
        </div>
        <span>Total products</span>
        <strong>{{ $totalProducts }}</strong>
        <small class="green">Active catalog</small>
    </div>

    <div class="admin-stat-card">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24"><path d="M5 12L10 17L20 7"></path></svg>
        </div>
        <span>Completed orders</span>
        <strong>{{ $completedOrders }}</strong>
        <small class="green">Successful sales</small>
    </div>

    <div class="admin-stat-card">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24"><path d="M6 6L18 18"></path><path d="M18 6L6 18"></path></svg>
        </div>
        <span>Cancelled orders</span>
        <strong>{{ $cancelledOrders }}</strong>
        <small class="red">Needs attention</small>
    </div>

    <div class="admin-stat-card">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24"><path d="M17 21V19C17 16.8 15.2 15 13 15H7C4.8 15 3 16.8 3 19V21"></path><path d="M10 11C12.2 11 14 9.2 14 7C14 4.8 12.2 3 10 3C7.8 3 6 4.8 6 7C6 9.2 7.8 11 10 11Z"></path></svg>
        </div>
        <span>Customers</span>
        <strong>{{ $customers }}</strong>
        <small class="green">Registered users</small>
    </div>

</div>

<div class="admin-dashboard-grid">

    <section class="sales-report-card">
        <div class="admin-card-header">
            <div>
                <h2>Your sales report</h2>
                <p>Look at your sale</p>
            </div>

            <button>Total Sales</button>
        </div>

        <h3>{{ number_format($totalSales, 2) }} MAD</h3>
        <small class="green">Revenue from all orders</small>

        <div class="fake-chart">
            <svg viewBox="0 0 700 220">
                <path d="M20 150 C90 80 150 185 220 120 C290 60 350 170 430 95 C500 40 560 150 680 85"></path>
                <path d="M20 110 C100 160 170 65 245 115 C330 170 390 60 470 120 C550 175 610 70 680 135"></path>
            </svg>
        </div>
    </section>

    <section class="top-products-card">
        <div class="admin-card-header">
            <div>
                <h2>Top products</h2>
                <p>Latest catalog items</p>
            </div>
        </div>

        <div class="admin-product-mini-list">
            @foreach($topProducts as $product)
                <div class="admin-product-mini">
                    <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}">
                    <div>
                        <strong>{{ $product->name }}</strong>
                        <span>{{ number_format($product->price, 2) }} MAD</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</div>

<section class="admin-table-card">
    <div class="admin-card-header">
        <div>
            <h2>Last transactions</h2>
            <p>Latest customer orders</p>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="admin-small-btn">View all</a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($latestOrders as $order)
                    @php
                        $total = $order->total ?? $order->total_amount ?? 0;
                    @endphp

                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Customer' }}</td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>{{ number_format($total, 2) }} MAD</td>
                        <td>
                            <span class="admin-status admin-status-{{ $order->status ?? 'pending' }}">
                                {{ ucfirst($order->status ?? 'pending') }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection