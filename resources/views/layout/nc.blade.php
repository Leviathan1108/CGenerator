<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Certificate - Stepper</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="{{ asset('js/stepper.js') }}"></script>
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
      if (step === 4) {
        const selectedBackgroundURL = localStorage.getItem('selectedBackground');
if (selectedBackgroundURL) {
  const previewImg = document.getElementById('background-preview-step4');
  if (previewImg) {
    previewImg.src = selectedBackgroundURL;
  }
}
  }  
    }

    function nextStep() {
  const current = parseInt(document.getElementById('currentStep').value);
  const backgroundChoice = document.getElementById('background_choice').value;
  const selectedTemplateId = document.getElementById('selected_template_id').value;

  // Validasi khusus step 2
  if (current === 2 && backgroundChoice === 'template' && !selectedTemplateId) {
    alert('Pilih template terlebih dahulu sebelum lanjut.');
    return;
  }

  // Validasi step 3 (custom background)
  if (current === 3 && backgroundChoice === 'custom') {
    const customBg = localStorage.getItem('selectedBackground');
    if (!customBg) {
      alert('Silakan upload background terlebih dahulu.');
      return;
    }
  }

  const next = Math.min(current + 1, 9);
  document.getElementById('currentStep').value = next;
  showStep(next);
}



    function chooseBackground(choice) {
      document.getElementById('background_choice').value = choice;
      document.getElementById('step-1').classList.add('hidden');

    const nextStep = choice === 'template' ? 2 : 3;
      document.getElementById('currentStep').value = nextStep;
      showStep(nextStep);
    }

    
    function selectTemplate(templateId) {
  document.getElementById('selected_template_id').value = templateId;

  // Simpan URL background ke localStorage
  const templateImg = event.currentTarget.querySelector('img');
  if (templateImg) {
    const imageUrl = templateImg.src;
    localStorage.setItem('selectedBackground', imageUrl);
  }

  document.getElementById('step-2').classList.add('hidden');
  document.getElementById('currentStep').value = 4;
  showStep(4);
}



    function goToStep(stepNumber) {
      document.getElementById('currentStep').value = stepNumber;
      showStep(stepNumber);
    }


    function prevStep() {
  const current = parseInt(document.getElementById('currentStep').value);
  const backgroundChoice = document.getElementById('background_choice').value;

  let prev = current - 1;

  // Logika khusus untuk kembali dari step 4 ke step sebelumnya yang benar
  if (current === 4) {
    prev = backgroundChoice === 'template' ? 2 : 3;
  }

  // Logika untuk kembali dari step 2 atau 3 ke step 1
  if ((current === 2 && backgroundChoice === 'template') ||
      (current === 3 && backgroundChoice === 'custom')) {
    prev = 1;
  }

  document.getElementById('currentStep').value = Math.max(prev, 1);
  showStep(Math.max(prev, 1));
}



    document.addEventListener('DOMContentLoaded', () => {
      showStep(1);

      const chooseCustom = document.getElementById('choose-custom');
      const chooseTemplate = document.getElementById('choose-template');

      if (chooseCustom && chooseTemplate) {
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
      }

      const templateSelect = document.getElementById('template-select');
      if (templateSelect) {
        templateSelect.addEventListener('change', function () {
          const selectedOption = this.options[this.selectedIndex];
          const previewUrl = selectedOption.getAttribute('data-preview');
          const previewImg = document.getElementById('certificate-preview');
          previewImg.src = previewUrl || '';
        });
      }

      const logoInput = document.getElementById('logo-upload');
      const logoPreview = document.getElementById('logo-preview');

      if (logoInput) {
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

      const customBgInput = document.querySelector('input[name="custom_background"]');
if (customBgInput) {
  customBgInput.addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (event) {
        // Simpan base64 background ke localStorage
        localStorage.setItem('selectedBackground', event.target.result);
      };
      reader.readAsDataURL(file);
    }
  });
}
    });

    async function generateSertifikat() {
  const nama = document.getElementById('input-nama').value;
  const acara = document.getElementById('input-acara').value;
  const logoFile = document.getElementById('logo-upload').files[0];
  const selectedTemplateId = document.getElementById('selected_template_id').value;
  const backgroundChoice = document.getElementById('background_choice').value || 'template';

  // ✅ Validasi sebelum submit
  if (backgroundChoice === 'template' && !selectedTemplateId) {
    alert('Kamu memilih menggunakan template, tapi belum memilih template.');
    return;
  }

  if (backgroundChoice === 'custom') {
    const customBg = localStorage.getItem('selectedBackground');
    if (!customBg) {
      alert('Kamu memilih upload background sendiri, tapi belum upload gambar.');
      return;
    }
  }

  const formData = new FormData();
  formData.append('participant_name', nama);
  formData.append('event_name', acara);
  formData.append('background_choice', backgroundChoice);
  formData.append('logo', logoFile);
  formData.append('selected_template_id', selectedTemplateId);
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
      showStep(7);
    } else {
      alert('Gagal simpan');
    }
  } catch (err) {
    console.error(err);
    alert('Error saat simpan sertifikat');
  }
}

  </script>
</head>

<body class="bg-gray-100">
  <input type="hidden" id="currentStep" value="1" />

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
      <div class="flex-1 stepper-item border-b-4 pb-1">1<br><span>Select Background</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">2<br><span>Select Template</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">3<br><span>Upload Background (Custom)</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">4<br><span>Input Data</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">5<br><span>Upload Logo</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">6<br><span>Generate</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">7<br><span>Review</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">8<br><span>Request Approval</span></div>
      <div class="flex-1 stepper-item border-b-4 pb-1">9<br><span>Publish</span></div>
    </div>

<form id="certificateForm" class="space-y-8">
    <!-- Step 1: Pilih Background -->
    <section id="step-1" class="transition-all duration-500 ease-in-out space-y-4">
      <h2 class="text-xl font-semibold mb-4">Pilih Background</h2>
      <input type="hidden" name="background_choice" id="background_choice">
      <div class="grid grid-cols-2 gap-6">
          <!-- Kiri: Upload Background Sendiri -->
          <div onclick="chooseBackground('custom')" class="cursor-pointer border p-4 rounded-lg hover:shadow-lg">
              <h3 class="text-lg font-medium mb-2">Background Sendiri</h3>
              <p class="text-gray-600 text-sm">Upload background dari komputermu</p>
          </div>
  
          <!-- Kanan: Gunakan Template -->
          <div onclick="chooseBackground('template')" class="cursor-pointer border p-4 rounded-lg hover:shadow-lg">
              <h3 class="text-lg font-medium mb-2">Gunakan Template</h3>
              <p class="text-gray-600 text-sm">Pilih dari template yang tersedia</p>
          </div>
      </div>
  </section>
  

    <!-- Step 2: Pilih Template -->
    <section id="step-2" class="transition-all duration-500 ease-in-out space-y-4">
      <h2 class="text-xl font-semibold mb-4">Pilih Template</h2>
      <input type="hidden" name="selected_template_id" id="selected_template_id">
  
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
          @foreach ($templates as $template)
              <div class="border rounded-lg overflow-hidden shadow hover:shadow-lg cursor-pointer" onclick="selectTemplate({{ $template->id }})">
                  <img src="{{ asset('storage/' . $template->file_path) }}" alt="Template {{ $template->id }}" class="w-full h-40 object-cover">
              </div>
          @endforeach
      </div>
  </section>
  
    <!-- STEP 3 -->
    <section id="step-3" class="hidden space-y-4 mt-6">
      <h2 class="text-xl font-semibold">Upload Background</h2>
      <input type="file" name="custom_background" accept="image/*" class="block w-full border border-gray-300 rounded p-2">
      <button type="button" onclick="goToStep(4)" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Lanjut</button>
  </section>
  

    <!-- STEP 4 -->
    <section id="step-4" class="hidden mt-6">
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
    
          <div>
            <label for="logo" class="block font-medium">Upload Logo (Opsional)</label>
            <input type="file" name="logo" id="logo" accept="image/*" class="w-full border p-2 rounded" />
          </div>
    
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Sertifikat</button>
        </div>
      </div>
    </section>
      

    <!-- STEP 5 -->
    <section id="step-5" class="hidden">
      <label class="block font-semibold text-gray-700 mb-1">Upload Logo</label>
      <input type="file" id="logo-upload" name="logo" class="w-full mb-4">
      <div>
        <p class="text-sm font-semibold mb-2 text-gray-700">Preview Logo:</p>
        <div id="logo-preview" class="w-32 h-32 bg-gray-100 border border-gray-300 rounded-lg flex items-center justify-center overflow-hidden">
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
</body>
</html>