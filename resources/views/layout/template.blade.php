<!DOCTYPE html>
<html>
<head>
  <title>Pilih Template</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/style.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />  
  <style>
    .hidden { display: none; }
    .card {
  transition: all 0.3s ease-in-out;
}

.selected-template {
  border: 2px solid #0d6efd;
  box-shadow: 0 0 15px rgba(13, 110, 253, 0.7);
  transform: scale(1.03);
  transition: all 0.3s ease-in-out;
}
    .cursor-pointer { cursor: pointer; }
    .preview-img { max-width: 100%; max-height: 300px; object-fit: contain; }
    #cert-preview-image {
    transition: all 0.3s ease-in-out;
  }

  #preview-participant-name,
  #preview-event-name {
    text-shadow: 1px 1px 2px #fff;
  }

  .resizable-text:hover .resize-handle {
  display: block;
}

.resize-handle {
  width: 10px;
  height: 10px;
  background-color: #0d6efd;
  position: absolute;
  bottom: 0;
  right: 0;
  cursor: se-resize;
  border-radius: 3px;
  display: none; /* disembunyikan secara default */
}

.draggable-text {
  cursor: move;
}

#template-info {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

#template-info h3 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

#template-info p {
    font-size: 1.1em;
}

.card.cursor-pointer:hover {
  transform: scale(1.05);
  box-shadow: 0 0 15px rgba(13, 110, 253, 0.3);
  transition: all 0.3s ease;
}
  </style>
</head>

<body class="bg-gray-100">
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
  <input type="hidden" id="currentStep" value="1" />
  <main class="max-w-6xl mx-auto mt-8 bg-white rounded-xl shadow-md p-8">
    <h1 class="text-3xl font-bold mb-1">Create New Certificate</h1>
    <p class="text-sm text-gray-600 mb-6">Follow the steps below to create and publish your certificate</p>

  <!-- Step Progress Label -->
  <div class="d-flex justify-content-between small fw-medium mb-2">
    <span style="width: 12.5%;">1 Pilih Template</span>
    <span style="width: 12.5%;">2 Preview</span>
    <span style="width: 12.5%;">3 Input Data</span>
    <span style="width: 12.5%;">4 Input Data Massal</span>
    <!-- Tambah step lagi? Tambah span di sini -->
  </div>

  <!-- Progress Bar -->
  <div class="progress mb-4" style="height: 8px; border-radius: 10px;">
    <div id="progressBar" class="progress-bar bg-primary" role="progressbar"
         style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
    </div>
  </div>

  <!-- STEP 1 -->
  <section id="step-1">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="h5 fw-bold mb-0">Pilih Template</h2>
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-3">
      @foreach ($templates as $template)
        <div class="col">
          <div id="template-{{ $template->id }}"
            class="card cursor-pointer"
            data-id="{{ $template->id }}"
            data-name="{{ $template->name }}"
            data-creator="{{ $template->user->name ?? 'Tidak Diketahui' }}"
            data-date="{{ $template->created_at->format('d-m-Y') }}"
            data-img="{{ asset('storage/' . $template->file_path) }}"
            onclick="selectTemplateFromData(this)">
           <img src="{{ asset('storage/' . $template->file_path) }}"
                class="card-img-top preview-img"
                style="height: 150px; object-fit: cover;"
                alt="Template {{ $template->id }}">
       </div>       
        </div>
      @endforeach
    </div>
  </section>
  
<!-- STEP 2 -->
<section id="step-2" class="hidden">
  <h2 class="h5 fw-bold mb-3">Preview Template</h2>
  <div class="d-flex gap-4 align-items-start flex-wrap">
    <!-- Gambar di kiri -->
    <div class="border rounded p-4 bg-light text-center" style="flex: 1;">
      <img id="preview-image" src="#" alt="Preview Template" class="preview-img mx-auto img-fluid" style="max-height: 500px;">
    </div>

    <!-- Info template di kanan -->
    <div id="template-info" style="flex: 1;">
      <h3>Template Info</h3>
      <p><strong>Nama Template:</strong> <span id="template-name">-</span></p>
      <p><strong>Created By:</strong> <span id="template-creator">-</span></p>
      <p><strong>Tanggal Pembuatan:</strong> <span id="template-date">-</span></p>          </div>
  </div>
</section>

<!-- STEP 3: Input Data Sertifikat -->
<section id="step-3" class="hidden mt-4">
  <h2 class="h5 fw-bold mb-4">Isi Data Sertifikat</h2>
  <div class="row align-items-start">
    
    <!-- KIRI: PREVIEW -->
    <div class="col-md-7 mb-3">
      <div class="position-relative border p-4 bg-light rounded text-center">
        <h5 class="text-muted mb-3">Preview Sertifikat</h5>
        <div class="position-relative" style="width: 100%; max-height: 400px; overflow: hidden;">
          <img id="cert-preview-image" src="#" class="img-fluid border rounded shadow-sm w-100" style="object-fit: contain;">
          
          <!-- Logo Preview -->
          <img id="preview-logo" src="#" 
     style="position: absolute; top: 10px; left: 10px; max-height: 70px; max-width: 70px; display: none; cursor: move;" 
     onmousedown="dragElement(event)">

<div id="preview-participant-name" class="draggable-text resizable-text" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: black; font-weight: bold; font-size: 24px; text-shadow: 1px 1px 2px #fff;">
  <span class="text-content">Nama Peserta</span>
  <div class="resize-handle"></div>
</div>

<div id="preview-event-name" class="draggable-text resizable-text" style="position: absolute; bottom: 30%; left: 50%; transform: translateX(-50%); color: black; font-size: 30px; text-shadow: 1px 1px 2px #fff;">
  <span class="text-content">Nama Acara</span>
  <div class="resize-handle"></div>
</div>
        </div>
      </div>
    </div>

    <!-- KANAN: FORM -->
    <div class="col-md-5">
      <div class="mb-3">
        <label class="form-label">Nama Acara</label>
        <input type="text" class="form-control" name="event_name" oninput="updatePreview()">
      </div>
      <div class="mb-3">
        <label class="form-label">Nama Peserta</label>
        <input type="text" class="form-control" name="participant_name" oninput="updatePreview()">
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select class="form-control" name="status">
          <option value="draft">Draft</option>
          <option value="published">Published</option>
          <option value="revoked">Revoked</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Upload Logo</label>
        <input type="file" class="form-control" onchange="previewLogo(event)">
      </div>

      <button type="button" onclick="saveCertificateData()" class="btn btn-primary w-100">Simpan Sertifikat</button>
    </div>
  </div>
</section>

<section id="step-4" class="hidden mt-4">
  <h2 class="h5 fw-bold mb-4">Input Data Sertifikat Massal</h2>
  <p>Upload file Excel (.xlsx) atau tambahkan data peserta secara manual.</p>

  <!-- Upload Excel -->
  <div class="mb-3">
    <label for="excelUpload" class="form-label">Upload Excel File</label>
    <input type="file" class="form-control" id="excelUpload" accept=".xlsx,.xls,.csv">
  </div>

  <div class="text-center">
    <p>ATAU</p>
  </div>

  <!-- Manual Table -->
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama Peserta</th>
        <th>Email</th>
        <th>Status</th>
        <th>Acara</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="participantTable">
      <tr>
        <td><input type="text" class="form-control" name="nama[]"></td>
        <td><input type="email" class="form-control" name="email[]"></td>
        <td>
          <select class="form-control" name="status[]">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
          </select>
        </td>
        <td><input type="text" class="form-control" name="acara[]"></td>
        <td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">🗑️</button></td>
      </tr>
    </tbody>
  </table>
  <button class="btn btn-outline-primary" onclick="addRow()">+ Tambah Baris</button>
</section>

  <!-- Tombol Navigasi -->
  <div class="step-buttons d-flex justify-content-center mt-4">
    <button id="back-btn" class="btn btn-secondary mx-3" onclick="changeStep(-1)">Back</button>
    <button id="next-btn" class="btn btn-primary mx-3" onclick="changeStep(1)">Next</button>
  </div>    
</main>

<script>
  let currentStep = 1;
  const totalSteps = document.querySelectorAll("section[id^='step-']").length;

  function showStep(step) {
  document.querySelectorAll("section[id^='step-']").forEach(section => section.classList.add("hidden"));
  const current = document.getElementById(`step-${step}`);
  if (current) current.classList.remove("hidden");

  // Jika step 3, update cert-preview-image
  if (step === 3 && selectedTemplateImage) {
    const certPreview = document.getElementById("cert-preview-image");
    certPreview.src = selectedTemplateImage;
  }

  // Progress bar
  const progress = Math.round(((step - 1) / (totalSteps - 1)) * 100);
  const progressBar = document.getElementById("progressBar");
  progressBar.style.width = progress + "%";
  progressBar.setAttribute("aria-valuenow", progress);

  document.getElementById("back-btn").style.display = "inline-block";
  document.getElementById("next-btn").innerText = step === totalSteps ? "Finish" : "Next";
}

function changeStep(direction) {
  const current = document.getElementById("currentStep");
  let step = parseInt(current.value);

  // Kalau user klik "Back" di step 1
  if (step === 1 && direction === -1) {
    window.location.href = "http://127.0.0.1:8000/templateadmin";
    return;
  }

  const nextStep = step + direction;

  if (nextStep >= 1 && nextStep <= totalSteps) {
    current.value = nextStep;
    showStep(nextStep);
  }
}

  let selectedTemplateId = null;
  let selectedTemplateImage = null;

  function selectTemplateFromData(card) {
    // Hapus selected dari semua template
    document.querySelectorAll('.card').forEach(c => c.classList.remove('selected-template'));

    // Tambah efek ke template yang dipilih
    card.classList.add('selected-template');

    // Ambil data
    selectedTemplateId = card.dataset.id;
    selectedTemplateImage = card.dataset.img;

    // Tampilkan info template di step 2
    document.getElementById("template-name").textContent = card.dataset.name;
    document.getElementById("template-creator").textContent = card.dataset.creator;
    document.getElementById("template-date").textContent = card.dataset.date;
    document.getElementById("preview-image").src = selectedTemplateImage;
  }

  function previewLogo(event) {
    const preview = document.getElementById("logo-preview-container");
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = e => {
        preview.innerHTML = `<img src="${e.target.result}" class="img-fluid" style="max-height: 100%;">`;
      };
      reader.readAsDataURL(file);
    }
  }

  document.addEventListener("DOMContentLoaded", () => showStep(currentStep));

  function updatePreview() {
  const name = document.querySelector('input[name="participant_name"]').value || "Nama Peserta";
  const event = document.querySelector('input[name="event_name"]').value || "Nama Acara";

  document.getElementById("preview-participant-name").innerHTML = `<span class="text-content">${name}</span><div class="resize-handle"></div>`;
  document.getElementById("preview-event-name").innerHTML = `<span class="text-content">${event}</span><div class="resize-handle"></div>`;

  document.getElementById("preview-participant-name").addEventListener('mousedown', dragText);
  document.getElementById("preview-event-name").addEventListener('mousedown', dragText);

  initResizableText(); // Tambahkan ini
}

function previewLogo(event) {
  const file = event.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function(e) {
    const preview = document.getElementById("preview-logo");
    preview.src = e.target.result;
    preview.style.display = "block";

    // Update logo preview container (optional)
    const logoContainer = document.getElementById("logo-preview-container");
    logoContainer.innerHTML = `<img src="${e.target.result}" style="max-width: 100%; max-height: 100%;">`;
  };
  reader.readAsDataURL(file);
}

// Saat ganti template, tampilkan juga di preview sertifikat step 3
function selectTemplate(id, imgSrc) {
  document.querySelectorAll('[id^="template-"]').forEach(el => el.classList.remove("selected-template"));
  const selected = document.getElementById(`template-${id}`);
  if (selected) selected.classList.add("selected-template");

  const previewImg = document.getElementById("preview-image");
  previewImg.src = imgSrc;

  const certPreviewImg = document.getElementById("cert-preview-image");
  certPreviewImg.src = imgSrc;
}

function dragElement(e) {
  e.preventDefault();
  const logo = document.getElementById("preview-logo");

  let shiftX = e.clientX - logo.getBoundingClientRect().left;
  let shiftY = e.clientY - logo.getBoundingClientRect().top;

  function moveAt(pageX, pageY) {
    const previewContainer = logo.parentElement.getBoundingClientRect();
    const newLeft = pageX - shiftX - previewContainer.left;
    const newTop = pageY - shiftY - previewContainer.top;

    logo.style.left = Math.max(0, Math.min(previewContainer.width - logo.offsetWidth, newLeft)) + 'px';
    logo.style.top = Math.max(0, Math.min(previewContainer.height - logo.offsetHeight, newTop)) + 'px';
  }

  function onMouseMove(event) {
    moveAt(event.pageX, event.pageY);
  }

  document.addEventListener('mousemove', onMouseMove);

  document.onmouseup = function() {
    document.removeEventListener('mousemove', onMouseMove);
    document.onmouseup = null;
  };
}

function dragText(e) {
  // Kalau yang diklik resize handle, jangan drag
  if (e.target.classList.contains('resize-handle')) return;

  e.preventDefault();
  const textElement = e.currentTarget;

  let shiftX = e.clientX - textElement.getBoundingClientRect().left;
  let shiftY = e.clientY - textElement.getBoundingClientRect().top;

  function moveAt(pageX, pageY) {
    const container = textElement.parentElement.getBoundingClientRect();
    const newLeft = pageX - shiftX - container.left;
    const newTop = pageY - shiftY - container.top;

    textElement.style.left = Math.max(0, Math.min(container.width - textElement.offsetWidth, newLeft)) + 'px';
    textElement.style.top = Math.max(0, Math.min(container.height - textElement.offsetHeight, newTop)) + 'px';
  }

  function onMouseMove(event) {
    moveAt(event.pageX, event.pageY);
  }

  document.addEventListener('mousemove', onMouseMove);
  document.onmouseup = function () {
    document.removeEventListener('mousemove', onMouseMove);
    document.onmouseup = null;
  };
}

// Memulai resizeable text saat DOM siap
document.addEventListener("DOMContentLoaded", initResizableText);

function initResizableText() {
  const resizableTexts = document.querySelectorAll('.resizable-text');

  resizableTexts.forEach(el => {
    const handle = el.querySelector('.resize-handle');
    if (!handle) return;

    let isResizing = false;
    let startY, startFontSize;

    handle.addEventListener('mousedown', function (e) {
      e.preventDefault();
      e.stopPropagation(); // Biar nggak ke-trigger dragText juga

      isResizing = true;
      startY = e.clientY;
      startFontSize = parseFloat(window.getComputedStyle(el).fontSize);

      document.addEventListener('mousemove', resizeText);
      document.addEventListener('mouseup', stopResize);
    });

    function resizeText(e) {
      if (!isResizing) return;

      const dy = e.clientY - startY;
      const newFontSize = Math.max(8, startFontSize + dy * 0.2); // skala 0.2 biar halus
      el.style.fontSize = newFontSize + 'px';
    }

    function stopResize() {
      isResizing = false;
      document.removeEventListener('mousemove', resizeText);
      document.removeEventListener('mouseup', stopResize);
    }
  });
}

document.querySelectorAll('.draggable-text').forEach(element => {
  element.addEventListener('mousedown', dragText);
});

function addRow() {
    const table = document.getElementById('participantTable');
    const row = document.createElement('tr');
    row.innerHTML = `
      <td><input type="text" class="form-control" name="nama[]"></td>
      <td><input type="email" class="form-control" name="email[]"></td>
      <td>
        <select class="form-control" name="status[]">
          <option value="draft">Draft</option>
          <option value="published">Published</option>
        </select>
      </td>
      <td><input type="text" class="form-control" name="acara[]"></td>
      <td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">🗑️</button></td>
    `;
    table.appendChild(row);
  }

  function removeRow(button) {
    button.closest('tr').remove();
  }
 
  function saveCertificateData() {
    const eventName = document.querySelector('[name="event_name"]').value;
    const participantName = document.querySelector('[name="participant_name"]').value;
    const status = document.querySelector('[name="status"]').value;
    const logoFile = document.querySelector('[type="file"]').files[0];
    const templateId = document.querySelector('.selected-template')?.dataset.id;

    if (!templateId) {
      alert("Pilih template terlebih dahulu.");
      return;
    }

    const formData = new FormData();
    formData.append('event_name', eventName);
    formData.append('participant_name', participantName);
    formData.append('status', status);
    formData.append('template_id', templateId);
    if (logoFile) {
      formData.append('logo', logoFile);
    }

    fetch('/certificates/store', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      alert('Sertifikat berhasil disimpan!');
      console.log(data);
      // redirect atau reset form jika perlu
    })
    .catch(error => {
      alert('Terjadi kesalahan saat menyimpan.');
      console.error(error);
    });
  }
</script>
</body>
</html>
