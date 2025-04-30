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
  <div class="navbar">
    <div class="navbar-left">
       <a href="/"><div class="logo" href="/">Certificate Generator</div></a>
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
    
    <div class="row align-items-start g-4">
  <!-- Kolom Kiri: Preview -->
  <div class="col-md-7">
    <h5 class="fw-bold">Input Data</h5>
    <div class="preview-box position-relative">
      <div class="yellow-box">
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
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required />
      </div>

      <div class="mb-4">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required />
      </div>

      <div class="mb-4">
        <label for="recipient" class="form-label">Recipient</label>
        <input type="text" class="form-control" id="recipient" name="recipient" required />
      </div>

      <div class="mb-4">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" required />
      </div>
    </div>

      

      <div class="d-flex justify-content-between mt-4">
      <a href="{{ route('templateadmin.upload') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('templateadmin.contacts') }}" class="btn btn-primary">Next</a>
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
