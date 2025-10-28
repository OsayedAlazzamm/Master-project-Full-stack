@extends('layouts.app')

@section('content')
<h3 class="mb-4 text-center fw-bold">🍴 Restaurants</h3>

<div class="row">
@foreach($restaurants as $restaurant)
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <img src="{{ asset('storage/'.$restaurant->logo_path) }}" class="card-img-top" alt="{{ $restaurant->name }}">
            <div class="card-body text-center">
                <h5>{{ $restaurant->name }}</h5>
                <a href="{{ route('restaurants.show', $restaurant->slug) }}" class="btn btn-danger btn-sm mt-2">View Meals</a>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
