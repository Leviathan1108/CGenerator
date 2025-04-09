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
        
        <label for="certificate_id">Sertifikat:</label>
        <select name="certificate_id" required>
            <option value="">-- Pilih Sertifikat --</option>
            @foreach ($certificates as $certificate)
                <option value="{{ $certificate->id }}">Sertifikat #{{ $certificate->id }}</option>
            @endforeach
        </select>
        

        <label for="name">Nama:</label>
        <input type="text" name="name" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
