<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Certificate - Stepper</title>
  <script defer>
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

    document.addEventListener('DOMContentLoaded', () => showStep(1));
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <input type="hidden" id="currentStep" value="1"/>

  <header class="bg-[#232E66] text-white p-4 flex justify-between items-center">
    <div class="text-xl font-bold">Certificate <span class="text-[#FBB041]">Generator</span></div>
    <div class="flex items-center space-x-4">
      <input type="text" placeholder="Search" class="rounded p-1 text-black" />
      <button class="bg-white text-[#232E66] px-4 py-1 rounded">Log in</button>
    </div>
  </header>

  <main class="max-w-6xl mx-auto mt-8 bg-white rounded-xl shadow-md p-8">
    @yield('content')    <h1 class="text-3xl font-bold mb-1">Create New Certificate</h1>
    <p class="text-sm text-gray-600 mb-6">Follow the steps below to create and publish your certificate</p>

    <!-- Stepper -->
    <div class="flex justify-between text-center text-xs font-semibold text-gray-600 mb-8">
      <div class="flex-1 stepper-item border-b-4 pb-1">1<br><span>Select Background</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">2<br><span>Upload/Select</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">3<br><span>Preview</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">4<br><span>Input Data</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">5<br><span>Upload Logo</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">6<br><span>Generate</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">7<br><span>Review</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">8<br><span>Request Approval</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">9<br><span>Publish</span></div>
    </div>

<!-- STEP 1 -->
<section id="step-1" class="">
  <div class="space-y-4">
    <label class="block font-semibold text-gray-700 mb-1">Pilihan Background</label>
    <select name="background_choice" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
      <option value="custom">Custom</option>
      <option value="template">Template</option>
    </select>
    <input type="hidden" id="background_choice" name="background_choice" value="">
  </div>
</section>

<!-- STEP 2 -->
<section id="step-2" class="hidden">
  <label class="block font-semibold text-gray-700 mb-1">Pilih Template</label>
  <select name="selected_template_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
    <option value="">-- Pilih Template --</option>
    @foreach ($templates as $template)
      <option value="{{ $template->id }}">{{ $template->name }}</option>
    @endforeach
  </select>
</section>

<!-- STEP 3 -->
<section id="step-3" class="hidden">
  <p class="text-lg font-semibold mb-4">Preview Sertifikat</p>
  <div class="w-full h-64 bg-gray-200 rounded-lg"></div>
</section>

<!-- STEP 4 -->
<section id="step-4" class="hidden">
  <div class="space-y-4">
    <label class="block font-semibold text-gray-700 mb-1">Nama Event</label>
    <input type="text" id="input-acara" name="event_name" class="w-full border-gray-300 rounded-lg shadow-sm" required>

    <label class="block font-semibold text-gray-700 mb-1">Nama Peserta</label>
    <input type="text" id="input-nama" name="participant_name" class="w-full border-gray-300 rounded-lg shadow-sm" required>

    <label class="block font-semibold text-gray-700 mb-1">Status Sertifikat</label>
    <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm" required>
      <option value="draft">Draft</option>
      <option value="published">Published</option>
      <option value="revoked">Revoked</option>
    </select>
  </div>
</section>

<!-- STEP 5 -->
<section id="step-5" class="hidden">
  <label class="block font-semibold text-gray-700 mb-1">Upload Logo</label>
  <input type="file" id="logo-upload" name="logo" class="w-full">
  <div class="mt-4">
    <p class="text-sm font-semibold mb-2 text-gray-700">Preview Logo:</p>
    <div id="logo-preview" class="w-32 h-32 bg-gray-100 border border-gray-300 rounded-lg flex items-center justify-center overflow-hidden shadow-inner">
      <span class="text-gray-400 text-sm">Belum ada logo</span>
    </div>    
  </div>
</section>

<!-- STEP 6 -->
<section id="step-6" class="hidden">
  <p class="text-lg font-semibold mb-4">Generate Sertifikat</p>
  <button type="button" onclick="generateSertifikat()" class="bg-[#232E66] text-white px-4 py-2 rounded">Generate Now</button>
</section>

<!-- STEP 7 -->
<section id="step-7" class="hidden">
  <p class="text-lg font-semibold mb-4">Review Semua Data</p>
  <div class="p-4 bg-gray-100 rounded">[Tampilkan data ringkasan di sini]</div>
</section>

<!-- STEP 8 -->
<section id="step-8" class="hidden">
  <p class="text-lg font-semibold mb-4">Request Approval</p>
  <button class="bg-yellow-500 text-white px-4 py-2 rounded">Kirim Permintaan</button>
</section>

<!-- STEP 9 -->
<section id="step-9" class="hidden">
  <p class="text-lg font-semibold mb-4">Publish Sertifikat</p>
  <button class="bg-green-600 text-white px-6 py-2 rounded">Publish Sekarang</button>
</section>

<!-- NAVIGATION -->
<div class="mt-8 flex justify-between">
  <button type="button" onclick="prevStep()" class="px-6 py-2 bg-gray-300 text-gray-700 rounded">Back</button>
  <button type="button" onclick="nextStep()" class="px-6 py-2 bg-[#232E66] text-white rounded">Next</button>
</div>
  </main>
  <script>
  async function generateSertifikat() { 
  const nama = document.getElementById('input-nama').value;
  const acara = document.getElementById('input-acara').value;
  const logoFile = document.getElementById('logo-upload').files[0];
  const backgroundChoice = 'template'; // atau 'custom' sesuai pilihan

  const formData = new FormData();
  formData.append('participant_name', nama); // 👈 ini ditambah di sini
  formData.append('event_name', acara);
  formData.append('background_choice', backgroundChoice);
  formData.append('logo', logoFile);
  formData.append('selected_template_id', 1); // contoh: ID template yang dipilih
  formData.append('status', 'draft');

  try {
    const res = await fetch('/admin/certificates/store', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    });

    const data = await res.json();
    if (data.success) {
      alert('Berhasil disimpan');
      showStep(7); // lanjut ke step review
    } else {
      alert('Gagal simpan');
    }
  } catch (err) {
    console.error(err);
    alert('Error saat simpan sertifikat');
  }
      // Preview logo ketika di-upload
    const logoInput = document.getElementById('logo-upload');
    const logoPreview = document.getElementById('logo-preview');

    logoInput.addEventListener('change', function (e) {
      const file = e.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
          logoPreview.innerHTML = `<img src="${event.target.result}" alt="Preview Logo"
            class="object-contain w-full h-full rounded-lg" />`;
        };
        reader.readAsDataURL(file);
      } else {
        logoPreview.innerHTML = `<span class="text-gray-400 text-sm">Belum ada logo</span>`;
      }
    });

}

  document.addEventListener('DOMContentLoaded', () => {
    showStep(1); // sudah ada

    const chooseCustom = document.getElementById('choose-custom');
    const chooseTemplate = document.getElementById('choose-template');

    chooseCustom.addEventListener('click', () => {
      document.getElementById('background_choice').value = 'custom';
      chooseCustom.classList.add('ring-4', 'ring-blue-500');
      chooseTemplate.classList.remove('ring-4', 'ring-blue-500');
    });

    chooseTemplate.addEventListener('click', () => {
      document.getElementById('background_choice').value = 'template';
      chooseTemplate.classList.add('ring-4', 'ring-blue-500');
      chooseCustom.classList.remove('ring-4', 'ring-blue-500');
    });
  });
</script>  
</body>
</html>