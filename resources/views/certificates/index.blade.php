<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sertifikat</title>
</head>
<body>
    <h1>Daftar Sertifikat</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Template</th>
            <th>Penerima</th>
            <th>No Sertifikat</th>
            <th>Kode Verifikasi</th>
            <th>Tanggal Terbit</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach ($certificates as $certificate)
        <tr>
            <td>{{ $certificate->id }}</td>
            <td>{{ $certificate->template->name }}</td>
            <td>{{ $certificate->recipient->name }}</td>
            <td>{{ $certificate->uid }}</td>
            <td>{{ $certificate->verification_code }}</td>
            <td>{{ $certificate->issued_date }}</td>
            <td>{{ $certificate->status }}</td>
            <td>
                <a href="{{ route('certificates.edit', $certificate->id) }}">Edit</a>
                <form action="{{ route('certificates.destroy', $certificate->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
        
    <a href="{{ route('certificates.create') }}">Tambah Sertifikat</a>
    
</body>
</html>
