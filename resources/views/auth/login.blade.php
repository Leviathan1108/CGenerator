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
            <div class="logo mb-3">CG</div>
            <div class="fw-bold text-center">WELCOME TO <br> CERTIFICATE GENERATOR</div>
            <p class="text-warning fs-9">Create, manage, and verify certificates</p>
        </div>
        
        <!-- Bagian Kanan -->
        <div class="login-right">
            <!-- Menambahkan Allert-Danger -->
            @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert" style="animation: fadeIn 0.5s ease-in-out;">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <span>{{ session('error') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <input type="password" name="password" id="password" class="form-control" required>
                        <button class="btn btn-outline-secondary" type="button" onclick="tombolPassword(this)">
                            <i class="bi bi-eye"></i>
                        </button>
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
</body>
<script>
    function tombolPassword(button) {
        let passInput = document.getElementById("password");
        let icon = button.querySelector("i");

        if (passInput.type === "password") {
            passInput.type = "text";
            icon.classList.replace("bi-eye", "bi-eye-slash");
        } else {
            passInput.type = "password";
            icon.classList.replace("bi-eye-slash", "bi-eye");
        }
    }
</script>
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
        max-width: 810px;
        background: transparent;
        border-radius: 10px;
        overflow: visible;
        gap: 10px;
    }

    .login-left {
        width: 55%;
        background: #232e66;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 24px;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
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
        color: #000;
        margin-bottom: 10px;
    }

    .login-right {
        width: 65%;
        padding: 40px;
        background: white;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-subtitle {
        font-weight: bold;
        color: blue;
        text-align: center;
    }

    .alert {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }
    @keyframes fadeIn {
  from { opacity: 0; transform: translateY(-5px); }
  to { opacity: 1; transform: translateY(0); }
    }
</style>
</html>