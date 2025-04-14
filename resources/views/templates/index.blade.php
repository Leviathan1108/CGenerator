@extends ('layout.v_layout')

@section('content')
<div class="mt-0" style="background-color: rgb(219, 217, 217);">
    <nav class="nav my-3" style="background-color: #232E66;">
        <h1 class="text-light">Daftar Template</h1>
    </nav>
    <div class="container">
        <button style="background-color: #FBB041; border-radius: 10px; border: none;">
            <a href="{{ route('templates.create') }}" class="text-decoration-none text-light">Tambah Template</a>
        </button>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <table border="1" class="mt-2">
            <tr style="background-color: #232E66; color: white;">
                <th>ID</th>
                <th>Nama</th>
                <th>File</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Aksi</th>
            </tr>
            @foreach ($templates as $template)
                <tr class="bg-light">
                    <td>{{ $template->id }}</td>
                    <td>{{ $template->name }}</td>
                    <td>
                        @if (in_array(pathinfo($template->template_data, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($template->template_data) }}" width="100">
                        @else
                            <a href="{{ asset('storage/' . $template->template_data) }}" target="_blank">Lihat File</a>
                        @endif
                    </td>
                    <td>{{ $template->user->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $template->created_at }}</td>
                    <td>{{ $template->updated_at }}</td>
                    <td>
                        <a href="{{ route('templates.edit', $template->id) }}" role="button" class="btn btn-danger">Edit</a>
                        <form action="{{ route('templates.destroy', $template->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-warning">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        </div>
    </div>
@endsection