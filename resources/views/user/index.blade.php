@extends ('layout.v_layout')
@section('content')
    <div class="mt-0 flex-grow-0" style="background-color: rgb(219, 217, 217); height: 100vh;">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light ms-2 fw-bold">User Management</h1>
        </nav>

        <!-- Filter Section -->
        <div class="bg-light p-1 border border-dark rounded-3 ms-3 me-2">
            <div class="row g-3 align-items-center">
                <!-- filter -->
                <form method="GET" action="{{ route('user.index') }}" class="row g-2 align-items-center">
                    <div class="col-auto fw-bold">Filter User</div>

                    <div class="col-auto">
                        <select name="role" class="form-select">
                            <option value="">All Roles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="superadmin" {{ request('role') == 'superadmin' ? 'selected' : '' }}>Super Admin
                            </option>
                            <option value="recipient" {{ request('role') == 'recipient' ? 'selected' : '' }}>Recipient
                            </option>
                            <option value="guest" {{ request('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn text-light rounded-4"
                            style="background-color: #1E3265;">Filter</button>
                    </div>
                </form>
                <!-- end -->
            </div>
        </div>

        <!-- button luar -->
        <div class="d-flex gap-4 mt-3 ms-3">
            <div class="col-auto">
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalAdd">Add
                    User</button>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- modal create user -->
            <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content text-dark bg-light">
                        <div class="modal-header">
                            <h5 id="staticBackdropLabel">Add User</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-tabel">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                        placeholder="Nama" required><br>
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-tabel">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ old('username') }}" placeholder="username" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-tabel">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-tabel">Role</label>
                                    <select class="form-select" id="role" name="role" placholder="select role" required>
                                        <option value="">Pilih Role</option>
                                        @if(isset($roles))
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                                    {{ ucfirst($role) }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-tabel">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-tabel">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="password confirm" required>
                                </div>
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
            <!-- end -->
            <div class="col-auto">
                <button class="btn text-white" style="background-color: #FBB041;">Bulk Adress</button>
            </div>
        </div>

        <!-- Statistik Ringkas -->
        <div class="row text-start my-4 px-2 fw-bold" style="color: #1E3265;">
            <div class="col-md-4 mb-3">
                <div class="card-custom py-4 rounded-4 ps-2" style="background-color: #57B2FB;">Total Users<br><span
                        class="fs-1"> {{ $totalUser }} </span></div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card-custom py-4 rounded-4 ps-2" style="background-color: #9CEFAB;">Active Users<br><span
                        class="fs-1">{{  $totalActiveUser }}</span></div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card-custom py-4 rounded-4 ps-2" style="background-color: #EFE2BA;">Admins<br><span
                        class="fs-1">{{ $totalAdmin }}</span></div>
            </div>
        </div>

        <!-- Tabel Data User -->
        <div class="table-responsive px-2">
            <table class="table align-middle border-0 rounded-2 overflow-hidden">
                <thead class="text-white bg-[#232E66]">
                    <tr>
                        <th class="py-3 ps-3">User ID</th>
                        <th class="py-3">Name</th>
                        <th class="py-3">Role</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Actions</th>
                        <th class="py-3">aktif</th>
                    </tr>
                </thead>
                <tbody style="background-color: #ffffff;">
                    @foreach ($users as $user)
                        <tr class="align-middle text-start border-bottom">
                            <td class="py-3 ps-3">{{ $user->custom_id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @if ($user->status == 'active')
                                    <span class="badge rounded-pill px-3 py-2 text-white"
                                        style="background-color: #28a745;">Active</span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2 text-white"
                                        style="background-color: #dc3545;">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <!-- edit user -->
                                <a href="{{ route('admin.user.edit', $user->id) }}" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $user->id }}"
                                    class="text-primary me-3 text-decoration-none">Edit</a>
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <!-- modal edit user -->
                                <div class="modal fade" id="modalEdit{{ $user->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-dark bg-light">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.user.update', $user->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT') <!-- Spoof method PUT -->

                                                    <div class="mb-3">
                                                        <label for="username" class="form-tabel">Username</label>
                                                        <input type="text" name="username" class="form-control"
                                                            value="{{ old('username', $user->username) }}"
                                                            placeholder="username" required>
                                                        @error('username')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="role" class="form-tabel">Role</label>
                                                        <select name="role" class="form-select" placeholder="role" required>
                                                            @if(isset($roles))
                                                                @foreach($roles as $role)
                                                                    <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>
                                                                        {{ ucfirst($role) }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('role')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="status" class="form-tabel">Status</label>
                                                        <select name="status" class="form-select" placeholder="status" required>
                                                            <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                                                            <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive
                                                            </option>
                                                        </select>
                                                        @error('status')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
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
                            <!-- end -->
 
                                <!-- button hapus user -->
                                 <button type="button" class="btn text-danger text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $user->id }}">Delete</button>
                                 <!-- modal untuk delete -->
                                  <div class="modal fade" id="modalHapus{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                                  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content text-dark bg-light">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackfropLabel">Delete</h5>
                                        </div>
                                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                        <div class="modal-body text-center">
                                            <h3>Are You Sure To Delete?</h3>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Yes</button>
                                            <button type="button" class="btn" style="background-color: #F13C20;" data-bs-dismiss="modal">No</button>
                                        </div>
                                        </form>
                                    </div>
                                  </div>
                                 </div>
                                  <!-- end -->
                                 <!-- end -->
                            </td>
                            <td>
                                {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Belum Pernah Login' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Pagination -->
        <div class="text-center my-4">
            <button class="btn me-2 text-light rounded-4 mb-3" style="background-color: #232E66;">Prev</button>
            <button class="btn text-light rounded-4 mb-3" style="background-color: #232E66;">Next</button>
        </div>

    </div>
@endsection
<script src="https://unpkg.com/html5-qrcode"></script>