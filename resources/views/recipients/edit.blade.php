@extends ('layout.v_layout')

@section('content')
    <div class="mt-0" style="background-color: rgb(219, 217, 217); height: 100vh;">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light ms-2">Edit Penerima certificate</h1>
        </nav>
        <form action="{{ route('recipients.update', $recipient->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Nama:</label>
            <input type="text" name="name" value="{{ $recipient->name }}" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ $recipient->email }}" required><br>
            <label for="certificate_id">Sertifikat:</label>
            <select name="certificate_id" required>
                <option value="">-- Pilih Sertifikat --</option>
                @foreach ($certificates as $certificate)
                    <option value="{{ $certificate->id }}" {{ $certificate->id == $recipient->certificate_id ? 'selected' : '' }}>
                        Sertifikat #{{ $certificate->id }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Update</button>
        </form>
    </div>
@endsection