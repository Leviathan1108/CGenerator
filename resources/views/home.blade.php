@extends ('layout.v_layout')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-light" style="background-color: #232E66;">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Your Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                            <input type="name" class="form-control" id="exampleFormControlInput1" placeholder="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Add PhotoProfile</label>
                            <input type="file" class="form-control" id="photoInput" name="photo" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save changes</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Discard</button>
                </div>
            </div>
        </div>
    </div>
    <div class="my-3">
        <div class="alert alert-warning text-center">
            You have 5 pending certificates to publish
        </div>

        <div class="row text-center g-4">
            <div class="col">
                <div class="card" style="background-color: #FBB041;">
                    <div class="card-body">
                        <h5 class="card-title">Total Certificates</h5>
                        <h1>84</h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="background-color: #FBB041;">
                    <div class="card-body">
                        <h5 class="card-title">Certificates Sent</h5>
                        <h1>65</h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="background-color: #FBB041;">
                    <div class="card-body">
                        <h5 class="card-title">Templates</h5>
                        <h1>12</h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="background-color: #FBB041;">
                    <div class="card-body">
                        <h5 class="card-title">Verifications</h5>
                        <h1>43</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- input -->
        <div class="input mt-3 flex-row d-flex gap-4 mt-3 justify-content-between">
            <div class="checkbox-container">
                <input type="checkbox" name="verify" id="verify" class="me-2">
                <label for="verify">Verify Certificate</label>
            </div>
            <div class="checkbox-container">
                <input type="checkbox" name="edit" id="edit" class="me-2">
                <label for="edit">Edit Certificate</label>
            </div>
            <div class="checkbox-container">
                <input type="checkbox" name="view" id="view" class="me-2">
                <label for="view">View Certificate</label>
            </div>
            <div class="checkbox-container">
                <input type="checkbox" name="user" id="user" class="me-2">
                <label for="user">User Management</label>
            </div>
        </div>

    </div>
    <div>
        <div class="row flex-row d-flex justify-content-between me-0">
            <div class="recent-certificates border rounded-4 p-4 mx-3 w-50 ms-2 my-4"
                style="background-color: rgb(219, 217, 217); height: 609px;">
                <h2 class="text-white rounded-pill fs-5 d-inline-flex align-items-center justify-content-center px-4 py-2 mb-3"
                    style="background-color: #232E66;">Recent Certificates</h2>
                <ul class="list-unstyled m-0 p-0">
                    <li class="fw-bold rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                        style="background-color: rgb(199, 199, 199);">Training Completion <span
                            class="badge bg-secondary rounded-pill px-3 py-2">Published</span>
                    </li>
                    <label class="text-muted">150 certificates - 12 March 2025</label>
                    <hr>

                    <li class="fw-bold rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                        style="background-color: rgb(199, 199, 199);">Webinar Attendance <span
                            class="badge bg-secondary rounded-pill px-3 py-2">Published</span>
                    </li>
                    <label class="text-muted">150 certificates - 12 March 2025</label>
                    <hr>

                    <li class="fw-bold rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                        style="background-color: rgb(199, 199, 199);">Achievement Awards <span
                            class="badge bg-secondary rounded-pill px-3 py-2">Published</span>
                    </li>
                    <label class="text-muted">150 certificates - 12 March 2025</label>
                    <hr>

                    <li class="fw-bold rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                        style="background-color: rgb(199, 199, 199);">Workshop Participation <span
                            class="badge bg-secondary rounded-pill px-3 py-2">Published</span>
                    </li>
                    <label class="text-muted">150 certificates - 12 March 2025</label>
                </ul>
            </div>

            <div class="popular-templates col-md-5 col-12 border rounded-4 p-4 ms-2 my-4"
                style="background-color: rgb(219, 217, 217); height: 609px;">
                <h2 class="text-white rounded-pill fs-5 d-inline-flex align-items-center justify-content-center px-4 py-2 mb-3"
                    style="background-color: #232E66;">Popular Template</h2>
                <div class="column rounded-3 px-2 py-3 mb-1 d-flex justify-content-between align-items-center">
                    <div class="card w-100" style="max-width: 400px; height: 127px;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h6 class="card-title">Certificate Of Completion</h6>
                            <div class="row">
                                <span class="col text-start">Basic Completion</span>
                                <span class="col text-center">Used 225</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column rounded-3 px-2 py-3 mb-1 d-flex justify-content-between align-items-center">
                    <div class="card w-100" style="max-width:  400px; height: 127px;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h6 class="card-title">Certificate of Achievement</h6>
                            <div class="row">
                                <span class="col text-start">Basic Completion</span>
                                <span class="col text-center">Used 225</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column rounded-3 px-2 py-3 mb-1 d-flex justify-content-between align-items-center">
                    <div class="card w-100" style="max-width:  400px; height: 127px;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h6 class="card-title">Certificate of Achievement</h6>
                            <div class="row">
                                <span class="col text-start">Basic Completion</span>
                                <span class="col text-center">Used 225</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection