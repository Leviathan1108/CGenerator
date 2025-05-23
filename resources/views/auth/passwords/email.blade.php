<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reset Password - Certificate Generator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
</head>
<body>
  <div class="reset-container">
    
    <!-- KIRI -->
    <div class="reset-left">
      <div class="fw-bold fs-4 mb-3">Certificate Generator</div>
      <div class="logo mb-3">CG</div>
      <div class="fw-bold text-center">WELCOME TO <br> CERTIFICATE GENERATOR</div>
      <p class="text-warning fs-6">Create, manage, and verify certificates</p>
    </div>

    <!-- KANAN -->
    <div class="reset-right">
    @if (session('status'))
      <div class="alert alert-success fade-in alert-dismissible fade show text-start rounded-pill shadow-lg" role="alert">
        <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

      <h3 class="mb-3 reset-title">Reset Password</h3>
      <p class="text-start">Enter your email address and we’ll send you a link to reset your password.</p>

      <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus>
            @error('email')
            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-warning fw-bold text-black border-0">
            Send Reset Link
        </button>
    </div>
</form>
      <div class="text-center">
        <p class="mb-0">Remember your password?</p>
        <a href="{{ route('login') }}" class="fw-bold text-decoration-none text-primary">Back to Login</a>
      </div>
    </div>
  </div>
  <style>
    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f8f9fa;
    }
    .reset-container {
      display: flex;
      max-width: 810px;
      background: transparent;
      border-radius: 10px;
      overflow: visible;
      gap: 10px;
    }

    .reset-left {
      width: 45%;
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

    .reset-right {
      width: 65%;
      padding: 40px;
      background: white;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .reset-title {
      font-weight: bold;
      color: blue;
      text-align: center;
    }

    .alert {
      opacity: 0;
      animation: fadeIn 0.5s forwards;
    }

    .alert.show {
      opacity: 1;
    }

    .alert.success {
      background-color: #28a745;
      color: white;
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
        transform: translateY(-10px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const alert = document.querySelector('.alert');
    if (alert) {
      alert.classList.add('show');
    }
  });
  document.querySelector('form').addEventListener('submit', function() {
    const btn = this.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Sending... wait 30-45 seconds`;
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
