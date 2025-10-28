@extends('layouts.admin')

@section('title', 'Edit Restaurant')

@section('content')
<h3 class="mb-4 text-center fw-bold">Edit Restaurant</h3>

<form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Restaurant Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $restaurant->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="logo_path" class="form-label">Restaurant Logo</label>
        <input type="file" class="form-control" id="logo_path" name="logo_path" accept="image/*">
        @if($restaurant->logo_path)
            <img src="{{ asset('storage/'.$restaurant->logo_path) }}" width="80" class="mt-2 rounded">
        @endif
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $restaurant->description) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.restaurants.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
