<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Choose New Password - Certificate Generator</title>
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
      <p class="text-warning fs-9">Create, manage, and verify certificates</p>
    </div>

    <!-- KANAN -->
    <div class="reset-right">
      <h3 class="mb-3 reset-title">choose a new password</h3>
      <p class="text-start mb-4">A strong password is a combination of letters.<br>The length of the password must be at least 8 characters.</p>
      
      <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
          <label class="form-label">Enter a new password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" id="password" class="form-control" required minlength="6">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword(this, 'password')">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Confirm the new password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required minlength="6">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword(this, 'password_confirmation')">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-warning fw-bold text-black border-0">Change password</button>
        </div>
      </form>
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
      width: 100%;
      max-width: 400px;
      margin: 0 auto 20px;
    }
  </style>

  <script>
    function togglePassword(button, inputId) {
      const input = document.getElementById(inputId);
      const icon = button.querySelector("i");

      if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("bi-eye", "bi-eye-slash");
      } else {
        input.type = "password";
        icon.classList.replace("bi-eye-slash", "bi-eye");
      }
    }
  </script>
</body>
</html>
