@extends('layouts.app')

@section('content')

@php
    $subtotal = $cart->items->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    $deliveryFee = 50;
    $installationFee = 0;
    $total = $subtotal + $deliveryFee + $installationFee;
@endphp

<section class="checkout-page">

    <div class="checkout-layout">

        <div class="checkout-form-side">

            <a href="{{ route('cart.index') }}" class="checkout-back-link">← Back to Cart</a>

            <h1>Checkout</h1>

            @if($errors->any())
                <div class="checkout-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST" class="checkout-form">
                @csrf

                <div class="checkout-block">
                    <div class="checkout-block-title">
                        <span>01</span>
                        <h2>Information</h2>
                    </div>

                    <div class="checkout-grid">
                        <div class="checkout-field">
                            <label>Full Name*</label>
                            <input type="text" name="full_name" value="{{ old('full_name', auth()->user()->name) }}" required>
                        </div>

                        <div class="checkout-field">
                            <label>Email*</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                        </div>

                        <div class="checkout-field full">
                            <label>Phone Number*</label>
                            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required>
                        </div>
                    </div>
                </div>

                <div class="checkout-block">
                    <div class="checkout-block-title">
                        <span>02</span>
                        <h2>Shipping Information</h2>
                    </div>

                    <div class="checkout-grid">
                        <div class="checkout-field">
                            <label>City*</label>
                            <input type="text" name="city" value="{{ old('city') }}" placeholder="Tangier" required>
                        </div>

                        <div class="checkout-field">
                            <label>Address*</label>
                            <input type="text" name="address" value="{{ old('address') }}" placeholder="Street, building, apartment..." required>
                        </div>

                        <div class="checkout-field full">
                            <label>Delivery Note</label>
                            <textarea name="delivery_note" placeholder="Optional note for delivery">{{ old('delivery_note') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="checkout-block">
                    <div class="checkout-block-title">
                        <span>03</span>
                        <h2>Delivery</h2>
                    </div>

                    <label class="checkout-option checked">
                        <input type="radio" name="delivery_method" checked>
                        <span>
                            <strong>Standard Delivery</strong>
                            <small>Furniture delivery to your address</small>
                        </span>
                        <b>50 MAD</b>
                    </label>
                </div>

                <div class="checkout-block">
                    <div class="checkout-block-title">
                        <span>04</span>
                        <h2>Free Installation</h2>
                    </div>

                    <label class="checkout-option checked">
                        <input type="radio" name="installation_required" value="yes" checked>
                        <span>
                            <strong>Yes, I want free installation</strong>
                            <small>Offered by FurniHome as a free service</small>
                        </span>
                        <b>Free</b>
                    </label>

                    <label class="checkout-option">
                        <input type="radio" name="installation_required" value="no">
                        <span>
                            <strong>No, I do not need installation</strong>
                            <small>I will handle installation myself</small>
                        </span>
                        <b>0 MAD</b>
                    </label>
                </div>

                <div class="checkout-block">
                    <div class="checkout-block-title">
                        <span>05</span>
                        <h2>Payment</h2>
                    </div>

                    <label class="checkout-option checked">
                        <input type="radio" name="payment_method" value="cash_on_delivery" checked>
                        <span>
                            <strong>Cash on Delivery</strong>
                            <small>Pay when your order arrives</small>
                        </span>
                    </label>

                    <label class="checkout-option">
    <input type="radio" name="payment_method" value="card">

    <span>
        <strong>Card Payment</strong>
        <small>Simulated secure card payment</small>
    </span>

    <div class="payment-card-icons">
        <img src="{{ asset('images/payments/visa.png') }}" alt="Visa" class="payment-brand-icon">
        <img src="{{ asset('images/payments/mastercard.png') }}" alt="Mastercard" class="payment-brand-icon">
    </div>
</label>

                    <div class="payment-card-fields hidden" id="paymentCardFields">
                        <div class="checkout-grid">
                            <div class="checkout-field full">
                                <label>Cardholder Name</label>
                                <input type="text" name="cardholder_name" placeholder="Hamza Ibiks">
                            </div>

                            <div class="checkout-field full">
                                <label>Card Number</label>
                                <input type="text" name="card_number" placeholder="4111 1111 1111 1111">
                            </div>

                            <div class="checkout-field">
                                <label>Expiry Date</label>
                                <input type="text" name="expiry_date" placeholder="12/28">
                            </div>

                            <div class="checkout-field">
                                <label>CVV</label>
                                <input type="text" name="cvv" placeholder="123">
                            </div>
                        </div>

                        <p class="payment-note">
                            Card details are used only for simulation and are not stored.
                        </p>
                    </div>
                </div>

                <button type="submit" class="place-order-btn">
                    Place Order
                </button>
            </form>

        </div>

        <aside class="checkout-summary-side">
            <h2>Shopping Bag ({{ $cart->items->count() }})</h2>

            <div class="checkout-items">
                @foreach($cart->items as $item)
                    <div class="checkout-item">
                        <div class="checkout-item-image">
                            <img src="{{ asset($item->variant->image ?? $item->product->main_image) }}" alt="{{ $item->product->name }}">
                        </div>

                        <div>
                            <h3>{{ $item->product->name }}</h3>
                            <p>{{ $item->variant->color_name ?? 'Default Variant' }}</p>
                            <small>Qty: {{ $item->quantity }}</small>
                        </div>

                        <strong>{{ number_format($item->price * $item->quantity, 2) }} MAD</strong>
                    </div>
                @endforeach
            </div>

            <div class="checkout-coupon">
                <input type="text" placeholder="Promo code">
                <button type="button">Apply</button>
            </div>

            <div class="checkout-summary-line">
                <span>Subtotal</span>
                <strong>{{ number_format($subtotal, 2) }} MAD</strong>
            </div>

            <div class="checkout-summary-line">
                <span>Delivery Fee</span>
                <strong>{{ number_format($deliveryFee, 2) }} MAD</strong>
            </div>

            <div class="checkout-summary-line">
                <span>Installation</span>
                <strong>Free</strong>
            </div>

            <div class="checkout-summary-total">
                <span>Total</span>
                <strong>{{ number_format($total, 2) }} MAD</strong>
            </div>
        </aside>

    </div>

</section>

@endsection