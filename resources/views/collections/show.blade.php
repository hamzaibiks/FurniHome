@extends('layouts.app')

@section('content')

<section class="collection-show-page">

    <div class="collection-show-bg">
        <img src="{{ asset($collection['image']) }}" alt="{{ $collection['title'] }}">
    </div>

    <div class="collection-show-soft-layer"></div>

    <div class="collection-show-brand">
        <span></span>
        <strong>FurniHome</strong>
    </div>

    <div class="collection-show-small-text">
        Where Form
        <br>
        and Function Unite
    </div>

    <div class="collection-show-main-heading">
        <h1>
            Elevating Comfort
            <br>
            With Every Curve
        </h1>

        <a
            href="{{ route('home') }}?filter={{ $collection['filter'] }}#products"
            class="collection-show-explore"
        >
            Explore Experience
        </a>
    </div>

    <a href="{{ route('home') }}#collections" class="collection-show-back">
        ← Back to Collections
    </a>

    <div class="collection-show-title">
        <span>Our</span>
        <h2>{{ $collection['title'] }}</h2>
    </div>

    <div class="collection-show-description">
        <p>
            {{ $collection['description'] }}
        </p>

        <div class="collection-show-tags">
            @foreach($collection['details'] as $detail)
                <small>{{ $detail }}</small>
            @endforeach
        </div>
    </div>

    <div class="collection-show-scroll">
        Scroll down to explore
        <span>↓</span>
    </div>

</section>

@endsection