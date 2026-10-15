@extends('layouts.app')

@section('content')

<section class="confirmation-page">

    <div class="confirmation-card">
        <span class="confirmation-icon">✓</span>

        <h1>Order Confirmed</h1>

        <p>
            Thank you for your order. FurniHome has received your request and
            will start preparing your furniture delivery.
        </p>

        <div class="confirmation-details">
            <div>
                <span>Order Number</span>
                <strong>{{ $order->order_number ?? 'FH-' . $order->id }}</strong>
            </div>

            <div>
                <span>Total</span>
                <strong>{{ number_format($order->total ?? $order->total_amount ?? 0, 2) }} MAD</strong>
            </div>

            <div>
                <span>Payment</span>
                <strong>{{ ucfirst(str_replace('_', ' ', $order->payment->payment_status ?? $order->payment->status ?? 'pending')) }}</strong>
            </div>

            <div>
                <span>Delivery</span>
                <strong>{{ ucfirst($order->delivery->status ?? 'pending') }}</strong>
            </div>

            <div>
                <span>Installation</span>
                <strong>{{ ucfirst(str_replace('_', ' ', $order->installation->status ?? 'not requested')) }}</strong>
            </div>
        </div>

        <div class="confirmation-actions">
            <a href="{{ route('home') }}#products">Continue Shopping</a>
            <a href="{{ route('cart.index') }}">Back to Cart</a>
        </div>
    </div>

</section>

@endsection