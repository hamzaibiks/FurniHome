@extends('layouts.app')

@section('content')

<section class="hero-section">

    <nav class="hero-navbar">
        <a href="{{ route('home') }}" class="brand">FurniHome</a>

        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="#products" class="product-filter-trigger" data-filter="all">Shop</a>
            <a href="#categories">Categories</a>
            <a href="#collections">Collections</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="nav-actions">

            @guest
                <a href="{{ route('login') }}" class="nav-icon-link" aria-label="Cart">
                    <svg viewBox="0 0 24 24" class="nav-icon">
                        <path d="M6.5 8.5H17.5L18.5 20H5.5L6.5 8.5Z"></path>
                        <path d="M9 8.5V6.5C9 4.8 10.3 3.5 12 3.5C13.7 3.5 15 4.8 15 6.5V8.5"></path>
                    </svg>
                </a>

                <a href="{{ route('login') }}" class="nav-icon-link" aria-label="Login">
                    <svg viewBox="0 0 24 24" class="nav-icon">
                        <path d="M12 12C14.2 12 16 10.2 16 8C16 5.8 14.2 4 12 4C9.8 4 8 5.8 8 8C8 10.2 9.8 12 12 12Z"></path>
                        <path d="M4.5 20C5.4 16.8 8.3 14.5 12 14.5C15.7 14.5 18.6 16.8 19.5 20"></path>
                    </svg>
                </a>
            @endguest

            @auth
                <a href="{{ route('cart.index') }}" class="nav-icon-link" aria-label="Cart">
                    <svg viewBox="0 0 24 24" class="nav-icon">
                        <path d="M6.5 8.5H17.5L18.5 20H5.5L6.5 8.5Z"></path>
                        <path d="M9 8.5V6.5C9 4.8 10.3 3.5 12 3.5C13.7 3.5 15 4.8 15 6.5V8.5"></path>
                    </svg>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf

                    <button type="submit" class="nav-icon-link" aria-label="Logout">
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

    <div class="hero-bottom-card">
        <p>
            Discover curated furniture pieces and elegant collections
            made to bring comfort into every room.
        </p>

        <a href="#collections" class="hero-btn">Explore Collection</a>
    </div>

</section>

<section id="categories" class="categories-section">

    @forelse($categories as $category)
        @php
            $categorySlug = \Illuminate\Support\Str::slug($category->name);
        @endphp

        <article class="category-panel reveal-on-scroll" style="--panel-index: {{ $loop->index }};">
            <div class="category-panel-inner">

                <div class="category-top-row">
                    <p>Find the perfect style for your space</p>
                    <p>Premium furniture, curated by room</p>
                    <a href="#products" class="product-filter-trigger" data-filter="all">Shop Now <span>+</span></a>
                </div>

                <div class="category-number">
                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                </div>

                <div class="category-info">
                    <span>FurniHome Category</span>
                    <h2>{{ $category->name }}</h2>
                    <p>{{ $category->description }}</p>

                    <a href="#products" class="category-link product-filter-trigger" data-filter="{{ $categorySlug }}">
                        Explore {{ $category->name }}
                        <span>+</span>
                    </a>
                </div>

                <div class="category-image-box">
                    @if($category->image)
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                    @else
                        <div class="category-placeholder">
                            No Image
                        </div>
                    @endif
                </div>

                <a href="#products" class="category-arrow product-filter-trigger" data-filter="{{ $categorySlug }}" aria-label="Explore {{ $category->name }}">
                    →
                </a>

            </div>
        </article>
    @empty
        <div class="empty-categories">
            <h2>No categories available yet.</h2>
            <p>Add categories to the database and they will appear here automatically.</p>
        </div>
    @endforelse

</section>

<section id="collections" class="collections-section">

    <div class="collections-frame reveal-on-scroll">

        <article class="collection-panel collection-panel-intro">
            <div class="collection-brand-mark">
                <span></span>
                <strong>FurniHome</strong>
            </div>

            <div class="collection-intro-text">
                <span>Curated Interior Moods</span>
                <h2>Elevating Comfort With Every Room</h2>
                <a href="#products" class="collection-main-btn product-filter-trigger" data-filter="all">
                    Explore Experience
                </a>
            </div>

            <h3>
                Our
                <br>
                Collections
            </h3>
        </article>

        <a
            href="{{ url('/collections/modern-living') }}"
            class="collection-panel collection-image-panel"
            style="--collection-image: url('{{ asset('images/collections/modern-living.png') }}');"
        >
            <div class="collection-overlay-content">
                <span>01</span>
                <p>Soft curves, refined seating, and calm pieces for elegant living spaces.</p>
                <strong>View Collection</strong>
            </div>

            <h3>
                Modern
                <br>
                Living
            </h3>
        </a>

        <a
            href="{{ url('/collections/bedroom-comfort') }}"
            class="collection-panel collection-image-panel"
            style="--collection-image: url('{{ asset('images/collections/bedroom-comfort.png') }}');"
        >
            <div class="collection-overlay-content">
                <span>02</span>
                <p>Warm textures and peaceful silhouettes designed for restful bedrooms.</p>
                <strong>View Collection</strong>
            </div>

            <h3>
                Bedroom
                <br>
                Comfort
            </h3>
        </a>

        <a
            href="{{ url('/collections/dining-elegance') }}"
            class="collection-panel collection-image-panel"
            style="--collection-image: url('{{ asset('images/collections/dining-elegance.png') }}');"
        >
            <div class="collection-overlay-content">
                <span>03</span>
                <p>Balanced dining tables and chairs made for refined everyday gatherings.</p>
                <strong>View Collection</strong>
            </div>

            <h3>
                Dining
                <br>
                Elegance
            </h3>
        </a>

        <a
            href="{{ url('/collections/work-decor') }}"
            class="collection-panel collection-image-panel"
            style="--collection-image: url('{{ asset('images/collections/work-decor.png') }}');"
        >
            <div class="collection-overlay-content">
                <span>04</span>
                <p>Natural accents, workspace pieces, and decor details with quiet character.</p>
                <strong>View Collection</strong>
            </div>

            <h3>
                Work
                <br>
                & Decor
            </h3>
        </a>

    </div>

</section>

<section id="products" class="products-section">

    <div class="products-header reveal-on-scroll">
        <div>
            <span class="section-label">FurniHome Shop</span>
            <h2>Curated Furniture Collection</h2>
        </div>

        <p>
            Explore refined furniture pieces selected for comfort, style,
            and modern home living.
        </p>
    </div>

    <div class="product-filters reveal-on-scroll">
        <button class="product-filter-btn active" data-filter="all">All</button>

        @foreach($categories as $category)
            <button class="product-filter-btn" data-filter="{{ \Illuminate\Support\Str::slug($category->name) }}">
                {{ $category->name }}
            </button>
        @endforeach
    </div>

    <div class="products-grid">
        @forelse($products as $product)
            @php
                $productCategorySlug = \Illuminate\Support\Str::slug($product->category->name ?? 'uncategorized');
                $mainImage = $product->main_image;
            @endphp

            <article class="product-card reveal-on-scroll" data-category="{{ $productCategorySlug }}">
                <div class="product-card-top">
                    <span>{{ $product->category->name ?? 'Furniture' }}</span>

                    <div class="product-variant-dots">
                        @foreach($product->variants as $variant)
                            <button
                                class="product-dot {{ $loop->first ? 'active' : '' }}"
                                data-image="{{ asset($variant->image) }}"
                                aria-label="{{ $variant->color_name }}"
                            >
                                <img src="{{ asset($variant->image) }}" alt="{{ $variant->color_name }}">
                            </button>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('products.show', $product) }}" class="product-image-link">
                    <img src="{{ asset($mainImage) }}" alt="{{ $product->name }}" class="product-card-image">
                </a>

                <div class="product-card-bottom">
                    <div>
                        <h3>{{ $product->name }}</h3>

                        <div class="product-price">
                            <strong>{{ number_format($product->price, 2) }} MAD</strong>

                            @if($product->old_price)
                                <span>{{ number_format($product->old_price, 2) }} MAD</span>
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('products.show', $product) }}" class="product-arrow" aria-label="View {{ $product->name }}">
                        →
                    </a>
                </div>
            </article>
        @empty
            <div class="empty-products">
                <h3>No products available yet.</h3>
                <p>Add products to the database and they will appear here automatically.</p>
            </div>
        @endforelse
    </div>

</section>
<section id="about" class="about-section">

    <div class="about-mini-label">
        <span>+</span>
        About FurniHome
    </div>

    <div class="about-columns">

        <article class="about-column is-visible">
            <div class="about-column-line"></div>

            <div class="about-column-top">
                <h2>01</h2>
                <span>Curated Design</span>
            </div>

            <div class="about-column-bottom">
                <p>
                    Room Styling
                    <br>
                    Premium Furniture Selection
                    <br>
                    Modern Neutral Interiors
                    <br>
                    Elegant Home Atmosphere
                </p>
            </div>
        </article>

        <article class="about-column is-visible">
            <div class="about-column-line"></div>

            <div class="about-column-top">
                <h2>02</h2>
                <span>Shopping Experience</span>
            </div>

            <div class="about-column-bottom">
                <p>
                    Dynamic Product Catalog
                    <br>
                    Color Variants
                    <br>
                    Cart And Checkout
                    <br>
                    Order History And Invoices
                </p>
            </div>
        </article>

        <article class="about-column is-visible">
            <div class="about-column-line"></div>

            <div class="about-column-top">
                <h2>03</h2>
                <span>Delivery & Installation</span>
            </div>

            <div class="about-column-bottom">
                <p>
                    Home Delivery
                    <br>
                    Free Installation
                    <br>
                    Clear Order Follow-Up
                    <br>
                    Comfort After Purchase
                </p>
            </div>
        </article>

    </div>

</section>

<section id="contact" class="contact-section">

    <div class="contact-layout">

        <div class="contact-image-side">
            <img src="{{ asset('images/contact/contact-main.jpg') }}" alt="FurniHome contact">
        </div>

        <div class="contact-form-side">

            <div>
                <div class="contact-form-header">
                    <span>Contact</span>
                    <h2>Get in touch</h2>
                    <p>
                        Have a question about furniture, delivery, installation,
                        or your order? Send us a message.
                    </p>
                </div>

                <form class="contact-form" id="contactForm">

                    <div class="contact-input-group">
                        <label for="contact-name">Name</label>
                        <input
                            type="text"
                            id="contact-name"
                            name="name"
                            placeholder="Your full name"
                            required
                        >
                    </div>

                    <div class="contact-input-group">
                        <label for="contact-email">Your email</label>
                        <input
                            type="email"
                            id="contact-email"
                            name="email"
                            placeholder="Your email address"
                            required
                        >
                    </div>

                    <div class="contact-input-group">
                        <label for="contact-phone">Phone</label>
                        <input
                            type="text"
                            id="contact-phone"
                            name="phone"
                            placeholder="Your phone number"
                            required
                        >
                    </div>

                    <div class="contact-input-group">
                        <label for="contact-message">Your message</label>
                        <textarea
                            id="contact-message"
                            name="message"
                            placeholder="Write your message"
                            required
                        ></textarea>
                    </div>

                    <button type="button" class="contact-submit-btn" id="contactSubmitBtn">
    Send it
</button>

                    <p class="contact-success-message" id="contactSuccessMessage">
                        Your message has been sent successfully.
                    </p>

                </form>
            </div>

            <div class="contact-social-card">
                <span>Follow us on social media</span>

                <div class="contact-social-icons">

                    <a href="#" aria-label="Instagram">
                        <svg viewBox="0 0 24 24">
                            <path d="M7 2H17C19.8 2 22 4.2 22 7V17C22 19.8 19.8 22 17 22H7C4.2 22 2 19.8 2 17V7C2 4.2 4.2 2 7 2Z"></path>
                            <path d="M12 8.2C14.1 8.2 15.8 9.9 15.8 12C15.8 14.1 14.1 15.8 12 15.8C9.9 15.8 8.2 14.1 8.2 12C8.2 9.9 9.9 8.2 12 8.2Z"></path>
                            <path d="M17.4 6.6H17.5"></path>
                        </svg>
                    </a>

                    <a href="#" aria-label="X">
                        <svg viewBox="0 0 24 24">
                            <path d="M18.244 2.25H21.552L14.325 10.51L22.827 21.75H16.17L10.956 14.933L4.99 21.75H1.68L9.41 12.915L1.254 2.25H8.08L12.793 8.481L18.244 2.25ZM17.083 19.77H18.916L7.084 4.126H5.117L17.083 19.77Z"></path>
                        </svg>
                    </a>

                    <a href="#" aria-label="Reddit">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 4.5L15 5.2"></path>
                            <path d="M15 5.2L16.2 3"></path>
                            <path d="M7 10.5C5.6 10.5 4.5 11.6 4.5 13C4.5 14.4 5.6 15.5 7 15.5"></path>
                            <path d="M17 10.5C18.4 10.5 19.5 11.6 19.5 13C19.5 14.4 18.4 15.5 17 15.5"></path>
                            <path d="M7 13.8C7 10.9 9.2 9 12 9C14.8 9 17 10.9 17 13.8C17 16.4 14.8 18.5 12 18.5C9.2 18.5 7 16.4 7 13.8Z"></path>
                            <path d="M10 13H10.1"></path>
                            <path d="M14 13H14.1"></path>
                            <path d="M10.2 15.6C11.1 16.2 12.9 16.2 13.8 15.6"></path>
                        </svg>
                    </a>

                    <a href="#" aria-label="GitHub">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2.5C6.8 2.5 2.6 6.7 2.6 11.9C2.6 16 5.3 19.5 9 20.8C9.5 20.9 9.7 20.6 9.7 20.3V18.7C7 19.3 6.5 17.4 6.5 17.4C6 16.2 5.4 15.9 5.4 15.9C4.5 15.3 5.5 15.3 5.5 15.3C6.5 15.4 7 16.4 7 16.4C7.9 17.9 9.3 17.5 9.8 17.3C9.9 16.7 10.1 16.3 10.4 16C8.2 15.8 5.9 14.9 5.9 11.3C5.9 10.2 6.3 9.4 7 8.7C6.9 8.4 6.5 7.4 7.1 6.1C7.1 6.1 8 5.8 9.8 7.1C10.6 6.9 11.3 6.8 12.1 6.8C12.9 6.8 13.6 6.9 14.4 7.1C16.2 5.8 17.1 6.1 17.1 6.1C17.7 7.4 17.3 8.4 17.2 8.7C17.9 9.4 18.3 10.2 18.3 11.3C18.3 14.9 16 15.8 13.8 16C14.2 16.3 14.5 16.9 14.5 17.8V20.3C14.5 20.6 14.7 20.9 15.2 20.8C18.9 19.5 21.6 16 21.6 11.9C21.4 6.7 17.2 2.5 12 2.5Z"></path>
                        </svg>
                    </a>

                </div>
            </div>

        </div>

    </div>

</section>

<footer class="site-footer reveal-on-scroll">
    <div class="footer-top">

        <div class="footer-column">
            <span class="footer-label">Shop</span>
            <a href="#products">Products</a>
            <a href="#categories">Categories</a>
            <a href="#collections">Collections</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="footer-column">
            <span class="footer-label">Rooms</span>
            <a href="#products" class="product-filter-trigger" data-filter="living-room">Living Room</a>
            <a href="#products" class="product-filter-trigger" data-filter="bedroom">Bedroom</a>
            <a href="#products" class="product-filter-trigger" data-filter="dining-room">Dining Room</a>
            <a href="#products" class="product-filter-trigger" data-filter="office">Office</a>
            <a href="#products" class="product-filter-trigger" data-filter="decor">Decor</a>
        </div>

        <div class="footer-column">
            <span class="footer-label">Customer</span>

            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                <a href="{{ route('login') }}">Cart</a>
                <a href="{{ route('login') }}">My Orders</a>
            @endguest

            @auth
                <a href="{{ route('cart.index') }}">Cart</a>
                <a href="{{ route('orders.index') }}">My Orders</a>

                <form action="{{ route('logout') }}" method="POST" class="footer-logout-form">
                    @csrf
                    <button type="submit" class="footer-logout-btn">Logout</button>
                </form>
            @endauth
        </div>

        <div class="footer-column">
            <span class="footer-label">Company</span>
            <a href="#about">About</a>
            <a href="#collections">Collections</a>
            <a href="#contact">Contact Us</a>
        </div>

        <div class="footer-column footer-contact-column">
            <span class="footer-label">Contact</span>
            <p>FurniHome</p>
            <p>Tangier, Morocco</p>
            <a href="mailto:contact@furnihome.com">contact@furnihome.com</a>
            <a href="tel:+212600000000">+212 6 00 00 00 00</a>

            <a href="#products" class="footer-cta-btn">Shop Now</a>
        </div>

    </div>

    <div class="footer-bottom">
        <h2>FurniHome</h2>
        <p>© 2026 FurniHome. All rights reserved.</p>
    </div>
</footer>

@endsection