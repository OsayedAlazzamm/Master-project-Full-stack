@extends('layouts.app')

@section('content')
<h3 class="text-center fw-bold mb-4">📦 My Orders</h3>

@if($orders->isEmpty())
    <p class="text-center">You haven't made any orders yet</p>
@else
@foreach($orders as $order)
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-danger text-white">
        Order Number #{{ $order->id }} — Status: {{ $order->status }}
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Meal</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->meal->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>
                        @if($order->status === 'pending')
                        <a href="{{ route('orders.cancel', $order->id) }}"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to cancel this order?');">
                            Cancel
                        </a>
                        @else
                        <span class="text-muted">{{ ucfirst($order->status) }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p class="fw-bold text-end">Total: {{ number_format($order->total, 2) }} JD</p>
    </div>
</div>
@endforeach
@endif
@endsection
