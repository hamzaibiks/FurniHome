@extends('admin.layout')

@section('page-title', 'Orders')
@section('page-subtitle', 'Manage customer orders, payment, delivery, and installation.')

@section('content')

<section class="admin-table-card">
    <div class="admin-card-header">
        <div>
            <h2>All orders</h2>
            <p>Update order statuses quickly.</p>
        </div>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Order Status</th>
                    <th>Payment</th>
                    <th>Delivery</th>
                    <th>Installation</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                    @php
                        $total = $order->total ?? $order->total_amount ?? 0;
                        $paymentStatus = $order->payment->payment_status ?? $order->payment->status ?? 'pending';
                        $deliveryStatus = $order->delivery->status ?? 'pending';
                        $installationStatus = $order->installation->status ?? 'pending';
                    @endphp

                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Customer' }}</td>
                        <td>{{ number_format($total, 2) }} MAD</td>

                        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <td>
                                <select name="status" class="admin-select">
                                    <option value="pending" {{ ($order->status ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ ($order->status ?? '') === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ ($order->status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ ($order->status ?? '') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>

                            <td>
                                <select name="payment_status" class="admin-select">
                                    <option value="pending" {{ $paymentStatus === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $paymentStatus === 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="failed" {{ $paymentStatus === 'failed' ? 'selected' : '' }}>Failed</option>
                                    <option value="refunded" {{ $paymentStatus === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                            </td>

                            <td>
                                <select name="delivery_status" class="admin-select">
                                    <option value="pending" {{ $deliveryStatus === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="preparing" {{ $deliveryStatus === 'preparing' ? 'selected' : '' }}>Preparing</option>
                                    <option value="shipped" {{ $deliveryStatus === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $deliveryStatus === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $deliveryStatus === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>

                            <td>
                                <select name="installation_status" class="admin-select">
                                    <option value="pending" {{ $installationStatus === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="requested" {{ $installationStatus === 'requested' ? 'selected' : '' }}>Requested</option>
                                    <option value="scheduled" {{ $installationStatus === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                    <option value="completed" {{ $installationStatus === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $installationStatus === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>

                            <td>
                                <button type="submit" class="admin-action-btn">Save</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection