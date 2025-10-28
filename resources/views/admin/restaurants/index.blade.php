@extends('layouts.admin')

@section('title', 'Restaurants')

@section('content')
<h3 class="mb-4 text-center fw-bold">Restaurants Management</h3>

<a href="{{ route('admin.restaurants.create') }}" class="btn btn-success mb-3">Add New Restaurant</a>

<table class="table table-bordered table-striped text-center">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Logo</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($restaurants as $restaurant)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $restaurant->name }}</td>
            <td>
                @if($restaurant->logo_path)
                    <img src="{{ asset('storage/'.$restaurant->logo_path) }}" width="50" alt="{{ $restaurant->name }}">
                @else
                    There Is No Logo
                @endif
            </td>
            <td>{{ $restaurant->description ?? '-' }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center gap-2" style="min-height: 50px;">
                    <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-sm btn-primary">Edit</a>

                    <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST" onsubmit="return confirm('Are You Sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection
