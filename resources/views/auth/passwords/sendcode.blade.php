<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Security Verification - Certificate Generator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
  <style>
    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f8f9fa;
    }

    .success-container {
      position: relative;
      display: flex;
      max-width: 810px;
      background: transparent;
      border-radius: 10px;
      overflow: visible;
      gap: 10px;
    }

    .success-left {
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

    .success-right {
      width: 85%;
      padding: 40px;
      background: white;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .security-title {
      font-weight: bold;
      color: #0279ce;
    }

    .security-link {
      color: #0279ce;
    }

    .btn-custom {
      background-color: #fbb041;
      color: #000;
      font-weight: bold;
    }

    .no-wrap {
      white-space: nowrap;
    }

    .fade-out {
      transition: opacity 0.5s ease;
      opacity: 0;
    }
  </style>
</head>
<body>

  @if (session('status'))
    <div id="alertSuccess" class="alert alert-success text-center w-100 mx-auto" role="alert" style="position: absolute; top: 20px; z-index: 999;">
      {{ session('status') }}
    </div>
  @endif

  <div class="success-container">

    <!-- LEFT PANEL -->
    <div class="success-left">
      <div class="fw-bold fs-4 mb-3">Certifikat Generator</div>
      <div class="logo mb-3">CG</div>
      <div class="fw-bold text-center">WELCOME TO <br> CERTIFICATE GENERATOR</div>
      <p class="text-warning fs-6 no-wrap">Create, manage, and verify certificates</p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="success-right">
      <h3 class="mb-3 security-title">Enter Security Code</h3>
      <p class="mb-4">Please check your emails for a message with<br>your code. Your code is 6 numbers long</p>

      <form action="{{ route('verify.security.code') }}" method="POST" >
    @csrf
    <div class="form-group text-start mb-3">
        <label for="securityCode" class="form-label fw-bold">Code</label>
        <input type="text" class="form-control" id="securityCode" name="code" placeholder="Enter code" required>
         <!-- Tambahkan kode ini di sini -->
    @if($errors->has('code'))
        <div class="alert alert-danger mt-2">
            {{ $errors->first('code') }}
        </div>
    @endif
    </div>

    <div class="d-flex justify-content-between mt-4 mb-3">
      <button type="button" class="btn btn-secondary px-4" style="width: 48%;" onclick="window.history.back()">Cancel</button>
      <button type="submit" class="btn btn-custom px-4" style="width: 48%;">Continue</button>
    </div>
</form>
      <div class="mt-2">
        <a href="#" class="text-decoration-none security-link">Didn't get a code?</a>
      </div>
    </div>
  </div>

  <script>
    setTimeout(() => {
      const alert = document.getElementById('alertSuccess');
      if (alert) {
        alert.classList.add('fade-out');
        setTimeout(() => alert.remove(), 1000);
      }
    }, 3000);
  </script>

</body>
</html>
