<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penerima</title>
</head>
<body>
    <h1>Edit Penerima</h1>
    <form action="{{ route('recipients.update', $recipient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nama:</label>
        <input type="text" name="name" value="{{ $recipient->name }}" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $recipient->email }}" required><br>
        <label for="certificate_id">Sertifikat:</label>
        <select name="certificate_id" required>
            <option value="">-- Pilih Sertifikat --</option>
            @foreach ($certificates as $certificate)
                <option value="{{ $certificate->id }}" {{ $certificate->id == $recipient->certificate_id ? 'selected' : '' }}>
                    Sertifikat #{{ $certificate->id }}
                </option>
            @endforeach
        </select>
        
        <button type="submit">Update</button>
    </form>
</body>
</html>