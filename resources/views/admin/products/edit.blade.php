@extends('admin.layout')

@section('page-title', 'Edit Product')
@section('page-subtitle', 'Update product information.')

@section('content')

<section class="admin-form-card">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')

        @include('admin.products.form', ['product' => $product])

        <div class="admin-form-actions">
            <a href="{{ route('admin.products.index') }}" class="admin-secondary-btn">Cancel</a>
            <button type="submit" class="admin-action-btn">Update Product</button>
        </div>
    </form>
</section>

@endsection