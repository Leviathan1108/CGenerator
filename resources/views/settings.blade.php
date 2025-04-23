@extends ('layout.v_layout')

@section('content')
    <div class="mt-0" style="background-color: rgb(219, 217, 217); height: 100vh;">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light ms-2 fw-bold">Settings</h1>
        </nav>
        <h4 class="d-flex justify-center">
            @if(Auth::check() && Auth::user()->photo_profile)
                <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile" class="rounded-circle"
                    style="height: 90px; width: 90px; object-fit: cover;">
            @else
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                    style="height: 90px; width: 90px;">👤</div>
            @endif
        </h4>
        <h3 class="d-flex justify-center">Selamat Datang {{ Auth::user()->username ?? 'Guest' }}</h3>
        <h6 class="d-flex justify-center me-2">Apakah anda ingin mengubah Profile anda?</h6>
        <div class="d-flex justify-center">
            <form action="{{ route('users.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="username" class="form-table">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="{{ Auth::user()->username }}"
                    required><br>

                <label for="photo_profile" class="form-table">Add Your PhotoProfile</label>
                <input type="file" name="photo_profile" class="form-control">
                <br>
                <div class="d-flex justify-center gap-2">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn text-light" style="background-color: #F13C20;"
                        data-bs-dismiss="modal">Discard</button>
                </div>
            </form>
        </div>
    </div>
@endsection
<script src="https://unpkg.com/html5-qrcode"></script>