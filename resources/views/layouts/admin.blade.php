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
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #495057;
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

    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-center py-3">Admin Panel</h4>
        <a href="#">Home</a>
         {{-- {{ route('admin.dashboard') }}  --}}
        <a href="#">Products</a>
        <div class="submenu">
            <a href="#">Categories</a>
            <div class="submenu">
                <a href="#">Sub-Categories</a>
            </div>
        </div>
        <a href="#">Deliveries</a>
        <a href="#">Members</a>
        <a href="#">Audit Log</a>
        <a href="#">Profile</a>
    </div>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
