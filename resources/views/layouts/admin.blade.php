<!-- File: resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: rgb(16, 12, 4);
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #ffe15d;
            color: rgb(16, 12, 4);
            transition: ease-in cubic-bezier(0.075, 0.82, 0.165, 1);
        }
        .submenu {
            padding-left: 30px;
            font-size: 0.95rem;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->

    <!--
    <div class="sidebar d-flex flex-column p-3">
        <img src="{{ asset('assets/wavebiz_logo.png') }}" alt="Wavebiz Logo" class="mt-4 mb-4" style="width: 12rem;">

        <a href="#">Home</a>
         {{-- {{ route('admin.dashboard') }}  --}}

        <a href="#">Products</a>
        {{-- {{ route('admin.products') }}  --}}
        <div class="submenu">
            <a href="#">Categories</a>
            <div class="submenu">
                <a href="#">Sub-Categories</a>
            </div>
        </div>

        <a href="#">Deliveries</a>
        {{-- {{ route('admin.deliveries') }}  --}}

        <a href="#">Members</a>
        {{-- {{ route('admin.memberlist') }}  --}}

        <a href="#">Audit Log</a>
        {{-- {{ route('admin.auditlog') }}  --}}

        <a href="#">Profile</a>
        {{-- {{ route('admin.profile') }}  --}}

    </div>
    -->

    <div class="sidebar d-flex flex-column p-3">
        <img src="{{ asset('assets/wavebiz_logo.png') }}" alt="Wavebiz Logo" class="mt-4 mb-4" style="width: 12rem;">
    
        <a href="/dashboard" class="{{ Request::is('dashboard') ? 'active-menu' : '' }}">Home</a>
    
        <a href="/products" class="{{ Request::is('products') ? 'active-menu' : '' }}">Products</a>
        <div class="submenu">
            <a href="#">Categories</a>
            <div class="submenu">
                <a href="#">Sub-Categories</a>
            </div>
        </div>
    
        <a href="/deliveries" class="{{ Request::is('deliveries') ? 'active-menu' : '' }}">Deliveries</a>
    
        <a href="/members" class="{{ Request::is('members') ? 'active-menu' : '' }}">Members</a>
    
        <a href="/auditlog" class="{{ Request::is('auditlog') ? 'active-menu' : '' }}">Audit Log</a>
    
        <a href="/profile" class="{{ Request::is('profile') ? 'active-menu' : '' }}">Profile</a>
    </div>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
