@extends('layouts.admin')

@section('title', 'Add Restaurant')

@section('content')
<h3 class="mb-4 text-center fw-bold">Add New Restaurant</h3>

<form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Restaurant Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="logo_path" class="form-label">Restaurant Logo</label>
        <input type="file" class="form-control" id="logo_path" name="logo_path" accept="image/*">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('admin.restaurants.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
