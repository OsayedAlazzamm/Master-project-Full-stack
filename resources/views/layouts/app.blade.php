<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TasteHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('restaurants.index') }}">TasteHub</a>
            <div>
                @auth
                    <a href="{{ route('cart.index') }}" class="btn btn-light btn-sm me-2">🛒 Cart</a>
                    <a href="{{ route('orders.index') }}" class="btn btn-light btn-sm me-2">My Orders</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf
                        <button class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info text-center">{{ session('info') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
