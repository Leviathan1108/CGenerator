@extends ('layout.v_layout')

@section('content')
<div class="mt-0" style="background-color: rgb(219, 217, 217);">
    <nav class="nav my-3" style="background-color: #232E66;">
        <h1 class="text-light">Daftar Certificate</h1>
    </nav>
    <div class="container">
    <table border="1">
        <tr style="background-color: #232E66; color: white;">
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
        <tr style="background-color: white;">
            <td>{{ $certificate->id }}</td>
            <td>{{ $certificate->template->name ?? 'N/A' }}</td>
            <td>{{ $certificate->recipient->name ?? 'N/A' }}</td>            
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
    
    </div>
    </div>
@endsection
