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
            <th>Certificate Id</th>
            <th>Template Id</th>
            <th>Recipient Id</th>
            <th>Issued By</th>
            <th>Issue Date</th>
            <th>Status</th>
            <th>Verification Code</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Aksi</th>
        </tr>
        @foreach ($certificates as $certificate)
        <tr>
            <td>{{ $certificate->certificate_id }}</td>
            <td>{{ $certificate->template_id }}</td>
            <td>{{ $certificate->recipient_id }}</td>
            <td>{{ $certificate->issued_by }}</td>
            <td>{{ $certificate->issue_date }}</td>
            <td>{{ $certificate->status }}</td>
            <td>{{ $certificate->verification_code }}</td>
            <td>{{ $certificate->created_at }}</td>
            <td>{{ $certificate->updated_at }}</td>
            <td>
                <a href="{{ route('certificates.edit', $certificate->certificate_id) }}">Edit</a>
                <form action="{{ route('certificates.destroy', $certificate->certificate_id) }}" method="POST" style="display:inline;">                
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus sertifikat ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    <a href="{{ route('certificates.create') }}">Tambah Sertifikat</a>
    
</body>
</html>
