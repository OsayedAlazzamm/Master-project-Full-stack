@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h2 class="text-center mb-4">Website Management Dashboard⚙</h2>

<div class="row justify-content-center g-4">

    <div class="col-md-4">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Restaurants</h5>
                <p class="card-text">Manage All Restaurants: Add, Edit, And Delete.</p>
                <a href="{{ route('admin.restaurants.index') }}" class="btn btn-primary">Go To Restaurants</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Meals</h5>
                <p class="card-text">Manage All Meals: Add, Edit, And Delete.</p>
                <a href="{{ route('admin.meals.index') }}" class="btn btn-success">Go To Meals</a>
            </div>
        </div>
    </div>

</div>
@endsection
