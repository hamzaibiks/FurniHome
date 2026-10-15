<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Delivery;
use App\Models\Installation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $cart->load(['items.product', 'items.variant']);

        if ($cart->items->count() === 0) {
            return redirect()->route('cart.index');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'delivery_note' => ['nullable', 'string'],
            'installation_required' => ['required', 'in:yes,no'],
            'payment_method' => ['required', 'in:cash_on_delivery,card'],

            'cardholder_name' => ['required_if:payment_method,card', 'nullable', 'string', 'max:255'],
            'card_number' => ['required_if:payment_method,card', 'nullable', 'string', 'max:25'],
            'expiry_date' => ['required_if:payment_method,card', 'nullable', 'string', 'max:10'],
            'cvv' => ['required_if:payment_method,card', 'nullable', 'string', 'max:4'],
        ]);

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $cart->load(['items.product', 'items.variant']);

        if ($cart->items->count() === 0) {
            return redirect()->route('cart.index');
        }

        $subtotal = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $deliveryFee = 50;
        $installationFee = 0;
        $total = $subtotal + $deliveryFee + $installationFee;

        $order = DB::transaction(function () use ($validated, $cart, $subtotal, $deliveryFee, $installationFee, $total) {
            $orderNumber = 'FH-' . now()->format('YmdHis') . '-' . Auth::id();

            $orderData = $this->filterColumns('orders', [
                'user_id' => Auth::id(),
                'order_number' => $orderNumber,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'installation_fee' => $installationFee,
                'total' => $total,
                'total_amount' => $total,
                'status' => 'pending',
                'order_status' => 'pending',
            ]);

            $order = Order::create($orderData);

            foreach ($cart->items as $item) {
                $itemTotal = $item->price * $item->quantity;

                $orderItemData = $this->filterColumns('order_items', [
    'order_id' => $order->id,
    'product_id' => $item->product_id,
    'product_variant_id' => $item->product_variant_id,

    'product_name' => $item->product->name,
    'product_image' => $item->variant->image ?? $item->product->main_image,
    'variant_name' => $item->variant->color_name ?? 'Default Variant',
    'color_name' => $item->variant->color_name ?? 'Default Variant',

    'quantity' => $item->quantity,

    'price' => $item->price,
    'unit_price' => $item->price,
    'product_price' => $item->price,

    'total' => $itemTotal,
    'subtotal' => $itemTotal,
    'total_price' => $itemTotal,
    'product_total' => $itemTotal,
]);

OrderItem::create($orderItemData);
            }

            $paymentStatus = $validated['payment_method'] === 'card' ? 'paid' : 'pending';
            $transactionReference = $validated['payment_method'] === 'card'
                ? 'FH-PAY-' . strtoupper(Str::random(8))
                : null;

            $paymentData = $this->filterColumns('payments', [
                'order_id' => $order->id,
                'payment_method' => $validated['payment_method'],
                'method' => $validated['payment_method'],
                'payment_status' => $paymentStatus,
                'status' => $paymentStatus,
                'amount' => $total,
                'transaction_reference' => $transactionReference,
                'transaction_id' => $transactionReference,
            ]);

            Payment::create($paymentData);

            $deliveryData = $this->filterColumns('deliveries', [
                'order_id' => $order->id,
                'full_name' => $validated['full_name'],
                'phone' => $validated['phone'],
                'city' => $validated['city'],
                'address' => $validated['address'],
                'delivery_note' => $validated['delivery_note'] ?? null,
                'note' => $validated['delivery_note'] ?? null,
                'delivery_fee' => 50,
                'status' => 'pending',
            ]);

            Delivery::create($deliveryData);

            $installationRequested = $validated['installation_required'] === 'yes';

            $installationData = $this->filterColumns('installations', [
                'order_id' => $order->id,
                'is_requested' => $installationRequested,
                'installation_fee' => 0,
                'fee' => 0,
                'status' => $installationRequested ? 'requested' : 'not_requested',
            ]);

            Installation::create($installationData);

            $cart->items()->delete();

            return $order;
        });

        return redirect()->route('orders.confirmation', $order);
    }

    public function confirmation(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['items.product', 'items.variant', 'payment', 'delivery', 'installation']);

        return view('orders.confirmation', compact('order'));
    }

    private function filterColumns(string $table, array $data): array
    {
        return collect($data)
            ->filter(function ($value, $column) use ($table) {
                return Schema::hasColumn($table, $column);
            })
            ->toArray();
    }
}