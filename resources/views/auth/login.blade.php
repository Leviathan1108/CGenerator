<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Certificate Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="subtitle">Certificate Generator</div>
            <div class="logo">CG</div>
            <div class="welcome-text">WELCOME TO <br>CERTIFICATE GENERATOR</div>
            <p class="definisi">Create, manage, and verify certificates</p>
        </div>
        <div class="login-right">
            <h3 class="mb-3">Log in</h3>
            <p>Enter your credentials to access your account</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username or Email</label>
                    <div class="input-group">
                        <span class="input-group-text">&#128100;</span>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">&#128274;</span>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <input type="checkbox" name="remember"> Remember me
                    </div>
                    <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                </div>
                <button type="submit" class="btn btn-warning w-100">LOG IN</button>
            </form>
            <p class="mt-3 text-center">Don't have an account? click here<a href="/register">Register</a></p>
        </div>
    </div>
</body>
<style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-container {
            display: flex;
            width: 800px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .login-left {
            width: 40%;
            background: #232e66;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }
        .login-left .subtitle {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .login-left .logo {
            width: 80px;
            height: 80px;
            background: #fbb041;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            font-weight: bold;
            border-radius: 10px;
            color: #232e66;
            margin-bottom: 10px;
        }
        .welcome-text {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            line-height: 1.2;
        }
        .definisi {
            margin-top: 5px;
            color: #fbb041;
        }
        .login-right {
            width: 60%;
            padding: 40px;
        }
    </style>
</html>
