@extends ('layout.v_layout')

@section('content')
    <div class="mt-0 flex-grow-0" style="background-color: rgb(219, 217, 217);">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light ms-2 fw-bold">User Management</h1>
        </nav>

        <!-- Filter Section -->
        <div class="bg-light p-1 border border-dark rounded-3 ms-3 me-2">
            <div class="row g-3 align-items-center">
                <div class="col-auto fw-bold">Filter Users</div>

                <div class="col-auto">
                    <select class="form-select">
                        <option>All Roles</option>
                    </select>
                </div>

                <div class="col-auto">
                    <select class="form-select">
                        <option>All Status</option>
                    </select>
                </div>

                <div class="col-auto">
                    <button class="btn text-light rounded-4" style="background-color: #1E3265;">Filter</button>
                </div>
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
                <div class="card-custom py-4 rounded-4 ps-2" style="background-color: #57B2FB;;">Total Users<br><span
                        class="fs-1">217</span></div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card-custom py-4 rounded-4 ps-2" style="background-color: #9CEFAB;">Active Users<br><span
                        class="fs-1">194</span></div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card-custom py-4 rounded-4 ps-2" style="background-color: #EFE2BA;">Admins<br><span
                        class="fs-1">23</span></div>
            </div>
        </div>

        <!-- Tabel Data User -->
        <div class="table-responsive px-2">
            <nav class="rows fs-4 fw-bold">
                <ul class="list-unstyled d-flex justify-between" style="background-color: #1E3265;">
                    <li class="nav-item ms-2 me-1">
                        <a class="text-decoration-none text-light" href="#">User ID</a>
                    </li>
                    <li class="nav-item ms-4 me-4">
                        <a class="text-decoration-none text-light" href="#">Name</a>
                    </li>
                    <li class="nav-item ms-4 me-4">
                        <a class="text-decoration-none text-light" href="#">Role</a>
                    </li>
                    <li class="nav-item ms-4 me-4">
                        <a class="text-decoration-none text-light" href="#">Status</a>
                    </li>
                    <li class="nav-item ms-4 me-4">
                        <a class="text-decoration-none text-light" href="#">Actions</a>
                    </li>
                </ul>
            </nav>
            <table class="table">
                <tbody>
                    <tr>
                        <td>USR-2025-157</td>
                        <td>John Doe</td>
                        <td>Administrator</td>
                        <td><span class="status-active bg-success text-light"
                                style="border-radius: 15px; padding: 2px 10px;">Active</span></td>
                        <td>
                            <button type="button" class="btn btn-primary">Edit</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>USR-2025-156</td>
                        <td>Jane Smith</td>
                        <td>Manager</td>
                        <td><span class="status-active bg-success text-light"
                                style="border-radius: 15px; padding: 2px 10px;">Active</span></td>
                        <td>
                            <button type="button" class="btn btn-primary">Edit</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>USR-2025-155</td>
                        <td>Robert Johnson</td>
                        <td>Staff</td>
                        <td><span class="status-inactive bg-danger text-light"
                                style="border-radius: 15px; padding: 2px 10px;">Inactive</span></td>
                        <td>
                            <button type="button" class="btn btn-primary">Edit</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>USR-2025-154</td>
                        <td>Maria Garcia</td>
                        <td>Manager</td>
                        <td><span class="status-active bg-success text-light"
                                style="border-radius: 15px; padding: 2px 10px;">Active</span></td>
                        <td>
                            <button type="button" class="btn btn-primary">Edit</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
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