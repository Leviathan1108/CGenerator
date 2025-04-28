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
      <form id="uploadForm" enctype="multipart/form-data" method="POST" action="{{ route('templateadmin.upload.store') }}">
        {{ csrf_field() }}
        <div id="dropzone" class="border border-2 border-primary-subtle rounded bg-light text-center py-5 px-3" style="cursor: pointer;">
          <input type="file" name="background" id="fileInput" class="d-none" accept=".jpg,.jpeg,.png,.svg" />
          <i class="bi bi-upload display-4 text-primary"></i>
          <p class="fw-semibold">Drag and drop your image here or</p>
          <button type="button" class="btn btn-primary" onclick="document.getElementById('fileInput').click()">Browse Files</button>
          <p class="text-muted mt-2">Support for JPG, PNG, SVG (Max. 5MB)</p>
          <p id="fileName" class="mt-2 fw-medium text-success"></p>
        </div>

        <div class="mt-3 d-flex justify-content-between">
          <a href="#" class="btn btn-outline-secondary">Back</a>
          <a href="templateadmin/data-input"><button type="submit" class="btn btn-primary">Next</button></a>
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
