<!DOCTYPE html>
<html>
<head>
    <title>Upload Background</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/upload.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <style>
        .dropzone {
            width: 100%;
            padding: 60px;
            border: 2px dashed #aaa;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
        }
        .dropzone.hover {
            background-color: #f0f8ff;
        }
    </style>
</head>
<body>
<header> 
<!-- Header from your previous navbar layout -->
<div class="navbar">
  <div class="navbar-left">
    <div class="logo" href="/">Certificate Generator</div>
  </div>
  <div class="navbar-center">
    <div class="search-box">
      <input type="text" placeholder="Search here ..." />
    </div>
  </div>
  <div class="navbar-right">
    <button class="login-btn">Login</button>
  </div>
</div>
</header>
<main>
<div class="container py-4">
  <!-- Title -->
  <h1 class="fw-bold">Create New Certificate</h1>
  <p class="fw-semibold">Follow the steps below to create and publish your certificate</p>

  <!-- Step Labels -->
  <div class="d-flex justify-content-between fw-medium small mb-2 flex-wrap step-labels">
    <span class="text-center" style="width: 12.5%;">1 Select Background</span>
    <span class="text-center" style="width: 12.5%;">2 Preview</span>
    <span class="text-center" style="width: 12.5%;">3 Input Data</span>
    <span class="text-center" style="width: 12.5%;">4 Upload Logo</span>
    <span class="text-center" style="width: 12.5%;">5 Generate</span>
    <span class="text-center" style="width: 12.5%;">6 Review</span>
    <span class="text-center" style="width: 12.5%;">7 Request Approval</span>
    <span class="text-center" style="width: 12.5%;">8 Publish</span>
  </div>

  <!-- Progress Bar -->
  <div class="progress mb-4" style="height: 8px; border-radius: 10px;">
    <div id="progressBar" class="progress-bar bg-primary" role="progressbar"
         style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
    </div>
  </div>
    <h2>Upload Certificate Background</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form id="uploadForm" action="{{ route('background.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="dropzone" class="dropzone">
            Drag & Drop or Click to Upload Background
            <input type="file" name="background" id="fileInput" style="display: none;">
        </div>
        <br>
        <button type="submit">Upload</button>
    </form>

    <script>
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');

        dropzone.addEventListener('click', () => fileInput.click());

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('hover');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('hover');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('hover');
            fileInput.files = e.dataTransfer.files;
        });
    </script>
    <script>
  function updateProgress(step) {
    const progress = document.getElementById('progressBar');
    const percent = ((step - 1) / 7) * 100; // 8 langkah = 7 step progress
    progress.style.width = percent + '%';
    progress.setAttribute('aria-valuenow', percent);
  }

  // Contoh: posisi di step 5
  updateProgress(5);
</script>
</body>
</html>