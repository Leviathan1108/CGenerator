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
  <div class="mb-4">
    <div class="d-flex justify-content-between text-primary fw-semibold">
      <div>1 Select Template</div>
      <div>2 Information</div>
      <div>3 Input Data</div>
      <div>4 Request Approval</div>
      <div>5 Publish</div>
    </div>
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
            data-description="{{ $template->description ?? 'Tidak ada deskripsi' }}"
            data-type="{{ $template->type ?? 'Umum' }}"        
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
      <p><strong>Tanggal Pembuatan:</strong> <span id="template-date">-</span></p> 
      <p><strong>Deskripsi:</strong> <span id="template-description">-</span></p>
      <p><strong>Tipe Template:</strong> <span id="template-type">-</span></p>
    </div>
  </div>
</section>

<!-- STEP 3: Input Data Sertifikat -->
<section id="step-4" class="hidden mt-4">
  <h2 class="h5 fw-bold mb-4">Isi Data Sertifikat</h2>
  <div class="row align-items-start">
    
    <!-- KIRI: PREVIEW -->
    <div class="col-md-8 mb-3">
      <div class="position-relative border p-4 bg-light rounded text-center">
        <h5 class="text-muted mb-3">Preview Sertifikat</h5>
        <div class="position-relative" style="width: 100%; height: auto; max-height: 600px;">  
          <img id="cert-preview-image" src="#" class="border rounded shadow-sm" 
     style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
          <!-- Logo Preview -->
          <img id="preview-logo" src="#" 
     style="position: absolute; top: 10px; left: 10px; max-height: 70px; max-width: 70px; display: none; cursor: move;" 
     onmousedown="dragElement(event)">

<div id="preview-participant-name" class="draggable-text resizable-text" style="position: absolute; top: 30%; left: 50%; transform: translate(-50%, -50%); color: black; font-weight: bold; font-size: 24px; text-shadow: 1px 1px 2px #fff;">
  <span class="text-content">Nama Peserta</span>
  <div class="resize-handle"></div>
</div>

<div id="preview-event-name" class="draggable-text resizable-text" style="position: absolute; bottom: 40%; left: 50%; transform: translateX(-50%); color: black; font-size: 15px; text-shadow: 1px 1px 2px #fff;">
  <span class="text-content">Breaking Barriers in Achieving Targeted Yield: Driving Success Through Oil Palm Replanting & GAP Adoption</span>
  <div class="resize-handle"></div>
</div>

<!-- Judul Sertifikat -->
<div id="preview-title" class="draggable-text resizable-text"
     style="position: absolute; top: 10%; left: 50%; transform: translateX(-50%); font-size: 18px; font-weight: bold;">
  <span class="text-content">Certificate Of Appreciation</span>
  <div class="resize-handle"></div>
</div>

<!-- Peran Peserta -->
<div id="preview-role" class="draggable-text resizable-text"
     style="position: absolute; top: 33%; left: 50%; transform: translateX(-50%); font-size: 16px;">
  <span class="text-content">For Recognition and appreciation for Contribution as Participants</span>
  <div class="resize-handle"></div>
</div>

<!-- Deskripsi -->
<div id="preview-description" class="draggable-text resizable-text"
     style="position: absolute; top: 23%; left: 50%; transform: translateX(-50%); font-size: 13px; width: 70%; text-align: center;">
  <span class="text-content">This certificate is proudly presented to:</span>
  <div class="resize-handle"></div>
</div>
<!-- Preview Tanda Tangan -->
<img id="preview-signature-img" class="draggable resizable"
     src="" alt="Signature Preview"
     style="position: absolute; bottom: 14%; left: 50%; transform: translateX(-50%); width: 150px; display: none;">

<!-- Nama Penandatangan -->
<div id="preview-signature-name" class="draggable-text resizable-text"
     style="position: absolute; bottom: 10%; left: 50%; transform: translateX(-50%); text-align: center; font-size: 14px;">
  <span class="text-content">Stefen Laksana</span>
  <div class="resize-handle"></div>
</div>     

<!-- Tanggal -->
<div id="preview-date" class="draggable-text resizable-text"
     style="position: absolute; bottom: 33%; left: 50%; transform: translateX(-50%); text-align: center; font-size: 14px;">
  <span class="text-content">Jakarta, 19 Mei 2025</span>
  <div class="resize-handle"></div>
</div>


        </div>
      </div>
    </div>

    
<!-- KANAN: FORM -->
<div class="col-md-3">
  <form id="certificateForm" method="POST" action="{{ route('certificate.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Template ID disimpan sebagai hidden -->
    <input type="hidden" name="selected_template_id" id="selected_template_id">
{{-- Event Name --}}
<div class="form-group mb-3">
  <label for="event_name">Nama Acara</label>
  <input type="text" name="event_name" class="form-control" required>
</div>

{{-- Status --}}
<div class="form-group mb-3">
  <label for="status">Status</label>
  <select name="status" class="form-control" required>
      <option value="draft">Draft</option>
      <option value="published">Published</option>
      <option value="revoked">Revoked</option>
  </select>
</div>

{{-- Logo (Optional) --}}
<div class="form-group mb-3">
  <label for="logo">Upload Logo (opsional)</label>
  <input type="file" name="logo" class="form-control" accept=".jpg,.jpeg,.png,.svg">
</div>

{{-- Recipient --}}
<div class="form-group mb-3">
  <label for="recipient">Nama Penerima</label>
  <input type="text" name="recipient" class="form-control" required>
</div>

{{-- Selected Template --}}
<div class="form-group mb-3">
  <label for="selected_template_id">Template</label>
  <select name="selected_template_id" class="form-control" required>
      @foreach($templates as $template)
          <option value="{{ $template->id }}">{{ $template->name }}</option>
      @endforeach
  </select>
</div> 

<!-- Title -->
<div class="form-group mb-3">
  <label for="title">Judul Sertifikat</label>
  <input type="text" name="title" class="form-control" required>
</div>

<!-- Peran Peserta -->
<div class="form-group mb-3">
  <label for="role">Peran Peserta</label>
  <input type="text" name="role" class="form-control" required>
</div>

{{-- Certificate Type --}}
<div class="form-group mb-3">
  <label for="type" class="form-label">Tipe Sertifikat</label>
  <input list="certificate-types" name="certificate_type" class="form-control" placeholder="Pilih atau ketik tipe sertifikat">
  <datalist id="certificate-types">
    <option value="Attendance Certificate">
    <option value="Completion Certificate">
    <option value="Award Certificate">
    <option value="Competency Certificate">
    <option value="Participation Certificate">
    <option value="Academic Degree Certificate">
    <option value="Training Certificate">
    <option value="Membership Certificate">
    <option value="Recognition Certificate">
    <option value="Certificate of Authenticity">
    <option value="Expertise Certificate">
    <option value="Inspection Certificate">
    <option value="Validation Certificate">
    <option value="Registration Certificate">
    <option value="Compliance Certificate">
  </datalist>
</div>

<!-- Date -->
<div class="form-group mb-3">
  <label for="date">Tanggal</label>
  <input type="date" name="date" class="form-control" required>
</div>

<!-- Description -->
<div class="form-group mb-3">
  <label for="description">Deskripsi</label>
  <textarea name="description" class="form-control" rows="3"></textarea>
</div>

<div class="mb-3">
  <label for="signatureImage" class="form-label">Upload Tanda Tangan</label>
  <input type="file" class="form-control" name="signatureImage" id="signatureImage" accept="image/*">
</div>

<!-- Nama Tanda Tangan -->
<div class="form-group mb-3">
  <label for="signature_name">Nama yang Tanda Tangan</label>
  <input type="text" name="signature_name" class="form-control" required>
</div>


{{-- Submit --}}
<button type="submit" class="btn btn-primary">Simpan Sertifikat</button>
  </form>
</div>
</section>

<section id="step-3" class="hidden mt-4">
  <h2 class="h5 fw-bold mb-4">Input Data Sertifikat Massal</h2>
  <div class="row g-4">
    <div class="col-12">
      <h5 class="fw-bold">Add Recipients</h5>

      <!-- Input nama & email penerima -->
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Enter recipient name..." id="recipient-name">
        <input type="email" class="form-control" placeholder="Enter recipient email..." id="recipient-email">
        <button class="btn btn-primary" type="button" onclick="addRecipient()">Add</button>
      </div>

      <!-- Upload CSV -->
      <div class="mb-3">
        <label for="upload-csv" class="form-label">Upload CSV (Name,Email)</label>
        <input class="form-control" type="file" id="upload-csv">
      </div>

      <!-- List penerima -->
      <table class="table table-bordered">
    <thead>
        <tr>
            <th>Recipient Name</th>
            <th>Recipient Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr id="contact-{{ $contact->id }}">
            <td class="contact-name">{{ $contact->name }}</td>
            <td class="contact-email">{{ $contact->email }}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-1" onclick="editRecipient({{ $contact->id }})">Edit</button>
                <button class="btn btn-sm btn-outline-danger" onclick="removeRecipient({{ $contact->id }})">Remove</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
 </section>
 

  <!-- Tombol Navigasi -->
  <div class="step-buttons d-flex justify-content-center mt-4">
    <button id="back-btn" class="btn btn-secondary mx-3" onclick="changeStep(-1)">Back</button>
    <button id="next-btn" class="btn btn-primary mx-3" onclick="changeStep(1)">Next</button>
  </div>    
</main>

<script>

  // Binding input ke preview text
  document.querySelector('input[name="title"]').addEventListener('input', function () {
    document.querySelector('#preview-title .text-content').textContent = this.value;
  });

  document.querySelector('input[name="role"]').addEventListener('input', function () {
    document.querySelector('#preview-role .text-content').textContent = this.value;
  });

  document.querySelector('input[name="date"]').addEventListener('input', function () {
    document.querySelector('#preview-date .text-content').textContent = this.value;
  });

  document.querySelector('textarea[name="description"]').addEventListener('input', function () {
    document.querySelector('#preview-description .text-content').textContent = this.value;
  });

  document.querySelector('input[name="signature_name"]').addEventListener('input', function () {
    document.querySelector('#preview-signature-name .text-content').textContent = this.value;
  });
  document.getElementById('signatureImage').addEventListener('change', function (event) {
    const signatureImg = document.getElementById('preview-signature-img');
    const file = event.target.files[0];
    
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        signatureImg.src = e.target.result;
        signatureImg.style.display = 'block'; // Tampilkan gambar setelah upload
      };
      reader.readAsDataURL(file);
    } else {
      signatureImg.style.display = 'none';
    }
  });
  
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
    const description = card.dataset.description;
    const type = card.dataset.type;
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
  document.getElementById('template-description').textContent = description;
  document.getElementById('template-type').textContent = type;
  document.getElementById('selected-template-id').value = selectedTemplateId;
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
  document.addEventListener('DOMContentLoaded', function () {
  // Ganti preview nama peserta
  const recipientInput = document.querySelector('input[name="recipient"]');
  const previewName = document.getElementById('preview-participant-name').querySelector('.text-content');
  recipientInput.addEventListener('input', function () {
    previewName.textContent = this.value || 'Nama Peserta';
  });

  // Ganti preview nama acara
  const eventNameInput = document.querySelector('input[name="event_name"]');
  const previewEvent = document.getElementById('preview-event-name').querySelector('.text-content');
  eventNameInput.addEventListener('input', function () {
    previewEvent.textContent = this.value || 'Nama Acara';
  });

  // Preview Logo
  const logoInput = document.querySelector('input[name="logo"]');
  const previewLogo = document.getElementById('preview-logo');
  logoInput.addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        previewLogo.src = e.target.result;
        previewLogo.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });

  // Menampilkan template preview yang dipilih
  const selectedTemplateId = document.getElementById('selected_template_id').value;
  const selectedTemplateCard = document.querySelector(`[data-id="${selectedTemplateId}"]`);
  if (selectedTemplateCard) {
    const imgSrc = selectedTemplateCard.getAttribute('data-img');
    document.getElementById('cert-preview-image').src = imgSrc;
  }
});

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

  function saveCertificateData() {
  const event_name = document.querySelector('input[name="event_name"]').value;
  const participant_name = document.querySelector('input[name="participant_name"]').value;
  const status = document.querySelector('select[name="status"]').value;
  const logoInput = document.querySelector('input[type="file"]');
  const logo = logoInput.files[0];
  const selected_template_id = document.querySelector('select[name="selected_template_id"]').value;

  const formData = new FormData();
  formData.append('event_name', event_name);
  formData.append('participant_name', participant_name);
  formData.append('status', status);
  formData.append('selected_template_id', selected_template_id);

  if (logo) {
    formData.append('logo', logo);
  }

  fetch('/certificate', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Sertifikat berhasil disimpan!');
      window.location.href = '/dashboard'; // Atau arahkan ke preview
    } else {
      alert('Terjadi kesalahan saat menyimpan sertifikat.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Gagal mengirim data.');
  });
}
let recipients = [];
function addRecipient() {
    const nameInput = document.getElementById('recipient-name');
    const emailInput = document.getElementById('recipient-email');
    const name = nameInput.value.trim();
    const email = emailInput.value.trim();

    if (name && email) {
        // Send the data to the server using AJAX
        fetch("{{ route('templateadmin.contacts.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                name: name,
                email: email
            })
        })
        .then(response => response.json())
        .then(data => {
            // Dynamically add the new contact to the table
            const tableBody = document.querySelector('table tbody');
            tableBody.innerHTML += `
                <tr id="contact-${data.id}">
                    <td class="contact-name">${data.name}</td>
                    <td class="contact-email">${data.email}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary me-1" onclick="editRecipient(${data.id})">Edit</button>
                        <button class="btn btn-sm btn-outline-danger" onclick="removeRecipient(${data.id})">Remove</button>
                    </td>
                </tr>
            `;

            // Clear the input fields
            nameInput.value = '';
            emailInput.value = '';
        })
        .catch(error => console.error('Error:', error));
    }
}

function editRecipient(contactId) {
    const row = document.getElementById(`contact-${contactId}`);
    const nameCell = row.querySelector('.contact-name');
    const emailCell = row.querySelector('.contact-email');

    const newName = prompt('Edit recipient name:', nameCell.textContent);
    const newEmail = prompt('Edit recipient email:', emailCell.textContent);

    if (newName && newEmail) {
        fetch(`/templateadmin/contacts/${contactId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                name: newName,
                email: newEmail
            })
        })
        .then(response => response.json())
        .then(data => {
            nameCell.textContent = data.name;
            emailCell.textContent = data.email;
        })
        .catch(error => console.error('Error:', error));
    }
}



function removeRecipient(contactId) {
    fetch(`/templateadmin/contacts/${contactId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (response.ok) {
            // Remove the contact from the table if successful
            const row = document.getElementById(`contact-${contactId}`);
            row.remove();
        } else {
            alert('Error removing contact');
        }
    })
    .catch(error => console.error('Error:', error));
}



function renderRecipients() {
  const list = document.querySelector('table tbody');
  const searchTerm = document.getElementById('searchInput').value.toLowerCase();
  list.innerHTML = ''; // Clear the table

  // Make sure the recipients array has the latest data from the database or AJAX
  recipients
    .filter(r => 
      r.name.toLowerCase().includes(searchTerm) || 
      r.email.toLowerCase().includes(searchTerm)
    )
    .forEach((recipient, index) => {
      list.innerHTML += `
        <tr id="contact-${recipient.id}">
          <td>${recipient.name}</td>
          <td>${recipient.email}</td>
          <td>
            <button class="btn btn-sm btn-outline-primary me-1" onclick="editRecipient(${recipient.id})">Edit</button>
            <button class="btn btn-sm btn-outline-danger" onclick="removeRecipient(${recipient.id})">Remove</button>
          </td>
        </tr>
      `;
    });
}


// Upload CSV
document.getElementById('upload-csv').addEventListener('change', function(e) {
  console.log('File selected:', e.target.files[0]); // DEBUG
  const file = e.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function(e) {
    console.log('File content loaded'); // DEBUG
    const lines = e.target.result.split('\n');
    lines.forEach(line => {
      const [name, email] = line.split(',');
      if (name && email) {
        const trimmedName = name.trim();
        const trimmedEmail = email.trim();

        fetch("{{ route('templateadmin.contacts.store') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            name: trimmedName,
            email: trimmedEmail
          })
        })
        .then(response => response.json())
        .then(data => {
          recipients.push({ id: data.id, name: data.name, email: data.email });
          renderRecipients();
        })
        .catch(error => console.error('Upload CSV error:', error));
      }
    });
  };
  reader.readAsText(file);
});

</script>
</body>
</html>
