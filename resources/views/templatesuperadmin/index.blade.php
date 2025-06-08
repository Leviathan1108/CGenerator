@extends ('layout.v_layout')

@section('content')
    <div class="mt-0" style="background-color: rgb(219, 217, 217); height: 100vh;">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light ms-2 fw-bold">Daftar Template</h1>
        </nav>
        <div class="container">
            <!-- button modal add tempalet -->
            @if (Auth::user()->role === 'superadmin')
            <button style="background-color: #FBB041; border-radius: 10px; border: none;" type="button"
                class="btn text-light" data-bs-toggle="modal" data-bs-target="#modalAdd">
                <!-- <a href="{{ route('templates.create') }}" class="text-decoration-none text-light">Tambah Template</a> -->
                Add Template
            </button>
            @endif

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
            @if (Auth::user()->role === 'superadmin')
            <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content text-dark bg-light">
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

                                <div class="mb-3">
                                    <label for="description" class="form-table">Description</label>
                                    <textarea  name="description" id="description" class="w-full border border-black rounded p-2" rows="4">{{ old('description') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-table">Type</label>
                                    <input list="certificate-types" name="type" class="form-control" placeholder="Select or type certificate type">
                                    <datalist id="certificate-types">
                                        <option value="Attendance Certificate">
                                        <option value="Completion Certificate">
                                        <option value="Award Certificate">
                                        <option value="Competency Certificate">
                                        <option value="Participation Certificate">
                                        <option value="Academic Degree Certificate">
                                        <option value="Training Certificate">
                                        <option value="Membership Certificate">
                                        <option value="Recognition Certificate">
                                        <option value="Certificate of Authenticity">
                                        <option value="Expertise Certificate">
                                        <option value="Inspection Certificate">
                                        <option value="Validation Certificate">
                                        <option value="Registration Certificate">
                                        <option value="Compliance Certificate">
                                    </datalist>
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
            @endif

            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            <table border="1" class="mt-2 table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>File</th>
                    <th>Date</th>
                    <th>Created By</th>
                    <th>Type</th>
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
                        <td>{{ $template->date ? \Carbon\Carbon::parse($template->date)->format('d-m-Y') : '-' }}</td>
                        <td>{{ $template->user->name ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $template->type ?? '-' }}</td>
                        <td>
                            <!-- button moadal edit -->
                            @if (Auth::user()->role === 'superadmin')
                            <button style="background-color: #FBB041; border-radius: 10px; border: none;" type="button"
                                class="btn text-light" data-id="{{ $template->id }}" data-action="{{ route('templates.update', $template->id) }}" data-bs-toggle="modal" data-bs-target="#modalEditTemplate{{ $template->id }}">
                                Edit
                                <!-- <a href="{{ route('templates.edit', $template->id) }}" role="button" class="btn btn-danger">Edit</a> -->
                            </button>
                            <!-- Modal edit template superadmin-->
                            <div class="modal fade" id="modalEditTemplate{{ $template->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content text-dark bg-light">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Your Template</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('templates.update', $template->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <label for="name" class="form-table">Nama Template</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{ $template->name }}"
                                                    required><br>

                                                <label for="file" class="form-table">File Template (Biarkan kosong jika tidak ingin
                                                    mengubah)</label>
                                                <input type="file" name="file" id="file" class="form-control"><br>

                                                <label for="description" class="form-table">Description</label>
                                                <textarea  name="description" id="description" class="w-full border border-black rounded p-2" rows="4">{{ $template->description }}</textarea>

                                                <label for="type" class="form-table">Type</label>
                                                <input list="certificate-types" name="type" class="form-control" placeholder="Select or type certificate type">
                                                <datalist id="certificate-types">
                                                    <option value="Attendance Certificate">
                                                    <option value="Completion Certificate">
                                                    <option value="Award Certificate">
                                                    <option value="Competency Certificate">
                                                    <option value="Participation Certificate">
                                                    <option value="Academic Degree Certificate">
                                                    <option value="Training Certificate">
                                                    <option value="Membership Certificate">
                                                    <option value="Recognition Certificate">
                                                    <option value="Certificate of Authenticity">
                                                    <option value="Expertise Certificate">
                                                    <option value="Inspection Certificate">
                                                    <option value="Validation Certificate">
                                                    <option value="Registration Certificate">
                                                    <option value="Compliance Certificate">
                                                </datalist>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                    <button type="button" class="btn" style="background-color: #F13C20;" data-bs-dismiss="modal">Discard</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- button hapus template -->
                            @if (Auth::user()->role === 'superadmin')
                            <button style="background-color: #F13C20; border-radius: 10px; border: none;" type="button"
                                class="btn text-light" data-bs-toggle="modal" data-bs-target="#modalHapusTemplate{{ $template->id }}">
                                Delete
                            </button>
                            <!-- modal untuk delete -->
                            <div class="modal fade" id="modalHapusTemplate{{ $template->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content text-dark bg-light">
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
                                        <span class="text-dark fw-bold">Template "{{ $template->name }}" By "{{ $template->user->name }}"</span>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Yes</button>
                                            <button type="button" class="btn" style="background-color: #F13C20;" data-bs-dismiss="modal">No</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                                <span class="text-muted">View Only</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
<script src="https://unpkg.com/html5-qrcode"></script>