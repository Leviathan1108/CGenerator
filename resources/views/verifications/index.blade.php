@extends('layout.v_layout')

@section('content')
<div class="min-vh-100 bg-light">
    <!-- Header -->
    <nav class="nav my-3" style="background-color: #232E66;">
        <h1 class="text-light ms-2 fw-bold">🎓 Certificate Verification</h1>
    </nav>

    <!-- Form Section -->
    <div class="container py-5">
        <div class="text-center mb-4">
            <h3 class="fw-bold">Verification Code Certificate</h3>
        </div>

        <form method="POST" action="{{ route('verifications.check') }}" class="text-center">
            @csrf
        
            <!-- Input Kode -->
            <input type="text" name="verification_code"
                   class="form-control text-center mx-auto mb-3"
                   style="max-width: 500px; height: 45px;"
                   placeholder="Enter certificate ID or scan QR code"
                   required>
        
            <!-- OR -->
            <div class="my-3 text-muted">OR</div>
        
            <!-- QR Scanner -->
            <div id="qr-reader" class="mx-auto mb-4" style="max-width: 300px;"></div>
        
            <!-- Tombol -->
            <div class="mt-4">
                <button type="submit" class="btn px-4 py-2 text-white fw-bold" style="background-color: #232E66;">
                    Verify Certificate
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    const qrCodeReader = new Html5Qrcode("qr-reader");
    qrCodeReader.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: { width: 200, height: 200 } },
        (decodedText) => {
            document.querySelector("input[name='verification_code']").value = decodedText;
            qrCodeReader.stop();
        },
        (errorMessage) => {
            // QR scan error
        }
    ).catch(err => {
        console.error("QR scanner error:", err);
    });
</script>
@endpush
