<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penerima</title>
</head>
<body>
    <h1>Tambah Penerima</h1>
    <form action="{{ route('recipients.store') }}" method="POST">
        @csrf
        <label for="name">Nama:</label>
        <input type="text" name="name" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
