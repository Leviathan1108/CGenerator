 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Template</title>
</head>
<body>
    <h1>Edit Template</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('templates.update', $template->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Nama Template:</label>
        <input type="text" name="name" id="name" value="{{ $template->name }}" required><br>

        <label for="file">File Template (Biarkan kosong jika tidak ingin mengubah):</label>
        <input type="file" name="file" id="file"><br>

        <label for="layout_storage">Layout Storage:</label>
        <textarea name="layout_storage" id="layout_storage" rows="4">{{ $template->layout_storage }}</textarea><br>

        <!-- Field Created By (Tidak bisa diubah) -->
        <label for="created_by">Dibuat Oleh:</label>
        <input type="text" name="created_by" id="created_by" value="{{ $template->created_by }}" readonly><br>

        <!-- Field Created At (Tidak bisa diubah) -->
        <label for="created_at">Dibuat Pada:</label>
        <input type="text" name="created_at" id="created_at" value="{{ $template->created_at }}" readonly><br>

        <!-- Field Updated At (Tidak bisa diubah) -->
        <label for="updated_at">Diperbarui Pada:</label>
        <input type="text" name="updated_at" id="updated_at" value="{{ $template->updated_at }}" readonly><br>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('templates.index') }}">Kembali</a>
</body>
</html>
