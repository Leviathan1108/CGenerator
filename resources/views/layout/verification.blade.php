<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate Generator - Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }

        .sidebar {
            background-color: #1a1a5e;
            color: white;
            height: 100vh;
            width: 250px;
            position: fixed;
            padding: 20px;
        }

        .sidebar h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar .nav-item {
            display: flex;
            align-items: center;
            background-color: #2a2a7e;
            color: white;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        .sidebar .nav-item input[type="checkbox"] {
            accent-color: limegreen;
            margin-right: 10px;
        }

        .main {
            margin-left: 250px;
            padding: 30px;
        }

        .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #1a1a5e;
            padding: 10px 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: none;
        }

        .search-bar .login {
            color: white;
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        .search-bar .avatar {
            background-color: #ccc;
            color: #1a1a5e;
            border-radius: 50%;
            padding: 10px;
            font-weight: bold;
            margin-right: 8px;
        }

        .container {
            background-color: #d9d9d9;
            padding: 40px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }

        .container h2 {
            background-color: #1a1a5e;
            color: white;
            margin: -40px -40px 30px -40px;
            padding: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .container h4 {
            margin-bottom: 20px;
        }

        .form-control {
            max-width: 400px;
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin: 0 auto 20px auto;
            display: block;
        }

        #qr-reader {
            width: 200px;
            height: 200px;
            background-color: white;
            border: 1px solid #ccc;
            margin: 0 auto 20px auto;
        }

        .or-divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .or-divider::before,
        .or-divider::after {
            content: '';
            flex: 1;
            border-bottom: 2px solid #aaa;
        }

        .or-divider:not(:empty)::before {
            margin-right: .5em;
        }

        .or-divider:not(:empty)::after {
            margin-left: .5em;
        }

        .btn-primary {
            background-color: #1a1a5e;
            color: white;
            padding: 12px 30px;
            font-weight: bold;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #4444aa;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Certificate Generator</h2>
        <label class="nav-item">
            <input type="checkbox" checked disabled>
            View Certificates
        </label>
        <label class="nav-item">
            <input type="checkbox" checked disabled>
            Edit Certificate
        </label>
        <label class="nav-item">
            <input type="checkbox" checked disabled>
            View History
        </label>
        <label class="nav-item">
            <input type="checkbox" checked disabled>
            User Management
        </label>
    </div>

    <div class="main">
        <div class="search-bar">
            <input type="text" placeholder="Search" />
            <div class="login">
                <div class="avatar">A</div>
                Log in
            </div>
        </div>

        <div class="container">
            <h2>Certificate Verification</h2>
            <h4>Verification Code Certificate</h4>
            <input type="text" class="form-control" placeholder="Enter certificate ID or scan QR code" />
            <div id="qr-reader"></div>
            <div class="or-divider">OR</div>
            <button class="btn-primary">Verify Certifikat</button>
        </div>
    </div>

</body>
</html>
