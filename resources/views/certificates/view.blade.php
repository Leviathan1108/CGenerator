@extends ('layout.v_layout')

@section('content')
    <div class="mt-0" style="background-color: rgb(219, 217, 217);">
        <nav class="nav my-3" style="background-color: #232E66;">
            <h1 class="text-light ms-2 fw-bold">Certificate History</h1>
        </nav>

        <!-- date range filter -->
        <div class="bg-light p-1 border border-dark rounded-3 ms-3 me-2">
            <div class="row g-3 align-items-center">
                <div class="col-auto fw-bold">Date Range :</div>

                <div class="col-auto border border-dark rounded-3">
                    <input type="date" name="date" id="date-certificate">
                </div>
                <div class="col-auto">
                    <h5 class="mb-1">to</h5>
                </div>

                <div class="col-auto border border-dark rounded-3">
                    <input type="date" name="date" id="certificate-range">
                </div>

                <div class="col-auto">
                    <button class="btn rounded-4 text-light" style="background-color: #232E66;">Filter</button>
                </div>

                <div class="col-auto">
                    <button class="btn btn-light border border-dark rounded-4 ">Export</button>
                </div>
            </div>
        </div>

        <!-- card untuk certificate -->
        <div class="row text-start my-4 px-2 fw-bold">
            <div class="col-md-4 mb-3">
                <div class="card-custom py-4 rounded-4 ps-2" style="background-color: #4BA3E2;">Total Certificate<br>
                    <span class="fs-1" style="color: #232E66;">542</span><br><span class="fs-6">Last 90 days</span>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card-custom py-4 rounded-4 ps-2" style="background-color: #9CEFAB;">Active Certificate<br>
                    <span class="fs-1" style="color: #232E66;">524</span><br><span class="fs-6">96.7% of total</span>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card-custom py-4 rounded-4 ps-2" style="background-color: #F9CB87;">Verivications<br>
                    <span class="fs-1" style="color: #232E66;">1,247</span><br><span class="fs-6">Last 90 days</span>
                </div>
            </div>
        </div>

        <!-- navbar untuk th -->
        <div class="table-responsive px-2">
            <nav class="rows fs-4 fw-bold">
                <ul class="list-unstyled d-flex justify-between" style="background-color: #1E3265;">
                    <li class="nav-item ms-2 me-1">
                        <a class="text-decoration-none text-light" href="#">Certificate ID</a>
                    </li>
                    <li class="nav-item ms-4 me-4">
                        <a class="text-decoration-none text-light" href="#">Certificate Name</a>
                    </li>
                    <li class="nav-item ms-4 me-4">
                        <a class="text-decoration-none text-light" href="#">Issue Date</a>
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
                        <td>CERT-2025-03-7842 </td>
                        <td>Training Completion</td>
                        <td>12/03/2025</td>
                        <td><span class="status-active bg-success text-light"
                                style="border-radius: 15px; padding: 2px 10px;">Active</span></td>
                        <td>
                            <button type="button" class="btn btn-light">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td>CERT-2025-03-7842</td>
                        <td>Webinar Attendance</td>
                        <td>10/03/2025</td>
                        <td><span class="status-active bg-success text-light"
                                style="border-radius: 15px; padding: 2px 10px;">Active</span></td>
                        <td>
                            <button type="button" class="btn btn-light">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td>CERT-2025-03-7842 </td>
                        <td>Achievement Award</td>
                        <td>26/02/2025</td>
                        <td><span class="status-inactive bg-danger text-light"
                                style="border-radius: 15px; padding: 2px 10px;">Inactive</span></td>
                        <td>
                            <button type="button" class="btn btn-light">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td>CERT-2025-03-7842</td>
                        <td>Workshop Participation</td>
                        <td>15/01/2025</td>
                        <td><span class="status-active bg-success text-light"
                                style="border-radius: 15px; padding: 2px 10px;">Active</span></td>
                        <td>
                            <button type="button" class="btn btn-light">View</button>
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