@extends('layout.v_layout')

@section('content')
<style>
    .maxy-header {
        background-color: #232E66;
        padding: 2rem 1rem;
        color: white;
    }

    .maxy-btn {
        background-color: #232E66;
        color: white;
        font-weight: bold;
        border-radius: 50px;
        transition: 0.3s ease;
    }

    .maxy-btn:hover {
        background-color: #1d2657;
    }

    .maxy-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .maxy-code {
        background-color: #fde68a;
        color: #92400e;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: bold;
        font-family: monospace;
    }

    @media (max-width: 576px) {
        #qr-reader {
            width: 100% !important;
        }
    }
</style>

<div class="min-vh-100 bg-light">
    <!-- Header -->
    <nav class="nav my-3" style="background-color: #232E66;">
        <h1 class="text-light ms-2 fw-bold">🎓 Certificate Verification</h1>
    </nav>

<div class="container py-5">
    <!-- Verification Result -->
    @isset($certificate)
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="maxy-card bg-white p-4 mb-5">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <h5 class="fw-bold text-primary mb-4 fs-4">📄 Certificate Information</h5>
                        <ul class="list-group list-group-flush fs-5">
                            
                            <li class="list-group-item px-0"><strong>Code Certificate:</strong> {{ $certificate->uid }}</li>
                            <li class="list-group-item px-0"><strong>Recipient Role:</strong> {{ $certificate->role }}</li>
                            <li class="list-group-item px-0"><strong>Description:</strong> {{ $certificate->description }}</li>
                            <li class="list-group-item px-0"><strong>Date Issued:</strong> {{ \Carbon\Carbon::parse($certificate->date)->format('d M Y') }}</li>
                            <li class="list-group-item px-0"><strong>Status:</strong>
                                <span class="badge bg-success">{{ ucfirst($certificate->status) }}</span>
                            </li>
                            <li class="list-group-item px-0"><strong>Verification Code:</strong>
                                <span class="maxy-code">{{ $certificate->verification_code }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 text-center">
                        <h5 class="fw-bold text-primary mb-4 fs-4">🖼️ Certificate Preview</h5>
                        @if($certificate->file_path)
                        <img src="{{ asset('storage/' . $certificate->file_path) }}"
                        alt="Certificate Image"
                        class="img-fluid rounded border shadow-sm"
                        style="max-height: 450px; max-width: 100%; object-fit: contain;">   
                        @else
                            <div class="alert alert-warning mt-3">Certificate image not available.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</div>

<!-- QR Reader Script -->
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
            // console.warn(`QR scan error: ${errorMessage}`);
        }
    ).catch(err => {
        console.error("QR scanner error:", err);
    });
</script>
@endsection
