<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Verifikasi</title>
</head>
<body>
    <h1>Daftar Verifikasi</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Status</th>
        </tr>
        @foreach ($verifications as $verification)
        <tr>
            <td>{{ $verification->id }}</td>
            <td>{{ $verification->verification_code }}</td>
            <td>{{ $verification->verified_by }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
