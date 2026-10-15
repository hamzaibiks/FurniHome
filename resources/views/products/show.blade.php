@extends('layouts.app')

@section('content')

<section class="product-details-page">

    <nav class="details-navbar">
        <a href="{{ route('home') }}" class="details-brand">FurniHome</a>

        <div class="details-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#products">Shop</a>
            <a href="{{ route('home') }}#categories">Categories</a>
            <a href="#">Collections</a>
            <a href="#">Contact</a>
        </div>

        <div class="details-actions">

            @guest
                <a href="{{ route('login') }}" class="details-icon-link" aria-label="Cart">
                    <svg viewBox="0 0 24 24" class="nav-icon">
                        <path d="M6.5 8.5H17.5L18.5 20H5.5L6.5 8.5Z"></path>
                        <path d="M9 8.5V6.5C9 4.8 10.3 3.5 12 3.5C13.7 3.5 15 4.8 15 6.5V8.5"></path>
                    </svg>
                </a>

                <a href="{{ route('login') }}" class="details-icon-link" aria-label="Login">
                    <svg viewBox="0 0 24 24" class="nav-icon">
                        <path d="M12 12C14.2 12 16 10.2 16 8C16 5.8 14.2 4 12 4C9.8 4 8 5.8 8 8C8 10.2 9.8 12 12 12Z"></path>
                        <path d="M4.5 20C5.4 16.8 8.3 14.5 12 14.5C15.7 14.5 18.6 16.8 19.5 20"></path>
                    </svg>
                </a>
            @endguest

            @auth
                <a href="{{ route('cart.index') }}" class="details-icon-link" aria-label="Cart">
                    <svg viewBox="0 0 24 24" class="nav-icon">
                        <path d="M6.5 8.5H17.5L18.5 20H5.5L6.5 8.5Z"></path>
                        <path d="M9 8.5V6.5C9 4.8 10.3 3.5 12 3.5C13.7 3.5 15 4.8 15 6.5V8.5"></path>
                    </svg>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf

                    <button type="submit" class="details-icon-link" aria-label="Logout">
                        <svg viewBox="0 0 24 24" class="nav-icon">
                            <path d="M15.5 7.5L20 12L15.5 16.5"></path>
                            <path d="M20 12H9"></path>
                            <path d="M12 20H5C4.4 20 4 19.6 4 19V5C4 4.4 4.4 4 5 4H12"></path>
                        </svg>
                    </button>
                </form>
            @endauth

        </div>
    </nav>

    <div class="product-details-shell">

        <div class="product-gallery">
            <div class="product-main-image-box">
                <img
                    src="{{ asset($product->main_image) }}"
                    alt="{{ $product->name }}"
                    id="mainProductImage"
                    class="product-main-image"
                >
            </div>

            <div class="product-thumbnails">
                @foreach($product->variants as $variant)
                    <button
                        class="detail-variant-thumb {{ $loop->first ? 'active' : '' }}"
                        data-image="{{ asset($variant->image) }}"
                        data-variant-id="{{ $variant->id }}"
                        aria-label="{{ $variant->color_name }}"
                    >
                        <img src="{{ asset($variant->image) }}" alt="{{ $variant->color_name }}">
                    </button>
                @endforeach
            </div>
        </div>

        <div class="product-details-info">
            <span class="details-category">{{ $product->category->name ?? 'Furniture' }}</span>

            <h1>{{ $product->name }}</h1>

            <p class="details-description">
                {{ $product->description }}
            </p>

            <div class="details-variants">
                <span>Available variants</span>

                <div class="details-dots">
                    @foreach($product->variants as $variant)
                        <button
                            class="detail-variant-dot {{ $loop->first ? 'active' : '' }}"
                            data-image="{{ asset($variant->image) }}"
                            data-variant-id="{{ $variant->id }}"
                            aria-label="{{ $variant->color_name }}"
                        >
                            <img src="{{ asset($variant->image) }}" alt="{{ $variant->color_name }}">
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="details-specs">
                <div>
                    <span>Width</span>
                    <strong>{{ $product->width }} cm</strong>
                </div>

                <div>
                    <span>Height</span>
                    <strong>{{ $product->height }} cm</strong>
                </div>

                <div>
                    <span>Depth</span>
                    <strong>{{ $product->depth }} cm</strong>
                </div>

                <div>
                    <span>Material</span>
                    <strong>{{ $product->material }}</strong>
                </div>
            </div>

            <div class="details-price">
                <strong>{{ number_format($product->price, 2) }} MAD</strong>

                @if($product->old_price)
                    <span>{{ number_format($product->old_price, 2) }} MAD</span>
                @endif
            </div>

            <div class="quantity-control">
                <button type="button" class="quantity-btn" data-action="minus">−</button>
                <span id="quantityValue">1</span>
                <button type="button" class="quantity-btn" data-action="plus">+</button>
            </div>

            <div class="details-buttons">

                @guest
                    <a href="{{ route('login') }}" class="add-cart-btn">
                        Add to Cart
                    </a>

                    <a href="{{ route('login') }}" class="buy-now-btn">
                        Buy Now
                    </a>
                @endguest

                @auth
                    <form action="{{ route('cart.store') }}" method="POST" class="details-cart-form">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <input
                            type="hidden"
                            name="product_variant_id"
                            id="selectedVariantInput"
                            value="{{ $product->variants->first()->id ?? '' }}"
                        >

                        <input
                            type="hidden"
                            name="quantity"
                            id="selectedQuantityInput"
                            value="1"
                        >

                        <button type="submit" class="add-cart-btn">
                            Add to Cart
                        </button>

                        <button type="submit" name="redirect_to" value="checkout" class="buy-now-btn">
                            Buy Now
                        </button>
                    </form>
                @endauth

            </div>
        </div>

    </div>

    <a href="#" class="back-button" onclick="event.preventDefault(); window.history.back();">
        <span>←</span>
        Back
    </a>

</section>

@endsection