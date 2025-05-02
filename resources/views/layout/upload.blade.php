<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Certificate - Stepper</title>
  <link rel="stylesheet" href="{{ asset('bootstrap/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
  <input type="hidden" id="currentStep" value="1" />

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
        <div class="progress-bar bg-primary" style="width: 20%;"></div>
      </div>
    </div>

    <div class="mb-4">
      <h4 class="fw-bold">Upload Background</h4>
      <form id="uploadForm" enctype="multipart/form-data" method="POST"
        action="{{ route('templateadmin.upload.store') }}">
        {{ csrf_field() }}
        <div id="dropzone" class="border border-2 border-primary-subtle rounded bg-light text-center py-5 px-3"
          style="cursor: pointer;">
          <input type="file" name="background" id="fileInput" class="d-none" accept=".jpg,.jpeg,.png,.svg" />
          <i class="bi bi-upload display-4 text-primary"></i>
          <p class="fw-semibold">Drag and drop your image here or</p>
          <button type="button" class="btn btn-primary" onclick="document.getElementById('fileInput').click()">Browse
            Files</button>
          <p class="text-muted mt-2">Support for JPG, PNG, SVG (Max. 5MB)</p>
          <p id="fileName" class="mt-2 fw-medium text-success"></p>
        </div>

        <div class="mt-3 d-flex justify-content-center gap-4">
          <a href="http://127.0.0.1:8000/templateadmin" class="btn btn-outline-danger mx-3">← Kembali</a>
          <a href="templateadmin/data-input"><button type="submit"
              class="px-6 py-2 bg-[#1533B5] text-white rounded mx-3 border">Next</button></a>
        </div>
      </form>
    </div>
  </main>

  <script>
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileName');
    const form = document.getElementById('uploadForm');

    window.addEventListener('dragover', e => e.preventDefault());
    window.addEventListener('drop', e => e.preventDefault());

    dropzone.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropzone.classList.add('border-primary');
    });

    dropzone.addEventListener('dragleave', () => {
      dropzone.classList.remove('border-primary');
    });

    dropzone.addEventListener('drop', (e) => {
      e.preventDefault();
      dropzone.classList.remove('border-primary');
      const file = e.dataTransfer.files[0];
      if (file) {
        fileInput.files = e.dataTransfer.files;
        fileNameDisplay.textContent = file.name;
        form.submit();
      }
    });

    fileInput.addEventListener('change', () => {
      if (fileInput.files.length > 0) {
        fileNameDisplay.textContent = fileInput.files[0].name;
        form.submit();
      }
    });
  </script>
</body>

</html>