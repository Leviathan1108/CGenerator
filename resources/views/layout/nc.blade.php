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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <h1 class="text-3xl font-bold mb-1">Create New Certificate</h1>
    <p class="text-sm text-gray-600 mb-6">Follow the steps below to create and publish your certificate</p>

    <form id="certificateForm" class="space-y-8">
      <!-- desain lama -->
      <!-- Step 1: Pilih Background -->
      <!-- <section id="step-1" class="transition-all duration-500 ease-in-out space-y-4">
        <h2 class="text-xl font-semibold mb-4">Pilih Background</h2>
        <input type="hidden" name="background_choice" id="background_choice">
        <div class="grid grid-cols-2 gap-6"> -->
      <!-- Kiri: Upload Background Sendiri -->
      <!-- <div id="custom-bg-card" class="cursor-pointer border rounded p-4 hover:shadow-md"
            onclick="chooseBackground('custom')">
            <h3 class="text-lg font-bold mb-2">Background Sendiri</h3>
            <p class="text-sm text-gray-600">Upload background dari komputermu</p>
          </div> -->

      <!-- Gunakan Template -->
      <!-- <div id="template-card" class="cursor-pointer border rounded p-4 hover:shadow-md"
            onclick="chooseBackground('template')">
            <h3 class="text-lg font-bold mb-2">Gunakan Template</h3>
            <p class="text-sm text-gray-600">Pilih dari template yang tersedia</p>
          </div>
      </section> -->

      <!-- Step 1: Pilih Background -->
      <section id="step-1" class="transition-all duration-500 ease-in-out space-y-4">
        <div class="container bg-gray-300">
          <h2 class="text-xl font-semibold mb-4">Pilih Background</h2>
          <input type="hidden" name="background_choice" id="background_choice">
          <div class="grid grid-cols-2 gap-6">
            <!-- Kiri: Upload Background Sendiri -->
            <a href="/templateadmin/upload">
              <div class="row-md-6">
                <div id="custom-bg-card"
                  class="cursor-pointer border rounded p-4 hover:shadow-md bg-warning text-white rounded text-center h-100">
                  <h3 class="text-lg fw-bold mb-2">Background Sendiri</h3>
                  <div class="text-sm text-gray-600 bg-light mt-3 rounded" style="height: 150px;">
                    <p>Upload background dari komputermu</p>
                    <i class="bi bi-upload d-flex justify-center align-items-end py-4" style="font-size: 64px;"></i>
                  </div>
                </div>
              </div>
            </a>
            <!-- Gunakan Template -->
            <a href="/templateadmin/template">
              <div class="row-md-6">
                <div id="template-card"
                  class="cursor-pointer border rounded p-4 hover:shadow-md bg-warning text-white rounded text-center h-100">
                  <h3 class="text-lg fw-bold mb-2">Gunakan Template</h3>
                  <div class="text-sm text-gray-600 bg-light mt-3 rounded" style="height: 150px;">
                    <p>Pilih dari template yang tersedia</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </section>

      <!-- NAVIGATION -->
      <div class="mt-8 flex justify-center gap-4">
        <button type="button" onclick="prevStep()"
          class="px-6 py-2 border border-primary text-[#1533B5] rounded">Back</button>
        <button type="button" onclick="nextStep()" class="px-6 py-2 bg-[#1533B5] text-white rounded">Next</button>
      </div>

  </main>
  <script src="{{ asset('bootstrap/js/stepper.js') }}"></script>
  <script src="{{ asset('bootstrap/js/main.js') }}"></script>
  <script src="{{ asset('bootstrap/fabric/fabric.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="{{ asset('bootstrap/fabric/main.js') }}"></script>

</html>