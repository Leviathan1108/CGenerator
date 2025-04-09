<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Verifikasi</title>
</head>
<body>
    <h1>Daftar Verifikasi</h1>
    <a href="{{ url('/verifications/create') }}">Tambah Data</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Verification Code</th>
            <th>Sertifikat</th>
            <th>Penerima</th>
            <th>Diterbitkan Oleh</th>
            <th>Verified At</th>
            <th>Aksi</th>
        </tr>
        @foreach ($verifications as $verification)
        <tr>
            <td>{{ $verification->id }}</td>
            <td>{{ $verification->verification_code }}</td>
            <td>{{ $verification->certificate->template->name ?? 'Tidak Ada' }}</td>
            <td>{{ $verification->certificate->recipient->name ?? '-' }}</td>
            <td>{{ $verification->certificate->issuer->name ?? '-' }}</td>
            <td>{{ $verification->verified_at }}</td>
            <td><a href="{{ url('/check-certificate/' . $verification->verification_code) }}">Cek Sertifikat</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>
