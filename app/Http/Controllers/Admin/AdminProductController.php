<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    private function filterColumns(string $table, array $data): array
    {
        return collect($data)
            ->filter(fn ($value, $key) => Schema::hasColumn($table, $key))
            ->toArray();
    }

    public function index()
    {
        $products = Product::with('category')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'width' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'depth' => ['nullable', 'numeric'],
            'material' => ['nullable', 'string', 'max:255'],
            'main_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
        ]);

        $imagePath = null;

        if ($request->hasFile('main_image')) {
            $imageName = time() . '-' . Str::slug($request->name) . '.' . $request->file('main_image')->extension();
            $request->file('main_image')->move(public_path('images/products/admin'), $imageName);
            $imagePath = 'images/products/admin/' . $imageName;
        }

        $data = $this->filterColumns('products', [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'width' => $request->width,
            'height' => $request->height,
            'depth' => $request->depth,
            'material' => $request->material,
            'main_image' => $imagePath,
        ]);

        $product = new Product();

        foreach ($data as $key => $value) {
            $product->$key = $value;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'width' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'depth' => ['nullable', 'numeric'],
            'material' => ['nullable', 'string', 'max:255'],
            'main_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
        ]);

        $imagePath = $product->main_image;

        if ($request->hasFile('main_image')) {
            $imageName = time() . '-' . Str::slug($request->name) . '.' . $request->file('main_image')->extension();
            $request->file('main_image')->move(public_path('images/products/admin'), $imageName);
            $imagePath = 'images/products/admin/' . $imageName;
        }

        $data = $this->filterColumns('products', [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'width' => $request->width,
            'height' => $request->height,
            'depth' => $request->depth,
            'material' => $request->material,
            'main_image' => $imagePath,
        ]);

        foreach ($data as $key => $value) {
            $product->$key = $value;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}