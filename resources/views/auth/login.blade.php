<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Certificate Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
</head>
    <body>
<div class="login-container">
    <!-- Bagian Kiri -->
    <div class="login-left">
        <div class="fw-bold fs-4 mb-3">Certificate Generator</div>
        <div class="logo">CG</div>
        <div class="fw-bold text-center">WELCOME TO <br> CERTIFICATE GENERATOR</div>
        <p class="text-warning fs-9">Create, manage, and verify certificates</p>
    </div>
    <!-- Bagian Kanan -->
    <div class="login-right">  
        <!-- Menambahkan Allert-Danger --> 
    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif
        <h3 class="mb-3 login-subtitle">Log in</h3>
        <p>Enter your credentials to access your account</p>
        <form id="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username or Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="email" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <input type="checkbox" name="remember"> Remember me
                </div>
                <a href="{{ route('password.request') }}">Forgot Your Password?</a>
            </div>
            <button type="submit" class="btn btn-warning w-100 fw-bold">LOG IN</button>
        </form>
        <p class="mt-3 text-center">Don't have an account? <a href="/register">Register</a></p>
    </div>
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
            max-width: 800px;
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
        .logo {
            width: 80px;
            height: 80px;
            background: #fbb041;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            border-radius: 10px;
            color: #232e66;
            margin-bottom: 10px;
        }
        .login-right {
            width: 60%;
            padding: 40px;
        }
        .login-subtitle {
        font-weight: bold;
        color: blue;
        text-align: center;
        }
        .alert {
        width: 100%;
        max-width: 400px;
        margin: 0 auto; /* Agar alert tetap sejajar dengan form */
        }
    </style>
</html>
