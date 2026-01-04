<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ElectroStore Admin</title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #212529;
        }

        .sidebar .nav-link {
            color: #adb5bd;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #343a40;
            color: #fff;
        }
    </style>
</head>

<body class="bg-light">

<div class="d-flex">

    <!-- Sidebar -->
    <aside class="sidebar p-3">
        @include('layouts.sidebar')
    </aside>

    <!-- Main content -->
    <div class="flex-grow-1">

        <!-- Top bar -->
        <div class="bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h5>
            <span class="text-muted small">{{ now()->format('Y-m-d') }}</span>
        </div>

        <!-- Page content -->
        <main class="p-4">
            @yield('content')
        </main>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
