@extends('layout.verification')

@section('content')
<div class="container py-5 px-4">
    <h2 class="text-center mb-4">Certificate Verification</h2>

    <div class="text-center mb-4">
        <h5>Verification Code Certificate</h5>

        <form method="POST" action="{{ route('verifications.check') }}">
            @csrf

            <input
                type="text"
                name="verification_code"
                placeholder="Enter certificate ID or scan QR code"
                class="form-control text-center mb-4"
                required
            >

            <!-- QR Scanner Placeholder -->
            <div id="qr-reader" class="mb-3"></div>

            <div class="text-center my-3">
                <span style="color: #888;">OR</span>
            </div>

            <button type="submit" class="btn btn-primary px-4 py-2">
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
