@extends('layouts.app')

@section('content')

<section class="order-details-page">

    <nav class="orders-navbar">
        <a href="{{ route('home') }}" class="orders-brand">FurniHome</a>

        <div class="orders-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#products">Shop</a>
            <a href="{{ route('cart.index') }}">Cart</a>
            <a href="{{ route('orders.index') }}">My Orders</a>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="orders-logout-btn">Logout</button>
        </form>
    </nav>

    <div class="order-details-container">

        <a href="{{ route('orders.index') }}" class="order-back-link">
            ← Back to My Orders
        </a>

        <div class="order-details-heading">
            <span>Order Invoice</span>
            <h1>{{ $order->order_number ?? 'FH-' . $order->id }}</h1>
            <p>Placed on {{ $order->created_at->format('d F Y - H:i') }}</p>
        </div>

        <div class="order-details-layout">

            <div class="order-items-box">
                <h2>Products</h2>

                @foreach($order->items as $item)
                    <div class="order-item-row">

                        <div class="order-item-image">
                            <img src="{{ asset($item->variant->image ?? $item->product_image ?? $item->product->main_image) }}" alt="{{ $item->product->name ?? $item->product_name }}">
                        </div>

                        <div class="order-item-info">
                            <h3>{{ $item->product->name ?? $item->product_name }}</h3>
                            <p>{{ $item->variant->color_name ?? $item->variant_name ?? $item->color_name ?? 'Default Variant' }}</p>
                            <span>Quantity: {{ $item->quantity }}</span>
                        </div>

                        <strong>
                            {{ number_format($item->total ?? $item->subtotal ?? $item->total_price ?? 0, 2) }} MAD
                        </strong>

                    </div>
                @endforeach
            </div>

            <aside class="order-summary-details">

                <h2>Summary</h2>

                <div class="order-summary-line">
                    <span>Subtotal</span>
                    <strong>{{ number_format($order->subtotal ?? 0, 2) }} MAD</strong>
                </div>

                <div class="order-summary-line">
                    <span>Delivery Fee</span>
                    <strong>{{ number_format($order->delivery_fee ?? 50, 2) }} MAD</strong>
                </div>

                <div class="order-summary-line">
                    <span>Installation</span>
                    <strong>Free</strong>
                </div>

                <div class="order-summary-total">
                    <span>Total</span>
                    <strong>{{ number_format($order->total ?? $order->total_amount ?? 0, 2) }} MAD</strong>
                </div>

                <div class="order-info-block">
                    <h3>Delivery Information</h3>
                    <p>{{ $order->delivery->full_name ?? auth()->user()->name }}</p>
                    <p>{{ $order->delivery->phone ?? auth()->user()->phone }}</p>
                    <p>{{ $order->delivery->city ?? '-' }}</p>
                    <p>{{ $order->delivery->address ?? '-' }}</p>
                </div>

                <div class="order-info-block">
                    <h3>Payment</h3>
                    <p>Method: {{ ucfirst(str_replace('_', ' ', $order->payment->payment_method ?? $order->payment->method ?? 'pending')) }}</p>
                    <p>Status: {{ ucfirst(str_replace('_', ' ', $order->payment->payment_status ?? $order->payment->status ?? 'pending')) }}</p>

                    @if($order->payment && ($order->payment->transaction_reference ?? $order->payment->transaction_id ?? null))
                        <p>Reference: {{ $order->payment->transaction_reference ?? $order->payment->transaction_id }}</p>
                    @endif
                </div>

                <div class="order-info-block">
                    <h3>Installation</h3>
                    <p>Status: {{ ucfirst(str_replace('_', ' ', $order->installation->status ?? 'not requested')) }}</p>
                    <p>Fee: Free</p>
                </div>

            </aside>

        </div>

    </div>

</section>

@endsection