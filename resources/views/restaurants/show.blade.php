@extends('layouts.app')

@section('content')
<h3 class="mb-4 text-center fw-bold">{{ $restaurant->name }} - Meals</h3>

<div class="row">
@foreach($meals as $meal)
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <img src="{{ asset('storage/'.$meal->image_path) }}" class="card-img-top" alt="{{ $meal->name }}">
            <div class="card-body text-center">
                <h5>{{ $meal->name }}</h5>
                <p class="text-muted">{{ number_format($meal->price, 2) }} JD</p>
                
                <form action="{{ route('cart.add', $meal->id) }}" method="POST" class="d-flex flex-column align-items-center">
                    @csrf
                    <div class="input-group mb-2" style="width:120px;">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decreaseQty('qty-{{ $meal->id }}')">-</button>
                        <input type="number" name="quantity" id="qty-{{ $meal->id }}" value="1" min="1" class="form-control text-center" />
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increaseQty('qty-{{ $meal->id }}')">+</button>
                    </div>
                    <button class="btn btn-danger btn-sm">Add To Cart</button>
                </form>

            </div>
        </div>
    </div>
@endforeach
</div>

<script>
function increaseQty(id){
    const input = document.getElementById(id);
    input.value = parseInt(input.value) + 1;
}
function decreaseQty(id){
    const input = document.getElementById(id);
    if(parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
}
</script>
@endsection
