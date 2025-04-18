@extends ('layout.v_layout')

@section('content')
    <div class="mt-0" style="background-color: rgb(219, 217, 217); height: 100vh;">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light ms-2 fw-bold">Daftar Template</h1>
        </nav>
        <div class="container">
            <!-- button modal add tempalet -->
            <button style="background-color: #FBB041; border-radius: 10px; border: none;" type="button"
                class="btn text-light" data-bs-toggle="modal" data-bs-target="#modalAdd">
                <!-- <a href="{{ route('templates.create') }}" class="text-decoration-none text-light">Tambah Template</a> -->
                Add Template
            </button>
            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Modal create template superadmin-->
            <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content text-light" style="background-color: #232E66;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add Template</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('templatesuperadmin.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-table">Nama Template</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="name certificate" required><br>
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-table">File Template</label>
                                    <input type="file" class="form-control" name="file" id="file" required><br>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="button" class="btn" style="background-color: #F13C20;" data-bs-dismiss="modal">Discard</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            <table border="1" class="mt-2 table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>File</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                @foreach ($templates as $template)
                    <tr>
                        <td>{{ $template->id }}</td>
                        <td>{{ $template->name }}</td>
                        <td>
                            @if (in_array(pathinfo($template->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ Storage::url($template->file_path) }}" width="100">
                            @else
                                <a href="{{ asset('storage/' . $template->file_path) }}" target="_blank">Lihat File</a>
                            @endif
                        </td>
                        <td>{{ $template->user->name ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $template->created_at }}</td>
                        <td>{{ $template->updated_at }}</td>
                        <td>
                            <!-- button moadal edit -->
                            <button style="background-color: #FBB041; border-radius: 10px; border: none;" type="button"
                                class="btn text-light" data-bs-toggle="modal" data-bs-target="#modalEditTemplate">
                                Edit
                                <!-- <a href="{{ route('templates.edit', $template->id) }}" role="button" class="btn btn-danger">Edit</a> -->
                            </button>
                            <!-- Modal edit template superadmin-->
                            <div class="modal fade" id="modalEditTemplate" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content text-light" style="background-color: #232E66;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Your Template</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('templatesuperadmin.update', $template->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <label for="name" class="form-table">Nama Template</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{ $template->name }}"
                                                    required><br>

                                                <label for="file" class="form-table">File Template (Biarkan kosong jika tidak ingin
                                                    mengubah)</label>
                                                <input type="file" name="file" id="file" class="form-control"><br>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                    <button type="button" class="btn" style="background-color: #F13C20;" data-bs-dismiss="modal">Discard</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- button hapus template -->
                            <button style="background-color: #F13C20; border-radius: 10px; border: none;" type="button"
                                class="btn text-light" data-bs-toggle="modal" data-bs-target="#modalHapusTemplate">
                                Delete
                            </button>
                            <!-- modal untuk delete -->
                            <div class="modal fade" id="modalHapusTemplate" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content text-light" style="background-color: #232E66;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Delete Your Template</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('templates.destroy', $template->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                        <div class="modal-body text-center">
                                        <h3>Are You Sure To Delete?</h3>
                                        <span class="text-warning fw-bold">TEMPLATE "{{ $template->name }}" BY "{{ $template->user->name }}"</span>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Yes</button>
                                            <button type="button" class="btn" style="background-color: #F13C20;" data-bs-dismiss="modal">No</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
<script src="https://unpkg.com/html5-qrcode"></script>