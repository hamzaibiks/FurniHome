@extends('layouts.app')

@section('content')

<section class="cart-page">

    <nav class="cart-navbar">
        <a href="{{ route('home') }}" class="cart-brand">FurniHome</a>

        <div class="cart-links">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('home') }}#products">Shop</a>
    <a href="{{ route('home') }}#categories">Categories</a>
    <a href="{{ route('orders.index') }}">My Orders</a>
</div>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf

            <button type="submit" class="cart-logout-btn">
                Logout
            </button>
        </form>
    </nav>

    <div class="cart-container">

        <div class="cart-heading cart-heading-flex">
    <div>
        <span>Shopping Cart</span>
        <h1>Your Cart</h1>
    </div>

    <a href="{{ route('orders.index') }}" class="my-orders-cart-btn">
        My Orders
    </a>
</div>

        @if(session('success'))
            <div class="cart-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="cart-layout">

            <div class="cart-products-box">

                <div class="cart-table-head">
                    <span>Product Code</span>
                    <span>Quantity</span>
                    <span>Total</span>
                    <span>Action</span>
                </div>

                @forelse($cart->items as $item)
                    <div class="cart-row">

                        <div class="cart-product-info">
                            <div class="cart-product-image">
                                <img src="{{ asset($item->variant->image ?? $item->product->main_image) }}" alt="{{ $item->product->name }}">
                            </div>

                            <div>
                                <h3>{{ $item->product->name }}</h3>
                                <p>
                                    Set - {{ $item->variant->color_name ?? 'Default Variant' }}
                                </p>
                            </div>
                        </div>

                        <div class="cart-quantity">

                            <form action="{{ route('cart.update', $item) }}" method="POST" class="cart-quantity-form">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                <button type="submit">−</button>
                            </form>

                            <span>{{ $item->quantity }}</span>

                            <form action="{{ route('cart.update', $item) }}" method="POST" class="cart-quantity-form">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                <button type="submit">+</button>
                            </form>

                        </div>

                        <div class="cart-row-total">
                            {{ number_format($item->subtotal, 2) }} MAD
                        </div>

                        <form action="{{ route('cart.destroy', $item) }}" method="POST" class="cart-remove-form">
                            @csrf
                            @method('DELETE')

                            <button type="submit" aria-label="Remove item">
                                ✕
                            </button>
                        </form>

                    </div>
                @empty
                    <div class="empty-cart">
                        <h2>Your cart is empty.</h2>
                        <p>Explore our furniture collection and add your favorite pieces.</p>

                        <a href="{{ route('home') }}#products">
                            Continue Shopping
                        </a>
                    </div>
                @endforelse

                @if($cart->items->count() > 0)
                    <a href="{{ route('home') }}#products" class="continue-shopping-btn">
                        Continue Shopping
                    </a>
                @endif

            </div>

            @php
                $subtotal = $cart->items->sum(function ($item) {
                    return $item->subtotal;
                });

                $discount = 0;
                $deliveryFee = $subtotal > 0 ? 50 : 0;
                $total = $subtotal - $discount + $deliveryFee;
            @endphp

            <div class="order-summary-box">
                <h2>Order Summary</h2>

                <div class="coupon-box">
                    <input type="text" placeholder="Coupon code">
                    <button type="button">Apply</button>
                </div>

                <div class="summary-line">
                    <span>Subtotal</span>
                    <strong>{{ number_format($subtotal, 2) }} MAD</strong>
                </div>

                <div class="summary-line">
                    <span>Discount (10%)</span>
                    <strong>{{ number_format($discount, 2) }} MAD</strong>
                </div>

                <div class="summary-line">
                    <span>Delivery Fee</span>
                    <strong>{{ number_format($deliveryFee, 2) }} MAD</strong>
                </div>

                <div class="summary-total">
                    <span>Total</span>
                    <strong>{{ number_format($total, 2) }} MAD</strong>
                </div>

                @if($cart->items->count() > 0)
    <a href="{{ route('checkout.index') }}" class="checkout-btn">
        Checkout Now
    </a>
@else
    <button type="button" class="checkout-btn">
        Checkout Now
    </button>
@endif
            </div>

        </div>

    </div>

</section>

@endsection