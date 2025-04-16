<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Updated</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            height: 100vh;
            margin: 0;
        }
        .container-box {
            max-width: 800px;
            margin: auto;
            display: flex;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
            background-color: #fff;
            height: 450px;
        }
        .left-panel {
            background-color: #102655;
            color: white;
            flex: 1;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .left-panel .logo-box {
            background-color: #f8b323;
            color: black;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 24px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .left-panel .title {
            text-align: center;
            font-size: 18px;
            margin-top: 10px;
        }
        .right-panel {
            flex: 2;
            padding: 50px 30px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right-panel h3 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .check-icon {
            font-size: 48px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .back-btn {
            background-color: #f8b323;
            color: black;
            font-weight: bold;
            border: none;
            padding: 10px 30px;
            border-radius: 6px;
            margin-top: 30px;
            text-decoration: none;
        }
        .back-btn:hover {
            background-color: #e4a015;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-box mt-5">
        <!-- Left Panel -->
        <div class="left-panel">
            <div class="logo-box">CG</div>
            <h5 class="fw-bold">CERTIFIKAT GENERATOR</h5>
            <div class="title">
                WELCOME TO <br>
                CERTIFICATE GENERATOR<br>
                <small>Create, manage, and verify certificates</small>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <h3>Password has been updated</h3>
            <div class="check-icon">✔️</div>
            <p>
                "Your new password has been successfully updated. <br>
                Stay safe and don't share your password with others."
            </p>
            <a href="{{ route('login') }}" class="back-btn">Back to Login</a>
        </div>
    </div>
</body>
</html>
