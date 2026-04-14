<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="margin:0; padding:0; min-height:100vh;">

<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand me-4" href="/">🏠 Laravel App</a>
        <ul class="navbar-nav d-flex flex-row gap-3 me-auto">
            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="/formtest">Form Test</a></li>
            <li class="nav-item"><a class="nav-link" href="/posts">Posts</a></li>
            <li class="nav-item"><a class="nav-link" href="/users">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Books</a></li>
        </ul>
    </div>
</nav>

<div style="padding-top: 56px;">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>