@extends ('layout.v_layout')

@section('content')
    <div class="mt-0" style="background-color: rgb(219, 217, 217); height: 100vh;">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light ms-2 fw-bold">Certificate Verification</h1>
        </nav>
        <div class="container text-center">
            <h3 class="">Verification Code Certificate</h3>
            <form method="POST" action="{{ route('verifications.check') }}">
                @csrf

                <input type="text" name="verification_code" placeholder="Enter certificate ID or scan QR code"
                class="form-control text-center mb-4 mx-auto d-block" style="width: 495px; height: 45px;" required>

                <!-- QR Scanner Placeholder -->
                <div id="qr-reader" class="mb-3"></div>

                <div class="text-center my-3">
                    <span style="color: #888;">OR</span>
                </div>

                <button type="submit" class="btn px-4 py-2 text-light fw-bold" style="background-color: #232E66;">
                    Verify Certificate
                </button>
            </form>
        </div>
    </div>
@endsection
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
            // console.log(`QR scan error: ${errorMessage}`);
        }
    ).catch(err => {
        console.error("QR scanner error:", err);
    });
</script>