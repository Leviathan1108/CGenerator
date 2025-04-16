@extends ('layout.v_layout')

@section('content')
    <div class="mt-0" style="background-color: rgb(219, 217, 217); height: 100vh;">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light">Tambah Template</h1>
        </nav>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('templatesuperadmin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="name">Nama Template:</label>
            <input type="text" name="name" id="name" required><br>

            <label for="file">File Template:</label>
            <input type="file" name="file" id="file" required><br>

            <button type="submit">Simpan</button>
        </form>

        <a href="{{ route('templatesuperadmin.index') }}">Kembali</a>
    </div>
@endsection