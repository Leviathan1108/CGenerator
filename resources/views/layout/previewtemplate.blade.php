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
    <canvas id="myCanvas" width="1060" height="710" style="border: 1px solid #ccc;"></canvas>
</div><div class="row g-2 mb-3">
  <div class="col">
    <button id="downloadPdf" class="btn btn-maxy-primary w-100">
      <i class="bi bi-download"></i> PDF
    </button>
  </div>
  <div class="col">
    <button id="downloadAllZip" class="btn btn-maxy-success w-100">
      <i class="bi bi-archive"></i> ZIP
    </button>
  </div>
  <div class="col">
    <button id="sendEmail" class="btn btn-maxy-warning w-100">
      <i class="bi bi-envelope-fill"></i> Email
    </button>
  </div>
  <div class="col">
    <button id="sendEmailAll" class="btn btn-maxy-primary w-100">
      <i class="bi bi-send-fill"></i> Kirim Semua
    </button>
  </div>
</div>
<div class="row mt-4">
  <div class="col-12">
    <a href="http://127.0.0.1:8000/templateadmin/template" class="btn btn-maxy-blue w-100">
      <i class="bi bi-arrow-left"></i> Back
    </a>
  </div>
</div>



<style>
  .btn-maxy-primary {
    background-color: #232E66;
    color: white;
    border: none;
  }
  .btn-maxy-success {
    background-color: #00B894;
    color: white;
    border: none;
  }
  .btn-maxy-warning {
    background-color: #FBB041;
    color: #333;
    border: none;
  }
  .btn-maxy-primary:hover {
    background-color: #093b66;
  }
  .btn-maxy-success:hover {
    background-color: #009e7d;
  }
  .btn-maxy-warning:hover {
    background-color: #FBB041;
  }
  .btn-maxy-blue {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 999px; /* pill shape */
  }
  .btn-maxy-blue:hover {
    background-color: #0069d9;
  }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="{{ asset('bootstrap/fabric/fabric.min.js') }}"></script>
<script>
// step-5.js - Final Preview Sertifikat dengan UID Dinamis
const canvas = new fabric.Canvas('myCanvas', {
  width: 950,
  height: 700,
  selection: false,
  preserveObjectStacking: true
});

const templateId = "{{ $certificate->selected_template_id }}";
const bgUrl = "{{ asset('storage/' . $certificate->template->file_path) }}";

loadLayoutFromServer(templateId, bgUrl);

function getObjectById(id) {
  return canvas.getObjects().find(obj => obj.customId === id);
}

function loadLayoutFromServer(templateId, bgUrl) {
  fetch(`/certificate/layout?template_id=${templateId}`)
    .then(res => res.json())
    .then(data => {
      if (data && !data.error) {
        canvas.clear();
        loadBackground(bgUrl, () => {
          canvas.loadFromJSON(data.layout, () => {
            canvas.renderAll();
            console.log("✅ Layout berhasil dimuat.");
          });
        });
      } else {
        console.warn("⚠️ Layout tidak ditemukan.");
      }
    })
    .catch(err => console.error("❌ Gagal memuat layout:", err));
}

function loadBackground(url, callback) {
  fabric.Image.fromURL(url, function (img) {
    img.set({
      scaleX: canvas.width / img.width,
      scaleY: canvas.height / img.height,
      left: 0,
      top: 0,
      selectable: false,
      evented: false
    });
    canvas.setBackgroundImage(img, () => {
      canvas.renderAll();
      if (callback) callback();
    });
  });
}

// Update Nama + UID saat ganti kontak
const contactSelect = document.getElementById('contactSelect');
contactSelect?.addEventListener('change', function () {
  const selected = this.options[this.selectedIndex];
  const [name, email] = this.value.split('|');
  const uid = selected.getAttribute('data-uid') || 'UID';

  const nameText = getObjectById('recipient');
  const uidText = getObjectById('uid');

  if (nameText) nameText.text = name;
  if (uidText) uidText.text = uid;

  canvas.renderAll();
});

// Download semua sertifikat sebagai ZIP
const zipBtn = document.getElementById('downloadAllZip');
zipBtn?.addEventListener('click', async function () {
  const zip = new JSZip();
  const options = contactSelect.options;

  for (let i = 0; i < options.length; i++) {
    const option = options[i];
    const [name, email] = option.value.split('|');
    const uid = option.getAttribute('data-uid') || 'UID';

    const nameText = getObjectById('recipient');
    const uidText = getObjectById('uid');
    if (nameText) nameText.text = name;
    if (uidText) uidText.text = uid;
    canvas.renderAll();

    await new Promise(resolve => setTimeout(resolve, 300));

    const canvasEl = document.getElementById('myCanvas');
    const canvasImage = await html2canvas(canvasEl);
    const imageData = canvasImage.toDataURL("image/png");

    const binary = atob(imageData.split(',')[1]);
    const array = [];
    for (let j = 0; j < binary.length; j++) {
      array.push(binary.charCodeAt(j));
    }

    const fileName = `${name.trim().replace(/\s+/g, '_')}_${uid}.png`;
    zip.file(fileName, new Uint8Array(array));
  }

  zip.generateAsync({ type: "blob" }).then(function (content) {
    saveAs(content, "all_certificates.zip");
  });
});

// Download PDF satuan
const pdfBtn = document.getElementById('downloadPdf');
pdfBtn?.addEventListener('click', function () {
  const canvasElement = document.getElementById('myCanvas');
  html2canvas(canvasElement).then(function (canvasEl) {
    const imgData = canvasEl.toDataURL('image/png');
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a4' });
    pdf.addImage(imgData, 'PNG', 0, 0, 297, 210);

    const name = getObjectById('recipient')?.text || 'certificate';
    const uid = getObjectById('uid')?.text || 'UID';
    const filename = `${name.trim().replace(/\s+/g, '_')}_${uid}.pdf`;
    pdf.save(filename);
  });
});

// Kirim email satuan
const emailBtn = document.getElementById('sendEmail');
emailBtn?.addEventListener('click', async function () {
  const selected = contactSelect.options[contactSelect.selectedIndex];
  const [name, email] = selected.value.split('|');
  const uid = selected.getAttribute('data-uid') || 'UID';

  const nameText = getObjectById('recipient');
  const uidText = getObjectById('uid');
  if (nameText) nameText.text = name;
  if (uidText) uidText.text = uid;
  canvas.renderAll();

  await new Promise(resolve => setTimeout(resolve, 100));

  const canvasEl = document.getElementById('myCanvas');
  const canvasImage = await html2canvas(canvasEl);
  const imageData = canvasImage.toDataURL("image/png");

  fetch("/send-certificate-email", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ name, email, image: imageData, uid })
  })
    .then(res => res.json())
    .then(data => alert(data.message || "Email terkirim!"))
    .catch(err => {
      console.error(err);
      alert("Gagal mengirim email.");
    });
});

// Kirim semua email massal
const emailAllBtn = document.getElementById('sendEmailAll');
emailAllBtn?.addEventListener('click', async function () {
  const options = contactSelect.options;
  const token = document.querySelector('meta[name="csrf-token"]').content;
  const participants = [];

  for (let i = 0; i < options.length; i++) {
    const option = options[i];
    const [name, email] = option.value.split('|');
    const uid = option.getAttribute('data-uid') || 'UID';

    const nameText = getObjectById('recipient');
    const uidText = getObjectById('uid');
    if (nameText) nameText.text = name;
    if (uidText) uidText.text = uid;
    canvas.renderAll();

    await new Promise(resolve => setTimeout(resolve, 300));

    const canvasEl = document.getElementById('myCanvas');
    const canvasImage = await html2canvas(canvasEl);
    const imageData = canvasImage.toDataURL("image/png");

    participants.push({ name, email, image: imageData, uid });
  }

  fetch('/certificates/send-bulk', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': token
    },
    body: JSON.stringify({ participants })
  })
    .then(res => res.json())
    .then(data => alert(data.message || 'Sukses mengirim semua email!'))
    .catch(err => {
      console.error(err);
      alert('Gagal mengirim email.');
    });
});

  </script>
  
</main>
</body>
</html>
