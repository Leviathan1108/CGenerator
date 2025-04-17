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