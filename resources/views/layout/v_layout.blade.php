<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Generator Dashboard</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            height: 100vh;
        }
        .sidebar .nav-link {
            color: white;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        .header {
            background-color: #ffcc00;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card {
            margin: 20px;
        }
        .progress {
            height: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav class="sidebar flex-shrink-0">
            <h1 class="h5 text-center mt-3">Certificate Generator</h1>
            <div class="text-center mt-3">
                <div class="rounded-circle bg-warning" style="width: 60px; height: 60px; display: inline-block;"></div>
                <div class="mt-2">John Doe <br> Administrator</div>
            </div>

            <!-- Tombol Login -->
            <div class="text-center mt-3">
    <a href="{{ route('login') }}" class="btn btn-primary w-100">Login</a>
    <a href="{{ route('register') }}" class="btn btn-success w-100 mt-2">Register</a>
</div>
 <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link" href="/">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/templates">Templates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/certificate">Certificates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/settings">Settings</a>
                </li>
            </ul>
        </nav>

        <div class="main-content flex-grow-1 p-4">
            <div class="header">
                <h2>Welcome back, John Doe!</h2>
                <input type="text" class="form-control" placeholder="Search...">
                <div>
                    <button class="btn btn-outline-light">🔔</button>
                    <button class="btn btn-outline-light">👤</button>
                </div>
            </div>

            <!-- Tempat untuk konten halaman -->
            <div class="container mt-4">
                @yield('content')
            </div>

        </div>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="module" src="js/script.js"></script>
</body>
</html>
