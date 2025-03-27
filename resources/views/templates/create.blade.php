<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Template</title>
</head>
<body>
    <h1>Tambah Template</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('templates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Nama Template -->
        <label for="name">Nama Template:</label>
        <input type="text" name="name" id="name" required><br>

        <!-- Upload File Template -->
        <label for="file">File Template:</label>
        <input type="file" name="file" id="file" required><br>

        <!-- Layout Storage (Textarea) -->
        <label for="layout_storage">Layout Storage:</label>
        <textarea name="layout_storage" id="layout_storage" rows="4">{{ old('layout_storage') }}</textarea><br>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('templates.index') }}">Kembali</a>
</body>
</html>
