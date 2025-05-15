@extends('layout.v_layout')

@section('content')
<div class="container">
    <h1>Verifikasi Email</h1>
    <p>Silakan cek email kamu dan klik link verifikasi yang kami kirimkan.</p>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            Link verifikasi baru telah dikirim ke alamat email kamu.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button>
    </form>
</div>
@endsection
