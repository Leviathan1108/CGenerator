<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Certificate - Stepper</title>
  <link rel="stylesheet" href="{{ asset('bootstrap/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="{{ asset('bootstrap/js/stepper.js') }}"></script>
  
 
</head>

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

<body class="bg-gray-100">
  <input type="hidden" id="currentStep" value="1" />


  <main class="max-w-6xl mx-auto mt-8 bg-white rounded-xl shadow-md p-8">
    <h1 class="text-3xl font-bold mb-1">Create New Certificate</h1>
    <p class="text-sm text-gray-600 mb-6">Follow the steps below to create and publish your certificate</p>

    <!-- Stepper -->
    <div class="flex justify-between text-center text-xs font-semibold text-gray-600 mb-8">
      <div class="flex-1 stepper-item border-b-4 pb-1">1<br><span>Type Background</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">2<br><span>Pilih template atau upload file</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">3<br><span>Input Data</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">4<br><span>Generate</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">5<br><span>Review</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">6<br><span>Request Approval</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">7<br><span>Publish</span></div>
    </div>

<form id="certificateForm" class="space-y-8">
    <!-- Step 1: Pilih Background -->
    <section id="step-1" class="transition-all duration-500 ease-in-out space-y-4">
      <h2 class="text-xl font-semibold mb-4">Pilih Background</h2>
      <input type="hidden" name="background_choice" id="background_choice">
      <div class="grid grid-cols-2 gap-6">
          <!-- Kiri: Upload Background Sendiri -->
          <div id="custom-bg-card" class="cursor-pointer border rounded p-4 hover:shadow-md" onclick="chooseBackground('custom')">
  <h3 class="text-lg font-bold mb-2">Background Sendiri</h3> 
  <p class="text-sm text-gray-600">Upload background dari komputermu</p>
</div>

<!-- Gunakan Template -->
<div id="template-card" class="cursor-pointer border rounded p-4 hover:shadow-md" onclick="chooseBackground('template')">
  <h3 class="text-lg font-bold mb-2">Gunakan Template</h3>
  <p class="text-sm text-gray-600">Pilih dari template yang tersedia</p>
</div>
  </section>
  

<!-- Step 2: Pilih atau Upload Background -->
<section id="step-2" class="hidden transition-all duration-500 ease-in-out space-y-4">
  <div id="template-selection" class="space-y-4 hidden">
    <h2 class="text-xl font-semibold mb-4">Pilih Template</h2>
    <input type="hidden" name="selected_template_id" id="selected_template_id">

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
      @foreach ($templates as $template)
      <div class="border rounded-lg overflow-hidden shadow hover:shadow-lg cursor-pointer" onclick="selectTemplate({{ $template->id }})">
        <img src="{{ asset('storage/' . $template->file_path) }}" alt="Template {{ $template->id }}" class="w-full h-40 object-cover">
      </div>
      @endforeach
    </div>
  </div>

  <div id="custom-upload" class="space-y-4 hidden">
    <h2 class="text-xl font-semibold">Upload Background</h2>
    <input type="file" name="custom_background" accept="image/*" id="customBg" class="block w-full border border-gray-300 rounded p-2">
    <button type="button" onclick="validateCustomUpload()" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Lanjut</button>
  </div>
</section>


  

  

    <!-- STEP 3 -->
    <section id="step-3" class="hidden mt-6">
      <h2 class="text-xl font-semibold mb-4">Isi Data Sertifikat</h2>
    
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- KIRI: Preview Background -->
        <div class="w-full border rounded shadow-sm p-4 bg-gray-100 flex items-center justify-center">
          <img id="background-preview-step4" src="#" alt="Preview Background" class="max-w-full max-h-[300px] object-contain">
        </div>
    
        <!-- KANAN: Form Data Sertifikat -->
        <div class="space-y-4">
          <div>
            <label for="event_name" class="block font-medium">Nama Acara</label>
            <input type="text" name="event_name" id="input-acara" class="w-full border p-2 rounded" />          </div>
    
          <div>
            <label for="participant_name" class="block font-medium">Nama Peserta</label>
            <input type="text" name="participant_name" id="input-nama" class="w-full border p-2 rounded" />
          </div>
    
          <div>
            <label for="status" class="block font-medium">Status</label>
            <select name="status" id="status" class="w-full border p-2 rounded">
              <option value="draft">Draft</option>
              <option value="published">Published</option>
              <option value="revoked">Revoked</option>
            </select>
          </div>
    
          <label class="block font-semibold text-gray-700 mb-1">Upload Logo</label>
          <input type="file" id="logo-upload" name="logo" class="w-full mb-4">
          <div>
            <p class="text-sm font-semibold mb-2 text-gray-700">Preview Logo:</p>
            <div id="logo-preview" class="w-32 h-32 bg-gray-100 border border-gray-300 rounded-lg flex items-center justify-center overflow-hidden">
              <span class="text-gray-400 text-sm">Belum ada logo</span>
            </div>
          </div>
    
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Sertifikat</button>
        </div>
      </div>
    </section>
      
    <!-- STEP 4 -->
    <section id="step-4" class="hidden">
      <p class="text-lg font-semibold mb-4">Generate Sertifikat</p>
      <button type="button" onclick="generateSertifikat()" class="bg-[#232E66] text-white px-4 py-2 rounded">Generate Now</button>
    </section>

    <!-- STEP 5 -->
    <section id="step-5" class="hidden">
      <p class="text-lg font-semibold mb-4">Review Semua Data</p>
      <div class="p-4 bg-gray-100 rounded">[Tampilkan data ringkasan di sini]</div>
    </section>

    <!-- STEP 6 -->
    <section id="step-6" class="hidden">
      <p class="text-lg font-semibold mb-4">Request Approval</p>
      <button class="bg-yellow-500 text-white px-4 py-2 rounded">Kirim Permintaan</button>
    </section>

    <!-- STEP 7 -->
    <section id="step-7" class="hidden">
      <p class="text-lg font-semibold mb-4">Publish Sertifikat</p>
      <button class="bg-green-600 text-white px-6 py-2 rounded">Publish Sekarang</button>
    </section>

    <!-- NAVIGATION -->
    <div class="mt-8 flex justify-between">
      <button type="button" onclick="prevStep()" class="px-6 py-2 bg-gray-300 text-gray-700 rounded">Back</button>
      <button type="button" onclick="nextStep()" class="px-6 py-2 bg-[#232E66] text-white rounded">Next</button>
    </div>
  </main>
</body>
</html>