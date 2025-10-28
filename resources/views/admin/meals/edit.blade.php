@extends('layouts.admin')

@section('title', 'Edit Meal')

@section('content')
<h3 class="mb-4 text-center fw-bold">Edit The Meal</h3>

<form action="{{ route('admin.meals.update', $meal->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="restaurant_id" class="form-label">Restaurant</label>
        <select name="restaurant_id" id="restaurant_id" class="form-select" required>
            <option value="">Choose A Restaurant</option>
            @foreach($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}" {{ old('restaurant_id', $meal->restaurant_id) == $restaurant->id ? 'selected' : '' }}>
                    {{ $restaurant->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Meal Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $meal->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $meal->price) }}" required>
    </div>

    <div class="mb-3">
        <label for="image_path" class="form-label">Meal Image</label>
        <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
        @if($meal->image_path)
            <img src="{{ asset('storage/'.$meal->image_path) }}" width="80" class="mt-2 rounded">
        @endif
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $meal->description) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.meals.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
