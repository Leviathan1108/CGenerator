<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Certificate - Step 2</title>
  <link rel="stylesheet" href="{{ asset('bootstrap/css/upload.css') }}">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<header>
  <!-- Header from your previous navbar layout -->
  <div class="navbar">
    <div class="navbar-left">
      <h1 class="ms-2 me-5 text-light fw-bold text-[40px]">
        <span>Certificate</span>
        <br>
        <span>Generator</span>
      </h1>
    </div>
    <div class="navbar-center">
      <div class="search-box">
        <input type="text" placeholder="Search here ..." />
      </div>
    </div>
    <!-- Tombol profil -->
    <button
      class="btn btn-light bg-light border shadow-none rounded-circle p-0 d-flex align-items-center justify-content-center me-2"
      data-bs-toggle="dropdown" aria-expanded="false" style="height: 60px; width: 60px; overflow: hidden;">
      @if(Auth::check() && Auth::user()->photo_profile)
      <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile"
      class="rounded-circle w-100 h-100 rounded-circle" style="object-fit: cover; display: block;">
    @else
      <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
      style="height: 50px; width: 50px;">👤</div>
    @endif
    </button>

    <!-- Dropdown Content -->
    <ul class="dropdown-menu dropdown-menu-end shadow p-3" style="min-width: 250px; background-color: #FBB041;">
      <!-- Bagian atas: foto profil besar dan username -->
      <li class="text-center">
        <div class="d-flex flex-column align-items-center">
          <!-- unutuk menampilkan foto profile -->
          @if(Auth::check() && Auth::user()->photo_profile)
        <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile" class="rounded-circle"
        style="height: 50px; width: 50px; object-fit: cover;">
      @else
        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
        style="height: 50px; width: 50px;">👤</div>
      @endif
          <strong class="text-light"> {{ Auth::check() ? Auth::user()->username : 'Guest' }} </strong>
          <a href="#" class="text-decoration-none text-white small">View Profile</a>
        </div>
      </li>

      <li>
        <hr class="dropdown-divider border-white">
      </li>

      <!-- Bagian bawah: ikon-only menu (dari kamu) -->
      <li class="text-center">
        <a class="dropdown-item" href="/home" title="Settings">
          <i class="bi bi-house-fill text-dark fs-6"> {{ __('Home') }}</i>
        </a>
      </li>
    </ul>
  </div>
</header>

<body class="bg-gray-100">
  <main class="max-w-6xl mx-auto mt-8 bg-white rounded-xl shadow-md p-8">
    <h2 class="fw-bold mb-2">Create New Certificate</h2>
    <p class="text-muted">Follow the steps below to create and publish your certificate</p>

    <div class="mb-4">
      <div class="d-flex justify-content-between text-primary fw-semibold">
        <div>1 Select Background</div>
        <div>2 Input Data</div>
        <div>3 Preview</div>
        <div>4 Request Approval</div>
        <div>5 Publish</div>
      </div>
      <div class="progress" style="height: 5px;">
        <div class="progress-bar bg-primary" style="width: 40%;"></div>
      </div>
    </div>

    <div class="row align-items-start g-4 mt-1" style="background-color: #D9D9D9;">
      <!-- Kolom Kiri: Preview -->
      <div class="col-md-7">
        <h5 class="fw-bold">Input Data</h5>
        <div class="preview-box position-relative">
          <div class="yellow-box h-auto w-auto">
            <img src="{{ session('background') }}" alt="Preview" id="preview-img" />
            <!-- Tombol Zoom -->
            <div class="zoom-controls">
              <button type="button" onclick="zoomImage(1.1)">+</button>
              <button type="button" onclick="zoomImage(0.9)">−</button>
            </div>
          </div>
          <div class="text-center text-muted small mt-2">
            {{ basename(session('background')) }}
          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Form -->
      <div class="col-md-5">
        <form action="{{ route('templateadmin.storeData') }}" method="POST">
          {{ csrf_field() }}

          <div class="mb-4">
            <label for="name" class="form-label">Certificate Name</label>
            <input type="text" class="form-control" id="name" name="name" required />
          </div>

          <div class="mb-4">
            <label for="title" class="form-label">Certificate Title</label>
            <input type="text" class="form-control" id="title" name="title" required />
          </div>

          <div class="mb-4">
            <label for="date" class="form-label">Issue Date</label>
            <input type="date" class="form-control" id="date" name="date" required />
          </div>

          <div class="mb-4">
            <label for="recipient" class="form-label">Recipient Name</label>
            <input type="text" class="form-control" id="recipient" name="recipient" required />
          </div>

          <div class="mb-4">
            <label for="UploadLogo" class="from-label">Upload Logo(Opsional)</label>
            <input type="file" class="form-control bg-light" name="logo" id="logo" required />
          </div>
      </div>
    </div>



    <div class="mt-3 d-flex justify-content-center gap-4">
      <a href="{{ route('templateadmin.upload') }}" class="px-6 py-2 border border-primary text-[#1533B5] rounded mx-3 text-decoration-none">Back</a>
      <a href="{{ route('templateadmin.contacts') }}" class="px-6 py-2 bg-[#1533B5] text-white rounded mx-3 border text-decoration-none">Next</a>
    </div>
    </form>
  </main>
  <script>
    let scale = 1;

    function zoomImage(factor) {
      scale *= factor;
      const img = document.getElementById("preview-img");
      img.style.transform = `scale(${scale})`;
    }
  </script>
  <script>
    const TEMPLATE_ID = {{ $template->id }};
  </script>
  <script src="{{ asset('bootstrap/js/') }}"></script>
</body>

</html>