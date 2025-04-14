<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - Certificate Generator</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800;900&family=Poppins:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Left Panel -->
        <div class="left-panel">
            <div class="logo-title">Certifikat Generator</div>
            <div class="logo-box">
                <div class="logo-text">CG</div>
            </div>
            <div class="welcome-text">WELCOME TO<br>CERTIFICATE GENERATOR</div>
            <div class="subtitle">Create, manage, and verify certificates</div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#a3d161" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <h1 class="success-title">Registertration Successful!</h1>
            <p class="success-message">Your account has been created successfully. A confirmation email has been sent to your email address.</p>
            <button class="login-btn"><a href="/login">Log in to your account</a></button>
            <button class="home-btn">Back to Home</button>
        </div>
    </div>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            height: 600px;
            gap: 10px;
        }

        .left-panel {
            flex: 1;
            background-color: #1e2d69;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 40px 20px;
        }

        .logo-title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .logo-box {
            width: 120px;
            height: 120px;
            background-color: #fbb041;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-text {
            font-size: 38px;
            font-weight: bold;
            color: black;
        }

        .welcome-text {
            font-size: 24px;
            font-weight: 900;
            margin-bottom: 15px;
        }

        .subtitle {
            font-size: 18px;
            color: #fbb041;
        }

        .right-panel {
            flex: 1;
            background-color: white;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-align: center;
            border: 1px solid #e5e5e5;
        }

        .check-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 30px;
            color: #a3d161;
        }

        .success-title {
            font-size: 30px;
            font-weight: bold;
            color: #0279ce;
            margin-bottom: 20px;
        }

        .success-message {
            font-size: 16px;
            color: #333;
            margin-bottom: 40px;
            max-width: 400px;
            line-height: 1.5;
        }

        .login-btn {
            background-color: #fbb041;
            color: black;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            max-width: 320px;
            margin-bottom: 15px;
        }

        .home-btn {
            background-color: white;
            color: black;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            max-width: 320px;
        }
    </style>
</body>
</html>