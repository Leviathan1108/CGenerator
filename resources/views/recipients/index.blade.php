<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penerima</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4">Daftar Penerima Sertifikat</h2>

        <a href="{{ route('recipients.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

        @if ($recipients->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Sertifikat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recipients as $recipient)
                            <tr>
                                <td>{{ $recipient->id }}</td>
                                <td>{{ $recipient->name }}</td>
                                <td>{{ $recipient->email }}</td>
                                <td>{{ $recipient->certificate->uid ?? 'Tidak Ada' }}</td>
                                <td>
                                    <a href="{{ route('recipients.edit', $recipient->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('recipients.destroy', $recipient->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">Belum ada data penerima sertifikat.</div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
