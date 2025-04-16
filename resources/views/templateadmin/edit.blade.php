<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Template</title>
</head>
<body>
    <h1>Edit Template</h1>

    <form action="{{ route('templatesuperadmin.update', $template->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Nama Template:</label>
        <input type="text" name="name" id="name" value="{{ $template->name }}" required><br>

        <label for="file">File Template (Biarkan kosong jika tidak ingin mengubah):</label>
        <input type="file" name="file" id="file"><br>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('templatesuperadmin.index') }}">Kembali</a>
</body>
</html>
