<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Password Updated - Certificate Generator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
</head>
<body>
  <div class="success-container">

    <!-- LEFT PANEL -->
    <div class="success-left">
      <div class="fw-bold fs-4 mb-3">Certificate Generator</div>
      <div class="logo mb-3">CG</div>
      <div class="fw-bold text-center">WELCOME TO <br> CERTIFICATE GENERATOR</div>
      <p class="text-warning fs-6">Create, manage, and verify certificates</p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="success-right">
      <h3 class="mb-3 success-title">Password has been updated</h3>
      <div class="check-icon mb-3">✔️</div>
      <p>"Your new password has been successfully updated. Stay safe and don't share your password with others."</p>

      <div class="d-grid gap-2 mt-4">
        <a href="{{ route('login') }}" class="btn btn-warning fw-bold text-black border-0 ">Back to Login</a>
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
      font-family: 'Segoe UI', sans-serif;
    }

    .success-container {
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
      height: 450px;
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
      width: 65%;
      padding: 40px;
      background: white;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      height: 450px;
    }

    .check-icon-container {
      width: 75px;
      height: 75px;
      background-color: #e1f5ec;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
    }

    .check-icon {
      color: #4caf50;
      font-size: 40px;
    }

    .success-title {
      font-weight: bold;
      color: blue;
      text-align: center;
    }

    .btn-custom {
      background-color: #fbb041;
      color: #000;
      font-weight: bold;
      padding: 12px;
    }
  </style>
</body>
</html>