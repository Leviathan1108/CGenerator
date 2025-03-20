<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Generator Dashboard</title>
    <link href={{ asset('bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
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
            <ul class="nav flex-column">
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

                <h4 class="mt-4">Recent Activities</h4>
                <ul class="list-group">
                    <li class="list-group-item">Certificate Created: Web Development Course - 2 hours ago</li>
                    <li class="list-group-item">Template Updated: Gold Premium Template - 5 hours ago</li>
                    <li class="list-group-item">Batch Certificates Sent: Marketing Workshop - Yesterday</li>
                    <li class="list-group-item">New Template Created: Executive Training - 2 days ago</li>
                    <li class="list-group-item">Certificate Verified: John Smith - 3 days ago</li>
                </ul>

                <h4 class="mt-4">Quick Actions</h4>
                <div class="btn-group">
                    <button class="btn btn-warning">Create Certificate</button>
                    <button class="btn btn-primary">Upload Recipients</button>
                    <button class="btn btn-danger">Edit Templates</button>
                    <button class="btn btn-success">Send Certificates</button>
                </div>

                <h4 class="mt-4">Certificate Preview</h4>
                <div class="card" style="border: 1px solid #ffcc00;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Certificate of Completion</h5>
                        <p class="card-text">John Doe</p>
                        <span class="badge bg-warning">SEAL</span>
                        <p>Web Development Course</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src={{ asset('bootstrap/js/bootstrap.js') }}></script>
    <script src={{asset('bootsrap/js/bootstrap.min.js')}}></script>
    <script type="module" src="js/script.js"></script>
</body>
</html>