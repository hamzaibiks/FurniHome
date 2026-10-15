<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with(['items.product', 'items.variant'])
            ->firstOrCreate([
                'user_id' => Auth::id(),
            ]);

        return view('cart.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
     'product_id' => ['required', 'exists:products,id'],
     'product_variant_id' => ['required', 'exists:product_variants,id'],
     'quantity' => ['required', 'integer', 'min:1'],
     'redirect_to' => ['nullable', 'in:checkout'],
      ]);

        $product = Product::findOrFail($validated['product_id']);
        $variant = ProductVariant::where('id', $validated['product_variant_id'])
            ->where('product_id', $product->id)
            ->firstOrFail();

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $price = $variant->price ?? $product->price;

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('product_variant_id', $variant->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $cartItem->quantity + $validated['quantity'];
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'product_variant_id' => $variant->id,
                'quantity' => $validated['quantity'],
                'price' => $price,
            ]);
        }

        if (($validated['redirect_to'] ?? null) === 'checkout') {
    return redirect()->route('checkout.index');
 }

 return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');

 }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cartItem->update([
            'quantity' => $validated['quantity'],
        ]);

        return redirect()->route('cart.index');
    }

    public function destroy(CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $cartItem->delete();

        return redirect()->route('cart.index');
    }

    private function authorizeCartItem(CartItem $cartItem)
    {
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }
    }
}