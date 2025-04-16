<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Template</title>
</head>
<body>
    <h1>Daftar Template</h1>
    <a href="{{ route('templatesuperadmin.create') }}">Tambah Template</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>File</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Aksi</th>
        </tr>
        @foreach ($templates as $template)
        <tr>
            <td>{{ $template->id }}</td>
            <td>{{ $template->name }}</td>
            <td>
                @if (in_array(pathinfo($template->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ Storage::url($template->file_path) }}" width="100">
                @else
                    <a href="{{ asset('storage/' . $template->file_path) }}" target="_blank">Lihat File</a>
                @endif
            </td>
            <td>{{ $template->user->name ?? 'Tidak Diketahui' }}</td>
            <td>{{ $template->created_at }}</td>
            <td>{{ $template->updated_at }}</td>
            <td>
                <a href="{{ route('templatesuperadmin.edit', $template->id) }}">Edit</a>
                <form action="{{ route('templatesuperadmin.destroy', $template->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus template ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>                
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>