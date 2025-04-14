<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Certificate Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body style="height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
        <div class="d-flex bg-light rounded-4 overflow-hidden" style="max: width 800px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
            <div class="text-light d-flex flex-column justify-content-center align-items-center text-center"
                style="padding: 20px; width: 40%; background-color: #232e66;">
                <div class="fw-bold fs-4 mb-3">Certificate Generator</div>
                <div class="d-flex align-items-center justify-content-center fs-3 fw-bold rounded-2 mb-3"
                    style="color: #000; width: 80px; height: 80px; background-color: #fbb041;">CG</div>
                <div class="fw-bold text-center">WELCOME TO <br> CERTIFICATE GENERATOR</div>
                <p class="text-warning fs-9">Create, manage, and verify certificates</p>
            </div>

            <!-- form atau content kiri -->
            <div style="width: 60%; padding: 40px; background-color: white;">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <h3 class="mb-3 text-center fw-bold" style="color: blue;">Reset Password</h3>
            <p class="text-start">Enter your email address and we'll send you <br> a link to reset your password.</p>

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label text-start">{{ __('Email Address') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center mb-3">
                        <button type="submit" class="btn fw-bold" style="background-color: #fbb041; width: 200px;">
                            {{ __('Send Reset Link') }}
                        </button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <p>Remember your password?<br><a href="/login" class="text-decoration-none fw-bold">Back to login </a></p>
            </div>
            </div>
        </div>
</body>
</html>