@extends('layouts.app')

@section('content')
<h3 class="text-center fw-bold mb-4">🛒 Cart</h3>

@if(empty($cart))
    <p class="text-center"> The cart is empty</p>
@else
<table class="table table-bordered">
    <thead class="table-danger text-center">
        <tr>
            <th>Image</th>
            <th>Meal</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach($cart as $id => $item)
        @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
        <tr class="text-center">
            <td><img src="{{ asset('storage/'.$item['image']) }}" width="60"></td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['price'] }}</td>
            <td>{{ $subtotal }}</td>
            <td><a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-outline-danger">Remove</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="text-center">
    <h5 class="fw-bold">Total: {{ number_format($total, 2) }} JD</h5>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <button class="btn btn-success mt-3">Confirm Order</button>
    </form>
    <a href="{{ route('cart.clear') }}" class="btn btn-outline-secondary mt-3">Empty the cart</a>
</div>
@endif
@endsection
