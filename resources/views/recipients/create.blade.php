@extends ('layout.v_layout')

@section('content')
    <div class="mt-0" style="background-color: rgb(219, 217, 217); height: 100vh;">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light ms-2">Tambah Penerima certificate</h1>
        </nav>
        <form action="{{ route('recipients.store') }}" method="POST">
            @csrf

            <label for="certificate_id">Sertifikat:</label>
            <select name="certificate_id" required>
                <option value="">-- Pilih Sertifikat --</option>
                @foreach ($certificates as $certificate)
                    <option value="{{ $certificate->id }}">Sertifikat #{{ $certificate->id }}</option>
                @endforeach
            </select>


            <label for="name">Nama:</label>
            <input type="text" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <button type="submit">Simpan</button>
        </form>
    </div>
@endsection