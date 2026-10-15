@extends('admin.layout')

@section('page-title', 'Products')
@section('page-subtitle', 'Manage FurniHome product catalog.')

@section('content')

<section class="admin-table-card">
    <div class="admin-card-header">
        <div>
            <h2>All products</h2>
            <p>Add, edit, or remove products.</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="admin-small-btn">Add Product</a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Material</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset($product->main_image) }}" class="admin-product-thumb" alt="{{ $product->name }}">
                        </td>

                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'No category' }}</td>
                        <td>{{ number_format($product->price, 2) }} MAD</td>
                        <td>{{ $product->material ?? '-' }}</td>

                        <td>
                            <div class="admin-action-row">
                                <a href="{{ route('admin.products.edit', $product) }}" class="admin-action-btn">Edit</a>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="admin-delete-btn" onclick="return confirm('Delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection