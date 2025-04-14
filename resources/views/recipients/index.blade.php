@extends ('layout.v_layout')

@section('content')
    <div class="mt-0" style="background-color: rgb(219, 217, 217);">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light">Daftar Penerima Certificate</h1>
        </nav>
        <div class="container">

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
                                        <a href="{{ route('recipients.edit', $recipient->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('recipients.destroy', $recipient->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
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

    </div>
    </div>
@endsection