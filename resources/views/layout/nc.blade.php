
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Generate Certificate</title>
  <link rel="stylesheet" href="{{ asset('bootstrap/css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .progress {
      height: 8px;
      border-radius: 10px;
      overflow: hidden;
    }
    .step-labels span {
      width: 12.5%;
    }
    .certificate-preview {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      margin-bottom: 2rem;
    }
    canvas {
      border: 1px solid #ccc;
      max-width: 100%;
    } 
    .canvas-wrapper {
    width: 100%;
    overflow: auto;
    max-height: 90vh;
    background-color: #D9D9D9;
    padding: 20px;
    border-radius: 12px;
  }

  #certificateCanvas {
    display: block;
    margin: 0 auto;
    max-width: 100%;
  }
  </style>
</head>
<body>
<header> 
<!-- Header from your previous navbar layout -->
<div class="navbar">
  <div class="navbar-left">
    <div class="logo">Certificate Generator</div>
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

  <!-- Canvas Area (with gray block background) -->
    <div class="canvas-wrapper p-4 mb-4 rounded" style="background-color: #D9D9D9;">
      <div class="canvas-wrapper">
        <h2>Generate Certificate</h2>
          <div class="canvas-container-wrapper">
            <canvas id="certificateCanvas"></canvas>
          </div>
        </div>
        <button onclick="addText()">Tambah Teks</button>
    </div>
      

  <!-- Generate Button -->
  <form method="POST" action="{{ route('templates.update', $template->id) }}">
    @csrf @method('PUT')
    <input type="hidden" id="layout_storage" name="layout_storage">
    <button type="submit" onclick="saveLayout()">Simpan Desain</button>
</form>
</div>
</main>
<script>
  window.templateData = {
    image: "{{ asset('storage/' . $template->template_data) }}",
    layout: {!! json_encode($template->layout_storage ? json_decode($template->layout_storage) : new stdClass()) !!}
  };
</script>
<script src="https://unpkg.com/fabric@5.3.0/dist/fabric.min.js"></script>
<script src="{{ asset('bootstrap/fabric/main.js') }}"></script>
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
