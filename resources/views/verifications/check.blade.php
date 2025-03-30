<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sertifikat</title>
</head>
<body>
    <h1>Detail Sertifikat</h1>
    
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>Kode Verifikasi</th>
            <td>{{ $certificate->verification_code }}</td>
        </tr>
        <tr>
            <th>Nama Sertifikat</th>
            <td>{{ $certificate->template->name ?? 'Tidak Ada' }}</td>
        </tr>
        <tr>
            <th>Penerima</th>
            <td>{{ $certificate->recipient->name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Diterbitkan Oleh</th>
            <td>{{ $certificate->issuer->name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Terbit</th>
            <td>{{ $certificate->issue_date }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $certificate->status }}</td>
        </tr>
    </table>

    <br>
    <a href="{{ url('/verifications') }}">Kembali ke Daftar Verifikasi</a>
</body>
</html>
