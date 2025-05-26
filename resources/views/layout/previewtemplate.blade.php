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
        <div>1 Select Template</div>
        <div>2 Information</div>
        <div>3 Input Data</div>
        <div>4 Request Approval</div>
        <div>5 Publish</div>
      </div>
      <div class="progress" style="height: 5px;">
        <div class="progress-bar bg-primary" style="width: 100%;"></div>
      </div>
    </div>


    
<div class="container">
    <h3 class="mb-4">Certificate Preview</h3>

    <div class="mb-4">
        <label for="contactSelect" class="form-label">Select Contact:</label>
        <select id="contactSelect" class="form-select">
            @foreach ($contacts as $contact)
                <option value="{{ $contact->name }}|{{ $contact->email }}">
                    {{ $contact->name }} ({{ $contact->email }})
                </option>
            @endforeach
        </select>
    </div>
    <canvas id="myCanvas" width="1000" height="700" style="border: 1px solid #ccc;"></canvas>
</div>
<div class="mt-3">
    <button id="downloadPdf" class="btn btn-primary">
      <i class="bi bi-download"></i> Download PDF
    </button>

    <button id="downloadAllZip" class="btn btn-success">
      <i class="bi bi-archive"></i> Download All as ZIP
    </button>  
    
    <button id="sendEmail" class="btn btn-warning">
      <i class="bi bi-envelope-fill"></i> Send to Email
    </button>    

    <a href="http://127.0.0.1:8000/templateadmin/template" class="btn btn-outline-secondary mb-3">
      <i class="bi bi-arrow-left"></i> Back
    </a>
  </div>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="{{ asset('bootstrap/fabric/fabric.min.js') }}"></script>
<script>
  document.getElementById('downloadAllZip')?.addEventListener('click', async function () {
    const zip = new JSZip();

    for (let i = 0; i < document.getElementById('contactSelect').options.length; i++) {
        const option = document.getElementById('contactSelect').options[i];
        const [name, email] = option.value.split('|');

        // Update canvas dynamically
        participantNameText.set({ text: name });
        canvas.renderAll();

        // Wait for rendering & export image
        await new Promise(resolve => setTimeout(resolve, 300)); // allow re-render

        const canvasElement = document.getElementById('myCanvas');
        const canvasImage = await html2canvas(canvasElement);
        const imageData = canvasImage.toDataURL("image/png");

        // Convert base64 to binary
        const binary = atob(imageData.split(',')[1]);
        const array = [];
        for (let j = 0; j < binary.length; j++) {
            array.push(binary.charCodeAt(j));
        }

        // Add to ZIP
        const fileName = name.trim().replace(/\s+/g, '_') + "_certificate.png";
        zip.file(fileName, new Uint8Array(array));
    }

    // Generate and Save ZIP
    zip.generateAsync({ type: "blob" }).then(function (content) {
        saveAs(content, "all_certificates.zip");
    });
});

  const canvas = new fabric.Canvas('myCanvas');
  
  // Set Background
  const bgImage = "{{ asset('storage/' . $certificate->template->file_path) }}";
  fabric.Image.fromURL(bgImage, function(img) {
      img.scaleToWidth(canvas.width);
      img.scaleToHeight(canvas.height);
      canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
      img.set({ selectable: false, evented: false });
  });
  
  // Logo
  @if($certificate->logo_path)
  fabric.Image.fromURL('{{ asset("storage/" . $certificate->logo_path) }}', function(img) {
      img.set({
          left: 30,
          top: 30,
          scaleX: 0.12,
          scaleY: 0.12,
          originX: 'left',
          originY: 'top',
      });
      img.scaleToWidth(100);
      canvas.add(img);
  });
  @endif
  
  // Title
  const titleText = new fabric.Text('{{ $certificate->title }}', {
      left: canvas.width / 2,
      top: 80,
      fontSize: 20,
      fontWeight: 'bold',
      fill: 'black',
      originX: 'center'
  });
  canvas.add(titleText);
  
  // Description
  const descriptionText = new fabric.Textbox('{{ $certificate->description }}', {
      left: canvas.width / 2,
      top: 150,
      fontSize: 14,
      fill: 'black',
      originX: 'center',
      width: canvas.width * 0.7,
      textAlign: 'center'
  });
  canvas.add(descriptionText);
  
  // Participant Name
  const participantNameText = new fabric.Text('{{ $certificate->contact->name }}', {
      left: canvas.width / 2,
      top: 250,
      fontSize: 30,
      fontWeight: 'bold',
      fill: 'black',
      originX: 'center'
  });
  canvas.add(participantNameText);
  
  // Role
  const roleText = new fabric.Text('{{ $certificate->role }}', {
      left: canvas.width / 2,
      top: 300,
      fontSize: 16,
      fill: 'black',
      originX: 'center'
  });
  canvas.add(roleText);
  
  // Event Name
  const eventNameText = new fabric.Text('{{ $certificate->event_name }}', {
      left: canvas.width / 2,
      top: 350,
      fontSize: 16,
      fill: 'black',
      originX: 'center'
  });
  canvas.add(eventNameText);
  
  // Tanggal
  const dateText = new fabric.Text('Jakarta, {{ \Carbon\Carbon::parse($certificate->date)->translatedFormat("d F Y") }}', {
      left: canvas.width / 2,
      top: canvas.height - 180,
      fontSize: 14,
      fill: 'black',
      originX: 'center'
  });
  
  canvas.add(dateText);
  @if ($certificate->signature_path)
fabric.Image.fromURL('{{ asset("storage/" . $certificate->signature_path) }}', function(img) {
    img.set({
        left: canvas.width / 2 - 75,
        top: canvas.height - 170,
        scaleX: 0.4,
        scaleY: 0.4,
        originX: 'left',
        originY: 'top',
        selectable: true,          // ✅ Bisa dipilih
    hasControls: true,         // ✅ Muncul titik kontrol resize
    hasBorders: true,        
    });
    img.scaleToWidth(150);
    canvas.add(img);
});
@endif
  
  
  // Signature Name {{ asset("storage/" . $certificate->logo_path) }}
  const signatureNameText = new fabric.Text('{{ $certificate->signature_name }}', {
      left: canvas.width / 2,
      top: canvas.height - 60,
      fontSize: 14,
      fill: 'black',
      originX: 'center'
  });
  canvas.add(signatureNameText);
  
  // Handle Contact Selection Change (Dynamic Update)
  document.getElementById('contactSelect')?.addEventListener('change', function() {
      const [name] = this.value.split('|');
      participantNameText.set({ text: name });
      canvas.renderAll();
  });
  
  // Export to PDF
  document.getElementById('downloadPdf').addEventListener('click', function () {
      const canvasElement = document.getElementById('myCanvas');
      html2canvas(canvasElement).then(function (canvasEl) {
          const imgData = canvasEl.toDataURL('image/png');
          const { jsPDF } = window.jspdf;
          const pdf = new jsPDF({
              orientation: 'landscape',
              unit: 'mm',
              format: 'a4'
          });
          pdf.addImage(imgData, 'PNG', 0, 0, 297, 210);
          const filename = participantNameText.text.trim().replace(/\s+/g, '_') + '_certificate.pdf';
          pdf.save(filename);
      });
  });

  document.getElementById('sendEmail')?.addEventListener('click', async function () {
    const contactValue = document.getElementById('contactSelect').value;
    const [name, email] = contactValue.split('|');

    // Render canvas to image
    const canvasElement = document.getElementById('myCanvas');
    const canvasImage = await html2canvas(canvasElement);
    const imageData = canvasImage.toDataURL("image/png");

    // Kirim ke backend
    fetch("/send-certificate-email", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify({ name, email, image: imageData })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message || "Email sent!");
    })
    .catch(error => {
        console.error("Error sending email:", error);
        alert("Failed to send email.");
    });
});
  
  
  </script>
  
</main>
</body>
</html>
