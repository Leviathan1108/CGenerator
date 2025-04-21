<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user profile</title>
</head>

<body>
    <div class="container mt-4">
        <h2>Edit Profil</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Ada masalah dengan inputanmu.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" value="{{ Auth::user()->username }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="photo_profile" class="form-label">Foto Profil</label><br>
                @if (Auth::user()->photo_profile)
                    <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Foto Profil" width="100"
                        class="mb-2">
                @endif
                <input type="file" name="photo_profile" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <!-- button modal -->
    <button style="background-color: #FBB041; border-radius: 10px; border: none;" type="button" class="btn text-light"
        data-id="{{ Auth::user()->id }}" data-action="{{ route('users.update', Auth::user()->id) }}"
        data-bs-toggle="modal" data-bs-target="#modalchange{{ Auth::user()->id }}">
    </button>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada masalah dengan inputanmu.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- modalnya -->
    <div class="modal fade" id="modalchange{{ Auth::user()->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-light" style="background-color: #232E66;">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Your Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.update', Auth::user()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <label for="username" class="form-table">Username</label>
                        <input type="text" class="form-control" name="username" id="username"
                            value="{{ Auth::user()->username }}" required><br>

                        <label for="photo_profile" class="form-table">Add Your PhotoProfile</label>
                        @if (Auth::user()->photo_profile)
                            <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Foto Profil" width="100"
                                class="mb-2">
                        @endif
                        <input type="file" name="photo_profile" class="form-control">

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn" style="background-color: #F13C20;"
                                data-bs-dismiss="modal">Discard</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>