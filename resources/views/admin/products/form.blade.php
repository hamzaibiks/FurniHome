<div class="admin-form-grid">

    <div class="admin-input-group">
        <label>Product name</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required>
    </div>

    <div class="admin-input-group">
        <label>Category</label>
        <select name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="admin-input-group">
        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" required>
    </div>

    <div class="admin-input-group">
        <label>Old price</label>
        <input type="number" step="0.01" name="old_price" value="{{ old('old_price', $product->old_price ?? '') }}">
    </div>

    <div class="admin-input-group">
        <label>Width</label>
        <input type="number" step="0.01" name="width" value="{{ old('width', $product->width ?? '') }}">
    </div>

    <div class="admin-input-group">
        <label>Height</label>
        <input type="number" step="0.01" name="height" value="{{ old('height', $product->height ?? '') }}">
    </div>

    <div class="admin-input-group">
        <label>Depth</label>
        <input type="number" step="0.01" name="depth" value="{{ old('depth', $product->depth ?? '') }}">
    </div>

    <div class="admin-input-group">
        <label>Material</label>
        <input type="text" name="material" value="{{ old('material', $product->material ?? '') }}">
    </div>

    <div class="admin-input-group admin-full">
        <label>Description</label>
        <textarea name="description">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="admin-input-group admin-full">
        <label>Main image</label>
        <input type="file" name="main_image">

        @if($product && $product->main_image)
            <img src="{{ asset($product->main_image) }}" class="admin-form-preview" alt="{{ $product->name }}">
        @endif
    </div>

</div>