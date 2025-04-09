<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Subscription</title>
</head>
<body>
    <h1>Tambah Subscription</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('subscriptions.store') }}" method="POST">
        @csrf
        <label for="name">Nama:</label>
        <input type="text" name="name" required><br>

        <label for="price">Harga:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label for="duration">Durasi (hari):</label>
        <input type="number" name="duration" required><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('subscriptions.index') }}">Kembali ke Daftar Subscription</a>
</body>
</html>
