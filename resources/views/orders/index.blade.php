@extends('layouts.app')

@section('content')

<section class="my-orders-page">

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

    <div class="order-history-container">

        <div class="order-history-top">
            <h1>Order History</h1>

            <div class="order-date-filter">
                <div>
                    <span>From</span>
                    <input type="date">
                </div>

                <p>To</p>

                <div>
                    <span>To</span>
                    <input type="date">
                </div>
            </div>
        </div>

        <div class="order-history-tabs">
            <button class="order-tab active" data-order-filter="all">All Order</button>
            <button class="order-tab" data-order-filter="pending">Summary</button>
            <button class="order-tab" data-order-filter="completed">Completed</button>
            <button class="order-tab" data-order-filter="cancelled">Cancelled</button>
        </div>

        <div class="order-history-list">

            @forelse($orders as $order)
                @php
                    $paymentStatus = strtolower($order->payment->payment_status ?? $order->payment->status ?? 'pending');
                    $deliveryStatus = strtolower($order->delivery->status ?? $order->status ?? 'pending');
                    $installationStatus = strtolower($order->installation->status ?? 'not_requested');

                    if ($deliveryStatus === 'delivered' || $order->status === 'completed') {
                        $filterStatus = 'completed';
                    } elseif ($order->status === 'cancelled' || $deliveryStatus === 'cancelled') {
                        $filterStatus = 'cancelled';
                    } else {
                        $filterStatus = 'pending';
                    }

                    $total = $order->total ?? $order->total_amount ?? 0;
                @endphp

                <article class="order-history-card" data-order-status="{{ $filterStatus }}">

                    <div class="order-history-card-header">
                        <div>
                            <h2>Order : {{ $order->order_number ?? '#' . $order->id }}</h2>
                            <p>Order Payment : {{ $order->created_at->format('d F Y') }}</p>
                        </div>

                        <div class="order-history-actions">
                            <a href="{{ route('orders.show', $order) }}" class="invoice-btn">
                                Show Invoice
                            </a>

                            <a href="{{ route('home') }}#products" class="buy-again-btn">
                                Buy Now
                            </a>
                        </div>
                    </div>

                    <div class="order-history-products">

                        @foreach($order->items as $item)
                            @php
                                $itemImage = $item->variant->image
                                    ?? $item->product_image
                                    ?? optional($item->product)->main_image;

                                $itemName = optional($item->product)->name
                                    ?? $item->product_name
                                    ?? 'Furniture Product';

                                $itemVariant = optional($item->variant)->color_name
                                    ?? $item->variant_name
                                    ?? $item->color_name
                                    ?? 'Default Variant';

                                $itemTotal = $item->total
                                    ?? $item->subtotal
                                    ?? $item->total_price
                                    ?? ($item->price * $item->quantity);
                            @endphp

                            <div class="order-history-product-row">

                                <div class="order-history-product-info">
                                    <div class="order-history-product-image">
                                        @if($itemImage)
                                            <img src="{{ asset($itemImage) }}" alt="{{ $itemName }}">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </div>

                                    <div>
                                        <h3>{{ $itemName }}</h3>
                                        <p>By: FurniHome</p>

                                        <div class="order-product-meta">
                                            <span>Variant: {{ $itemVariant }}</span>
                                            <span>Qty: {{ $item->quantity }}</span>
                                            <strong>Price {{ number_format($itemTotal, 2) }} MAD</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="order-product-status">
                                    <span>Status</span>

                                    <strong class="status-text status-{{ $filterStatus }}">
                                        {{ ucfirst($deliveryStatus) }}
                                    </strong>
                                </div>

                                <div class="order-product-delivery">
                                    <span>Delivery Expected by</span>
                                    <strong>{{ $order->created_at->addDays(5)->format('d F Y') }}</strong>
                                </div>

                            </div>
                        @endforeach

                    </div>

                    <div class="order-history-footer">
                        <button type="button" class="cancel-order-btn">
                            <span>×</span>
                            Cancel Order
                        </button>

                        <div class="payment-success-text">
                            Payment is {{ ucfirst($paymentStatus) }}
                        </div>

                        <div class="order-total-price">
                            <span>Total Price:</span>
                            <strong>{{ number_format($total, 2) }} MAD</strong>
                        </div>
                    </div>

                </article>
            @empty
                <div class="empty-orders">
                    <h2>No orders yet.</h2>
                    <p>Your orders will appear here after checkout.</p>

                    <a href="{{ route('home') }}#products">
                        Start Shopping
                    </a>
                </div>
            @endforelse

        </div>

    </div>

</section>

@endsection