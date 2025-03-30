<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penerima</title>
</head>
<body>
    <a href="{{ route('recipients.create') }}">Tambah Data</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th> 
            <th>Aksi</th>
        </tr>
        @foreach ($recipients as $recipient)
        <tr>
            <td>{{ $recipient->recipient_id }}</td>
            <td>{{ $recipient->name }}</td>
            <td>{{ $recipient->email }}</td>
            <td>{{ $recipient->created_at }}</td>
            <td>{{ $recipient->updated_at }}</td>
            <td>
                <a href="{{ route('recipients.edit', $recipient->recipient_id) }}">Edit</a>
                <form action="{{ route('recipients.destroy', $recipient->recipient_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>                            
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
