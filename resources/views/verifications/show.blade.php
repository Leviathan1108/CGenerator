@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($certificate)
            <h3>Certificate Verified</h3>
            <p><strong>Event Name:</strong> {{ $certificate->event_name }}</p>
            <p><strong>Issued Date:</strong> {{ $certificate->issued_date }}</p>
            <p><strong>Status:</strong> {{ $certificate->status }}</p>
            <p><strong>Verification Code:</strong> {{ $certificate->verification_code }}</p>
            <!-- You can display more certificate details here -->
        @else
            <h3>Verification Failed</h3>
            <p>We couldn't find a certificate with the provided verification code.</p>
        @endif
    </div>
@endsection
