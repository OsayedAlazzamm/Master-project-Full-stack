@extends('layouts.admin')

@section('title', 'Meals')

@section('content')
<h3 class="mb-4 text-center fw-bold">Meals Management</h3>

<a href="{{ route('admin.meals.create') }}" class="btn btn-success mb-3">Add New Meal</a>

<form method="GET" action="{{ route('admin.meals.index') }}" class="mb-3 d-flex gap-2 align-items-center">
    <label for="restaurant_id" class="mb-0">Choose A Restaurant</label>
    <select name="restaurant_id" id="restaurant_id" class="form-select w-auto">
        <option value="">All Restaurants</option>
        @foreach($restaurants as $restaurant)
            <option value="{{ $restaurant->id }}" {{ request('restaurant_id') == $restaurant->id ? 'selected' : '' }}>
                {{ $restaurant->name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Filter</button>
    <a href="{{ route('admin.meals.index') }}" class="btn btn-secondary">Reset</a>
</form>

<table class="table table-bordered table-striped text-center">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Restaurant</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($meals as $meal)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $meal->name }}</td>
            <td>{{ number_format($meal->price, 2) }} JD</td>
            <td>
                @if($meal->image_path)
                    <img src="{{ asset('storage/'.$meal->image_path) }}" width="50" alt="{{ $meal->name }}">
                @else
                    There Is No Image
                @endif
            </td>
            <td>{{ $meal->restaurant->name }}</td>
            <td>
                <a href="{{ route('admin.meals.edit', $meal->id) }}" class="btn btn-sm btn-primary">Edit</a>

                <form action="{{ route('admin.meals.destroy', $meal->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are You Sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
