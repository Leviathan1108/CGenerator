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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        .body {
            background-color: #f8f9fa;

        }

        .sidebar {
            color: white;
            height: 100vh;
            width: 15%;
            font-family: 'Montserrat', sans-serif;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link:hover {
            background-color: #FBB041;
            border-radius: 10px;
        }

        .sidebar span {
            font-weight: bold;
        }

        .header {
            background-color: #FBB041;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card {
            margin: 20px;
            background-color: #FBB041;
        }

        .progress {
            height: 20px;
        }

        .nav {
            background-color: #232E66;
            width: 85%;
            height: 945px;
        }

        .rounded-10 {
            border-radius: 10px;
        }

        .content {
            font-family: 'Poppins', sans-serif;
        }

        .btn-group {
            width: 100%;
        }

        .login {
            text-decoration: none;
            color: rgb(0, 0, 0);
            font-size: 25px;
            margin-top: 5px;
        }

        #btn {
            width: 50px;
            height: 50px;
            background-color: rgb(255, 255, 255);
            border-radius: 50%;

        }

        .nav-link {
            font-size: 15px;
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
            border-color: #f8f9fa;
        }

        .checkbox-container input[type="checkbox"]:checked::before {
            background-color: rgb(0, 0, 0);
            transform: translate(-50%, -50%) scale(1);
        }

        .recent-certificates {
            background-color: rgb(219, 217, 217);
            border-radius: 20px;
            width: 500px;
            height: 700px;
            padding: 20px;
            /* Menambahkan padding untuk memberikan jarak di dalam kotak */
            box-sizing: border-box;
            /* Memastikan padding tidak menambah ukuran total */
        }

        #recent {
            background-color: #232E66;
            border-radius: 50px;
            font-size: 20px;
            color: #f8f9fa;
            width: fit-content;
            /* Mengatur lebar agar sesuai dengan konten */
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            /* Mengatur padding kiri dan kanan */
            margin-bottom: 20px;
            /* Memberikan jarak bawah untuk memisahkan dari daftar */
        }

        .recent-certificates ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .recent-certificates ul li {
            background-color: rgb(199, 199, 199);
            font-weight: bold;
            border-radius: 10px;
            border-color: #f0f0f0;
            padding: 10px 20px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .recent-certificates ul li span {
            background-color: rgb(165, 163, 163);
            border-radius: 5px;
            padding: 5px 10px;
        }

        .recent-certificates,
        .popular-templates {
            border-radius: 20px;
            width: 45%;
            /* Mengatur lebar elemen */
            padding: 20px;
            box-sizing: border-box;
            /* Memastikan padding tidak menambah ukuran total */
            margin: 0 30px;
        }

        .popular-templates {
            background-color: rgb(219, 217, 217);
        }

        .popular-templates div {
            background-color: rgb(199, 199, 199);
            border-radius: 10px;
            padding: 10px 20px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .popular-templates span {
            background-color: rgb(165, 163, 163);
            border-radius: 5px;
            padding: 5px 10px;
        }

        #popular {
            background-color: #232E66;
            border-radius: 50px;
            font-size: 20px;
            color: #f8f9fa;
            width: fit-content;
            /* Mengatur lebar agar sesuai dengan konten */
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            /* Mengatur padding kiri dan kanan */
            margin-bottom: 20px;
            /* Memberikan jarak bawah untuk memisahkan dari daftar */
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- sidebar -->
        <nav class="sidebar text-dark bg-light">
            <h1 class="text-center mt-3">
                <span>Certificate</span>
                <span>Generator</span>
            </h1>
            <div class="text-center mt-3">
                <div class="rounded-circle"
                    style="width: 60px; height: 60px; display: inline-block; background-color: #FBB041;"></div>
                <div class="mt-2">John Doe <br> Administrator</div>
            </div>
            <ul class="nav rounded-10 flex-column d-flex mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/certificate">Create New Certificate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/templates">Templates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/certi">Certificates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/verification">Verification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/settings">Settings</a>
                </li>
            </ul>
        </nav>

        <div class="main-content flex-grow-1 p-4">
            <div class="header gap-2">
                <h2>Welcome back, John Doe!</h2>
                <input type="text" class="form-control" placeholder="Search...">
                <div class="d-flex flex-row gap-2">
                    <!-- <button class="btn btn-outline-light">🔔</button> -->
                    <button class="btn btn-light" id="btn">👤</button>
                    <a class="login" href="{{ route('login') }}">Login</a>
                </div>
            </div>

            <div class="content">
                <div class="my-4">
                    <div class="alert alert-warning text-center">
                        You have 5 pending certificates to publish
                    </div>

                    <div class="row text-center">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Certificates</h5>
                                    <h1>84</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Certificates Sent</h5>
                                    <h1>65</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Templates</h5>
                                    <h1>12</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
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
                    <div class="input mt-4 flex-row d-flex mx-auto gap-4">
                        <div class="checkbox-container" style="margin-right: 50px; margin-left: 25px;">
                            <input type="checkbox" name="verify" id="verify">
                            <label for="verify">Verify Certificate</label>
                        </div>
                        <div class="checkbox-container" style="margin-right: 70px;">
                            <input type="checkbox" name="edit" id="edit">
                            <label for="edit">Edit Certificate</label>
                        </div>
                        <div class="checkbox-container">
                            <input type="checkbox" name="view" id="view">
                            <label for="view">View Certificate</label>
                        </div>
                        <div class="checkbox-container" style="margin-left: 55px;">
                            <input type="checkbox" name="user" id="user">
                            <label for="user">User Management</label>
                        </div>
                    </div>

                </div>

                <div class="row d-flex space-between">
                    <div class="recent-certificates">
                        <h2 id="recent">Recent Certificates</h2>
                        <ul>
                            <li>Training Completion <span>Published</span></li>
                            <label>150 certificate 12 maret 2025</label>
                            <hr>
                            <li>Webinar Attendance <span>Published</span></li>
                            <label>150 certificate 12 maret 2025</label>
                            <hr>
                            <li>Achievement Awards <span>Published</span></li>
                            <label>150 certificate 12 maret 2025</label>
                            <hr>
                            <li>Workshop Participation <span>Published</span></li>
                            <label>150 certificate 12 maret 2025</label>
                        </ul>
                    </div>

                    <div class="popular-templates">
                        <h2 id="popular">Popular Template</h2>
                        <div class="column">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Certificate Of Completion</h6>
                                    <span>Used 225</span>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Certificate of Achievement</h6>
                                    <span>Used 225</span>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Participation Certificate</h6>
                                    <span>Used 225</span>
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