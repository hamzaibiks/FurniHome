@extends('admin.layout')

@section('page-title', 'Add Product')
@section('page-subtitle', 'Create a new FurniHome product.')

@section('content')

<section class="admin-form-card">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf

        @include('admin.products.form', ['product' => null])

        <div class="admin-form-actions">
            <a href="{{ route('admin.products.index') }}" class="admin-secondary-btn">Cancel</a>
            <button type="submit" class="admin-action-btn">Create Product</button>
        </div>
    </form>
</section>

@endsection