<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Enter Security Code - Certificate Generator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .code-container {
      display: flex;
      width: 800px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .code-left {
      background-color: #232e66;
      color: white;
      width: 45%;
      padding: 30px;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .logo {
      width: 80px;
      height: 80px;
      background-color: #fbb041;
      color: black;
      font-weight: bold;
      font-size: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      margin-bottom: 20px;
    }

    .code-right {
      width: 55%;
      padding: 40px;
    }

    .code-right h3 {
      text-align: center;
      font-weight: bold;
      color: #232e66;
      margin-bottom: 15px;
    }

    .code-right p {
      text-align: center;
      font-size: 14px;
      color: #000;
    }

    .form-label {
      font-weight: 500;
      color: #000;
    }

    .btn-orange {
      background-color: #fbb041;
      font-weight: bold;
      color: black;
      border: none;
    }

    .btn-orange:hover {
      background-color: #e0a031;
      color: black;
    }

    .btn-cancel {
      background-color: #dee2e6;
      color: black;
      font-weight: bold;
    }

    .btn-cancel:hover {
      background-color: #cfcfcf;
      color: black;
    }

    input:focus {
      box-shadow: none;
      border-color: #fbb041;
    }
  </style>
</head>
<body>
  <div class="code-container">
    
    <!-- KIRI -->
    <div class="code-left">
      <div class="logo">CG</div>
      <h5 class="fw-bold mb-3">Certificate Generator</h5>
      <div class="fw-bold">WELCOME TO <br> CERTIFICATE GENERATOR</div>
      <p class="text-warning mt-2">Create, manage, and verify certificates</p>
    </div>

    <!-- KANAN -->
    <div class="code-right">
      <h3>enter security code</h3>
      <p class="text-secondary text-center">
    Please check your email for a message with your code. It’s 6 numbers long.
</p>
      <form method="POST" action="{{ route('verify.code.verify') }}">
            @csrf
            <div class="mb-3">
            @if ($errors->has('code'))
            <div class="alert alert-danger mt-2">
                {{ $errors->first('code') }}
            </div>
        @endif
        </div>
        <label for="code" class="form-label">Code</label>
        <input type="text" id="code" name="code" class="form-control" maxlength="6" required />
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-cancel w-50" onclick="window.location.href='{{ route('login') }}'">Cancel</button>
        <button type="submit" class="btn btn-orange w-50">Continue</button>
    </div>
    <div class="text-center mt-3">
        <a href="#" class="text-decoration-none text-primary">Didn't get a code?</a>
    </div>
</form>

    </div>
  </div>
</body>
</html>
