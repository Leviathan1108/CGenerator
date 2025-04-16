@extends('layout.nc') {{-- Atau ganti sesuai layout kamu --}}

@section('content')
<input type="hidden" id="currentStep" value="1"/>

<header class="bg-[#232E66] text-white p-4 flex justify-between items-center">
  <div class="text-xl font-bold">Certificate <span class="text-[#FBB041]">Generator</span></div>
  <div class="flex items-center space-x-4">
    <input type="text" placeholder="Search" class="rounded p-1 text-black" />
    <button class="bg-white text-[#232E66] px-4 py-1 rounded">Log in</button>
  </div>
</header>

<main class="max-w-6xl mx-auto mt-8 bg-white rounded-xl shadow-md p-8">
  <h1 class="text-3xl font-bold mb-1">Create New Certificate</h1>
  <p class="text-sm text-gray-600 mb-6">Follow the steps below to create and publish your certificate</p>

  <!-- Stepper -->
  <div class="flex justify-between text-center text-xs font-semibold text-gray-600 mb-8">
    @for ($i = 1; $i <= 9; $i++)
      <div class="flex-1 stepper-item border-b-4 pb-1">{{ $i }}<br><span>
        @switch($i)
          @case(1) Select Background @break
          @case(2) Upload/Select @break
          @case(3) Preview @break
          @case(4) Input Data @break
          @case(5) Upload Logo @break
          @case(6) Generate @break
          @case(7) Review @break
          @case(8) Request Approval @break
          @case(9) Publish @break
        @endswitch
      </span></div>
    @endfor
  </div>

  <!-- STEP 1 -->
  <section id="step-1" class="grid grid-cols-1 md:grid-cols-2 gap-6 hidden">
    <div class="bg-[#FBB041] p-6 rounded-xl text-center cursor-pointer">
      <p class="font-bold text-white mb-4">Background Sendiri</p>
      <div class="h-32 bg-gray-300 rounded-lg"></div>
    </div>
    <div class="bg-[#FBB041] p-6 rounded-xl text-center cursor-pointer">
      <p class="font-bold text-white mb-4">Gunakan Template</p>
      <div class="h-32 bg-gray-300 rounded-lg"></div>
    </div>
  </section>

  <!-- STEP 2 -->
  <section id="step-2" class="grid grid-cols-2 md:grid-cols-4 gap-6 hidden">
    @for ($i = 1; $i <= 4; $i++)
      <div class="bg-[#FBB041] p-4 rounded-xl text-center">
        <div class="h-32 bg-white mb-2 rounded-lg border"></div>
        <p class="font-semibold text-gray-800">Template {{ $i }}</p>
      </div>
    @endfor
  </section>

  <!-- STEP 3 -->
  <section id="step-3" class="hidden">
    <p class="text-lg font-semibold mb-4">Preview Sertifikat</p>
    <div class="w-full h-64 bg-gray-200 rounded-lg"></div>
  </section>

  <!-- STEP 4 -->
  <section id="step-4" class="hidden">
    <p class="text-lg font-semibold mb-4">Input Data Peserta</p>
    <input type="text" id="input-nama" placeholder="Nama Peserta" class="w-full border p-2 rounded mb-4" />
    <input type="text" id="input-acara" placeholder="Acara" class="w-full border p-2 rounded mb-4" />
  </section>

  <!-- STEP 5 -->
  <section id="step-5" class="hidden">
    <p class="text-lg font-semibold mb-4">Upload Logo Organisasi</p>

    <label for="logo-upload" class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl h-52 cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
      <svg class="w-12 h-12 text-[#232E66] mb-2" fill="none" stroke="currentColor" stroke-width="2"
           viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1M4 12l4-4m0 0l4 4m-4-4v12"/>
      </svg>
      <p class="text-sm text-gray-600">Klik untuk unggah atau tarik file ke sini</p>
      <p class="text-xs text-gray-500 mt-1">Format: PNG, JPG, SVG. Max: 2MB</p>
      <input type="file" id="logo-upload" accept="image/*" class="hidden">
    </label>

    <div class="mt-4">
      <p class="text-sm font-semibold mb-2 text-gray-700">Preview Logo:</p>
      <div id="logo-preview" class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
        Belum ada logo
      </div>
    </div>
  </section>

  <!-- STEP 6 -->
  <section id="step-6" class="hidden">
    <p class="text-lg font-semibold mb-4">Generate Sertifikat</p>
    <button class="bg-[#232E66] text-white px-4 py-2 rounded">Generate Now</button>
  </section>

  <!-- STEP 7 -->
  <section id="step-7" class="hidden">
    <p class="text-lg font-semibold mb-4">Review Semua Data</p>
    <div class="p-4 bg-gray-100 rounded">
      <p><strong>Nama:</strong> <span id="review-nama"></span></p>
      <p><strong>Acara:</strong> <span id="review-acara"></span></p>
    </div>
  </section>

  <!-- STEP 8 -->
  <section id="step-8" class="hidden">
    <p class="text-lg font-semibold mb-4">Request Approval</p>
    <button class="bg-yellow-500 text-white px-4 py-2 rounded">Kirim Permintaan</button>
  </section>

  <!-- STEP 9 -->
  <section id="step-9" class="hidden">
    <p class="text-lg font-semibold mb-4">Publish Sertifikat</p>
    <form method="POST" action="{{ route('certificates.store') }}">
      @csrf
      <input type="hidden" name="nama" id="final-nama">
      <input type="hidden" name="acara" id="final-acara">
      <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Publish Sekarang</button>
    </form>
  </section>

  <!-- NAVIGATION -->
  <div class="mt-8 flex justify-between">
    <button onclick="prevStep()" class="px-6 py-2 bg-gray-300 text-gray-700 rounded">Back</button>
    <button onclick="nextStep()" class="px-6 py-2 bg-[#232E66] text-white rounded">Next</button>
  </div>
</main>

<script>
  function showStep(step) {
    const steps = document.querySelectorAll('[id^="step-"]');
    steps.forEach(el => el.classList.add('hidden'));
    document.getElementById(`step-${step}`).classList.remove('hidden');

    const stepItems = document.querySelectorAll('.stepper-item');
    stepItems.forEach((item, index) => {
      item.classList.remove('text-blue-600', 'border-blue-600');
      if (index + 1 === step) {
        item.classList.add('text-blue-600', 'border-blue-600');
      }
    });

    // Update review step
    if (step === 7) {
      document.getElementById('review-nama').textContent = document.getElementById('input-nama').value;
      document.getElementById('review-acara').textContent = document.getElementById('input-acara').value;
    }

    // Update hidden fields for submit
    if (step === 9) {
      document.getElementById('final-nama').value = document.getElementById('input-nama').value;
      document.getElementById('final-acara').value = document.getElementById('input-acara').value;
    }
  }

  function nextStep() {
    const current = parseInt(document.getElementById('currentStep').value);
    const next = Math.min(current + 1, 9);
    document.getElementById('currentStep').value = next;
    showStep(next);
  }

  function prevStep() {
    const current = parseInt(document.getElementById('currentStep').value);
    const prev = Math.max(current - 1, 1);
    document.getElementById('currentStep').value = prev;
    showStep(prev);
  }

  document.addEventListener('DOMContentLoaded', () => {
    showStep(1);

    // Logo preview
    document.getElementById('logo-upload').addEventListener('change', function (e) {
      const preview = document.getElementById('logo-preview');
      const file = e.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
          preview.innerHTML = `<img src="${event.target.result}" alt="Preview" class="w-full h-full object-contain rounded-lg"/>`;
        };
        reader.readAsDataURL(file);
      } else {
        preview.innerHTML = "Belum ada logo";
      }
    });
  });
</script>
@endsection
