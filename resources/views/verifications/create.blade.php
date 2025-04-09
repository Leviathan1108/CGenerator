<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Verifikasi</title>
</head>
<body>
    <h1>Tambah Verifikasi</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ url('/verifications') }}" method="POST">
        @csrf

        <label for="verification_code">Verification Code:</label>
        <input type="text" name="verification_code" required>
        <br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ url('/verifications') }}">Kembali ke Daftar Verifikasi</a>
</body>
</html>
