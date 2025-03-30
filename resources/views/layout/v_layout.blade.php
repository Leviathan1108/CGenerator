<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Generator Dashboard</title>
    <link href={{ asset('bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 790px;
            font-family: 'Montserrat', sans-serif;
        }

        .sidebar .nav-link:hover {
            background-color: #FBB041;
            border-radius: 10px;
        }

        .nav {
            background-color: #232E66;
            width: 85%;
            height: 790px;
        }

        .checkbox-container {
            background-color: #FBB041;
            border-radius: 20px;
            font-size: medium;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 250px;
            height: 40px;
            padding: 0 5px;
        }

        .checkbox-container input[type="checkbox"] {
            margin-right: 10px;
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #f8f9fa;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .checkbox-container input[type="checkbox"]::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            background-color: transparent;
            transform: translate(-50%, -50%) scale(0);
            transition: background-color 0.3s, transform 0.3s;
            clip-path: polygon(14% 44%, 0% 65%, 50% 100%, 100% 26%, 80% 0%, 52% 54%);
        }

        .checkbox-container input[type="checkbox"]:checked {
            background-color: #FBB041;
            border-color: #232E66;
        }

        .checkbox-container input[type="checkbox"]:checked::before {
            background-color: rgb(0, 0, 0);
            transform: translate(-50%, -50%) scale(1);
        }
    </style>
</head>

<body>
    <!-- Menambahkan Allert-Success -->
    @if(session('success'))
        <div id="success-alert" class="alert alert-success text-center">
            {{ session('success') }}
        </div>
        <!--  Script, Membuat agar Allert Hilang dalam 3 detik -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                setTimeout(function () {
                    let alertBox = document.getElementById('success-alert');
                    if (alertBox) {
                        alertBox.style.transition = "opacity 0.5s ease-out";
                        alertBox.style.opacity = "0";
                        setTimeout(() => alertBox.remove(), 500);
                    }
                }, 3000);
            });
        </script>
    @endif

    <div class="d-flex">
        <!-- sidebar -->
        <nav class="sidebar text-dark">
            <h1 class="text-center mt-3 fw-bold">
                <span>Certificate</span>
                <span>Generator</span>
            </h1>
            <div class="text-center mt-3">
                <div class="rounded-circle"
                    style="width: 80px; height: 80px; display: inline-block; background-color: #FBB041; font-family: 'Montderrat', sans-serif;">
                </div>
                <div class="mt-2">{{ Auth::user()->name ?? 'Guest' }} <br> {{ Auth::user()->role ?? 'User' }}</div>
            </div>
            <ul class="nav rounded-4 flex-column d-flex mx-auto">
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/certi">Create New Certificate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/templates">Templates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/certificates">Certificates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/verifications">Verifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/recipients">Recipients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/settings">Settings</a>
                </li>
            </ul>
        </nav>

        <div class="main-content flex-grow-1 p-4 col-md-10">
            <div class="header gap-2 p-3 d-flex space-between align-items-center"
                style="background-color: #FBB041; font-family: 'Montserrat', sans-serif;">
                <h2 class="fs-5"> Welcome back, {{ Auth::user()->name ?? 'Guest' }} </h2>
                <input type="text" class="form-control" placeholder="Search...">
                <div class="d-flex flex-row gap-2">
                    <!-- <button class="btn btn-outline-light">🔔</button> -->
                    <button class="btn btn-light bg-light rounded-circle mx-0 px-3 py-0">👤</button>
                    <!-- mengecek apakah user sudah login -->
                    @guest
                        <a class="login text-decoration-none text-dark fs-4 mx-auto mx-0 my-2"
                            href="{{ route('login') }}">Login</a>
                    @endguest
                    <!-- untuk menampilkan tombol login jika user sudah login -->
                    @auth
                        <a class="dropdown-item text-decoration-none text-dark fs-4 mx-auto mx-0 my-2"
                            href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth
                </div>
            </div>
            <div class="content" style="font-family: 'Poppins', sans-serif;">
                <div class="my-3">
                    <div class="alert alert-warning text-center">
                        You have 5 pending certificates to publish
                    </div>

                    <div class="row text-center g-4">
                        <div class="col">
                            <div class="card" style="background-color: #FBB041;">
                                <div class="card-body">
                                    <h5 class="card-title">Total Certificates</h5>
                                    <h1>84</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="background-color: #FBB041;">
                                <div class="card-body">
                                    <h5 class="card-title">Certificates Sent</h5>
                                    <h1>65</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="background-color: #FBB041;">
                                <div class="card-body">
                                    <h5 class="card-title">Templates</h5>
                                    <h1>12</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="background-color: #FBB041;">
                                <div class="card-body">
                                    <h5 class="card-title">Verifications</h5>
                                    <h1>43</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <h4 class="mt-4">Quick Actions</h4> -->
                    <!-- <div class="btn-group h-100 flex-row d-flex mx-auto gap-4">
                        <button class="btn btn-warning">Verify Certificate</button>
                        <button class="btn btn-primary">Edit Certificate</button>
                        <button class="btn btn-danger">View Certificate History</button>
                        <button class="btn btn-success">User Management</button>
                    </div> -->

                    <!-- input -->
                    <div class="input mt-3 flex-row d-flex gap-4 mt-3 justify-content-between">
                        <div class="checkbox-container">
                            <input type="checkbox" name="verify" id="verify" class="me-2">
                            <label for="verify">Verify Certificate</label>
                        </div>
                        <div class="checkbox-container">
                            <input type="checkbox" name="edit" id="edit" class="me-2">
                            <label for="edit">Edit Certificate</label>
                        </div>
                        <div class="checkbox-container">
                            <input type="checkbox" name="view" id="view" class="me-2">
                            <label for="view">View Certificate</label>
                        </div>
                        <div class="checkbox-container">
                            <input type="checkbox" name="user" id="user" class="me-2">
                            <label for="user">User Management</label>
                        </div>
                    </div>

                </div>
                <div>
                    <div class="row flex-row d-flex justify-content-between me-0">
                        <div class="recent-certificates border rounded-4 p-4 mx-3 w-50 ms-2"
                            style="background-color: rgb(219, 217, 217);">
                            <h2 class="text-white rounded-pill fs-5 d-inline-flex align-items-center justify-content-center px-4 py-2 mb-3"
                                style="background-color: #232E66;">Recent Certificates</h2>
                            <ul class="list-unstyled m-0 p-0">
                                <li class="fw-bold rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                                    style="background-color: rgb(199, 199, 199);">Training Completion <span
                                        class="badge bg-secondary rounded-pill px-3 py-2">Published</span>
                                </li>
                                <label class="text-muted">150 certificates - 12 March 2025</label>
                                <hr>

                                <li class="fw-bold rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                                    style="background-color: rgb(199, 199, 199);">Webinar Attendance <span
                                        class="badge bg-secondary rounded-pill px-3 py-2">Published</span>
                                </li>
                                <label class="text-muted">150 certificates - 12 March 2025</label>
                                <hr>

                                <li class="fw-bold rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                                    style="background-color: rgb(199, 199, 199);">Achievement Awards <span
                                        class="badge bg-secondary rounded-pill px-3 py-2">Published</span>
                                </li>
                                <label class="text-muted">150 certificates - 12 March 2025</label>
                                <hr>

                                <li class="fw-bold rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                                    style="background-color: rgb(199, 199, 199);">Workshop Participation <span
                                        class="badge bg-secondary rounded-pill px-3 py-2">Published</span>
                                </li>
                                <label class="text-muted">150 certificates - 12 March 2025</label>
                            </ul>
                        </div>

                        <div class="popular-templates col-md-5 col-12 border rounded-4 p-4"
                            style="background-color: rgb(219, 217, 217);">
                            <h2 class="text-white rounded-pill fs-5 d-inline-flex align-items-center justify-content-center px-4 py-2 mb-3"
                                style="background-color: #232E66;">Popular Template</h2>
                            <div
                                class="column rounded-3 px-2 py-3 mb-1 d-flex justify-content-between align-items-center">
                                <div class="card w-100" style="max-width: 400px; height: 150px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h6 class="card-title">Certificate Of Completion</h6>
                                        <div class="row">
                                            <span class="col text-start">Basic Completion</span>
                                            <span class="col text-center">Used 225</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="column rounded-3 px-2 py-3 mb-1 d-flex justify-content-between align-items-center">
                                <div class="card w-100" style="max-width:  400px; height: 150px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h6 class="card-title">Certificate of Achievement</h6>
                                        <div class="row">
                                            <span class="col text-start">Basic Completion</span>
                                            <span class="col text-center">Used 225</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="column rounded-3 px-2 py-3 mb-1 d-flex justify-content-between align-items-center">
                                <div class="card w-100" style="max-width:  400px; height: 150px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h6 class="card-title">Certificate of Achievement</h6>
                                        <div class="row">
                                            <span class="col text-start">Basic Completion</span>
                                            <span class="col text-center">Used 225</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <h4 class="mt-4">Certificate Preview</h4>
                <div class="card" style="border: 1px solid #ffcc00;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Certificate of Completion</h5>
                        <p class="card-text">John Doe</p>
                        <span class="badge bg-">SEAL</span>
                        <p>Web Development Course</p>
                    </div>
                </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Tempat untuk konten halaman -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <script src={{ asset('bootstrap/js/bootstrap.js') }}></script>
    <script src={{asset('bootsrap/js/bootstrap.min.js')}}></script>
</body>

</html>