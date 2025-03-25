<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Certificate Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
<div class="register-container">
    <div class="register-left">
        <div class="fw-bold fs-4 mb-3">Certificate Generator</div>
        <div class="logo">CG</div>
        <div class="fw-bold text-center">WELCOME TO <br> CERTIFICATE GENERATOR</div>
        <p class="text-warning">Create, manage, and verify certificates</p>
    </div>
    <div class="register-right">
        <h3 class="mb-3 register-subtitle">Register</h3>

        <!-- Alert Sukses -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Register</button>
        </form>
        <p class="mt-3 text-center">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
    </div>
</div>

<!-- JavaScript untuk menghilangkan alert setelah 3 detik -->
<script>
    setTimeout(function() {
        let alert = document.getElementById("success-alert");
        if (alert) {
            alert.style.transition = "opacity 0.5s ease-out";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>

<style>
    body {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    .register-container {
        display: flex;
        max-width: 700px;
        width: 80%;
        min-height: 300px; /* Tambah tinggi jika ingin lebih luas */
        background: white;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .register-left {
        width: 45%;
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
    .register-right {
        width: 60%;
        padding: 40px;
    }
    .register-subtitle {
        font-weight: bold;
        color: blue;
        text-align: center;
    }
    .alert {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }
</style>

</body>
</html>