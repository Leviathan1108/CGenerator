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
                <button class="btn btn-success">Add User</button>
            </div>

            <div class="col-auto">
                <button class="btn text-white" style="background-color: #FBB041;">Bulk Adress</button>
            </div>
        </div>

        <!-- Statistik Ringkas -->
        <div class="row text-start my-4 px-2 fw-bold" style="color: #1E3265;">
            <div class="col-md-4 mb-3">
                <div class="card-custom py-4 rounded-4 ps-2" style="background-color: #57B2FB;">Total Users<br><span
                        class="fs-1">{{ $totalUser }}</span></div>
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
                                <a href="#" class="text-primary me-3 text-decoration-none">Edit</a>
                                <a href="#" class="text-danger text-decoration-none">Delete</a>
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