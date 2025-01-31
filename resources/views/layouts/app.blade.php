<!DOCTYPE html> 
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'User Management') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url("{{ asset('storage/' . \App\Models\Setting::get('background_image', 'bg-default.jpg')) }}") no-repeat center center fixed;
            background-size: cover;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar img {
            width: 100px;
            display: block;
            margin: 0 auto 10px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar a {
            color: white !important;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <img src="{{ asset('storage/' . \App\Models\Setting::get('logo', 'logo-default.png')) }}" alt="Logo">
    <h4 class="text-center">Menu</h4>
    <ul class="list-unstyled">
        @foreach(json_decode(\App\Models\Setting::get('navigation', '[]'), true) as $nav)
            @if($nav['route'] == 'logout')
                <form action="{{ route($nav['route']) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-link text-white">
                        <i class="{{ $nav['icon'] }}"></i> {{ $nav['title'] }}
                    </button>
                </form>
            @else
                <li>
                    <a href="{{ route($nav['route']) }}">
                        <i class="{{ $nav['icon'] }}"></i> {{ $nav['title'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>

<!-- Main Content Area -->
<div class="content" style="margin-left:260px; padding:20px;">
    <!-- Content -->
    @yield('content')
</div>

</body>
</html>
