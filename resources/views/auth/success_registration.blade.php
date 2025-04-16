<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registration Successful - Certificate Generator</title>
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
      <p class="text-warning fs-9">Create, manage, and verify certificates</p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="success-right">
    <div class="check-icon">✔️</div>
      <h3 class="mb-3 success-title">Registration Successful!</h3>
      <p>Your account has been created successfully. A confirmation email has been sent to your email address.</p>

      <div class="d-grid gap-2 mt-4">
        <a href="/login" class="btn btn-custom">Log in to your account</a>
        <a href="/" class="btn btn-outline-custom">Back to Home</a>
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
    }

    .check-icon {
      font-size: 48px;
      color: #a3d161;
      margin-bottom: 20px;
    }

    .success-title {
      font-weight: bold;
      color: #0279ce;
    }

    .btn-custom {
      background-color: #fbb041;
      color: #000;
      font-weight: bold;
    }

    .btn-outline-custom {
      border: 1px solid #ddd;
      font-weight: bold;
    }
  </style>
</body>
</html>
