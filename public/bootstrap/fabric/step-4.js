// step-4.js - Versi Final Sinkronisasi Otomatis
let canvas;
let backgroundImage = null;
let logoImage = null;
let signatureImage = null;
let templateId = null;

window.addEventListener('DOMContentLoaded', () => {
  canvas = new fabric.Canvas('certificate-canvas', {
    width: 950,
    height: 700,
    selection: false,
    preserveObjectStacking: true
  });

  const imgInput = document.getElementById('selected_template_img');
  const idInput = document.getElementById('selected_template_id');

  if (!imgInput || !imgInput.value || !idInput || !idInput.value) {
    return console.warn("Template tidak ditemukan atau belum dipilih.");
  }

  const path = window.location.origin + "/storage/" + imgInput.value;
  templateId = idInput.value;
  document.getElementById('selected_template_id').value = templateId;

  loadLayoutFromServer(templateId, path);
  bindFormFields();
  syncInitialFormValues();
  bindImageUploadListeners();

  document.getElementById('reset-canvas-btn')?.addEventListener('click', () => initCanvas(path));

  document.getElementById('save-btn')?.addEventListener('click', e => {
    e.preventDefault();
    saveLayoutToServer(templateId, () => document.getElementById('certificateForm').submit());
  });

  document.getElementById('go-to-step-5')?.addEventListener('click', () => {
    saveLayoutToServer(templateId, () => changeStep(5));
  });
});

function initCanvas(certBgUrl) {
  removeHtmlPreviews();
  canvas.clear();
  loadBackground(certBgUrl);

  addText('title', 'Certificate of Appreciation', { top: percentY(12), left: percentX(50), fontSize: 24, fontWeight: 'bold', originX: 'center', textAlign: 'center' });
  addText('description', 'This certificate is proudly presented to:', { top: percentY(20), left: percentX(50), fontSize: 14, originX: 'center', textAlign: 'center' });
  addText('recipient', 'Nama Peserta', { top: percentY(28), left: percentX(50), fontSize: 28, fontWeight: 'bold', originX: 'center' });
  addText('role', 'Sebagai Peserta', { top: percentY(33), left: percentX(50), fontSize: 16, originX: 'center' });
  addText('event', 'Judul Event Panjang', { top: percentY(52), left: percentX(50), fontSize: 16, originX: 'center' });
  addText('date', 'Jakarta, 19 Mei 2025', { top: percentY(58), left: percentX(50), fontSize: 14, originX: 'center' });
  addText('signature_name', 'Nama Penandatangan', { top: percentY(90), left: percentX(50), fontSize: 14, originX: 'center' });

  const uidPlaceholder = new fabric.Textbox('UID_PLACEHOLDER', {
    left: 800, top: 670, fontSize: 12, fill: 'red',
    selectable: false, evented: false, fontStyle: 'italic', customId: 'uid'
  });
  canvas.add(uidPlaceholder);
}

function percentX(p) { return (canvas.width * p) / 100; }
function percentY(p) { return (canvas.height * p) / 100; }

function loadBackground(url) {
  fabric.Image.fromURL(url, function(img) {
    if (!img) return;
    img.set({
      selectable: false,
      evented: false,
      scaleX: canvas.width / img.width,
      scaleY: canvas.height / img.height
    });
    backgroundImage = img;
    canvas.setBackgroundImage(backgroundImage, canvas.renderAll.bind(canvas));
  }, { crossOrigin: 'anonymous' });
}

function addText(id, text, options = {}) {
  const existing = getObjectById(id);
  if (existing) return;

  const textbox = new fabric.Textbox(text, {
    left: options.left || 100,
    top: options.top || 100,
    fontSize: options.fontSize || 24,
    fill: options.fill || 'black',
    fontWeight: options.fontWeight || 'normal',
    textAlign: 'left',
    originX: 'left',
    originY: 'top',
    width: options.width || 400,
    ...options,
    customId: id
  });
  canvas.add(textbox);
}

function getObjectById(id) {
  return canvas.getObjects().find(obj => obj.customId === id);
}

function updateText(id, newText) {
  const obj = getObjectById(id);
  if (obj && obj.type === 'textbox') {
    obj.text = newText;
    canvas.renderAll();
  }
}

function bindFormFields() {
  const map = {
    recipient: 'recipient',
    event_name: 'event',
    title: 'title',
    role: 'role',
    date: 'date',
    description: 'description',
    signature_name: 'signature_name'
  };

  Object.entries(map).forEach(([field, id]) => {
    const el = document.querySelector(`[name="${field}"]`);
    if (el) {
      el.removeEventListener('input', el._listener);
      el._listener = e => updateText(id, field === 'date' ? formatDate(e.target.value) : e.target.value);
      el.addEventListener('input', el._listener);
    }
  });

  const recipientSelect = document.getElementById('recipient-select');
  const recipientInput = document.getElementById('recipient-input');

  if (recipientSelect && recipientInput) {
    recipientSelect.removeEventListener('change', recipientSelect._listener);
    recipientSelect._listener = function (e) {
      recipientInput.value = e.target.value;
      updateText('recipient', e.target.value || 'Nama Peserta');
    };
    recipientSelect.addEventListener('change', recipientSelect._listener);
  }

  if (recipientInput) {
    recipientInput.removeEventListener('input', recipientInput._listener);
    recipientInput._listener = function (e) {
      updateText('recipient', e.target.value || 'Nama Peserta');
    };
    recipientInput.addEventListener('input', recipientInput._listener);
  }
}

function syncInitialFormValues() {
  const map = {
    recipient: 'recipient',
    event_name: 'event',
    title: 'title',
    role: 'role',
    date: 'date',
    description: 'description',
    signature_name: 'signature_name'
  };

  Object.entries(map).forEach(([field, id]) => {
    const el = document.querySelector(`[name="${field}"]`);
    if (el && el.value) {
      const val = field === 'date' ? formatDate(el.value) : el.value;
      updateText(id, val);
    }
  });
}

function bindImageUploadListeners() {
  const logoInput = document.getElementsByName('logo')[0];
  const sigInput = document.getElementById('signatureImage');

  if (logoInput) {
    logoInput.addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file) {
        const url = URL.createObjectURL(file);
        addImage('logo', url, { left: 20, top: 20 });
      }
    });
  }

  if (sigInput) {
    sigInput.addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file) {
        const url = URL.createObjectURL(file);
        addImage('signature', url, { left: 600, top: 600 });
      }
    });
  }
}

function addImage(id, url, options = {}) {
  const existing = getObjectById(id);
  if (existing) canvas.remove(existing);

  fabric.Image.fromURL(url, function(img) {
    if (!img) return;
    const maxSize = 70;
    const scale = Math.min(maxSize / img.width, maxSize / img.height);

    img.set({
      left: options.left ?? 10,
      top: options.top ?? 10,
      scaleX: scale,
      scaleY: scale,
      hasControls: true,
      hasBorders: true,
      originX: 'left',
      originY: 'top',
      customId: id
    });
    canvas.add(img);
  }, { crossOrigin: 'anonymous' });
}

function formatDate(input) {
  const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  const d = new Date(input);
  if (isNaN(d)) return input;
  return `Jakarta, ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
}

function saveLayoutToServer(templateId, callback = null) {
  const layout = canvas.toJSON(['customId']);

  fetch('/certificate/layout', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ template_id: templateId, layout })
  })
  .then(res => res.text())
  .then(text => {
    console.log("Server response raw text:", text);
    try {
      const data = JSON.parse(text);
      console.log("✅ Layout disimpan untuk template", templateId);
      if (callback) callback();
    } catch (err) {
      console.error("❌ Gagal parse JSON layout:", err);
    }
  })
  .catch(err => console.error("❌ Gagal simpan layout:", err));
}

function loadLayoutFromServer(templateId, bgUrl) {
  fetch(`/certificate/layout?template_id=${templateId}`)
    .then(res => res.json())
    .then(response => {
      if (!response || response.error || !response.layout) {
        console.warn("⚠️ Layout belum tersedia, gunakan initCanvas.");
        initCanvas(bgUrl);
        return;
      }

      let layout = response.layout;
      if (typeof layout === 'string') {
        try { layout = JSON.parse(layout); }
        catch (e) {
          console.error("❌ JSON layout error:", e);
          initCanvas(bgUrl);
          return;
        }
      }

      removeHtmlPreviews();
      canvas.clear();
      loadBackground(bgUrl);

      canvas.loadFromJSON(layout, () => {
        canvas.renderAll();
        console.log("✅ Layout berhasil dimuat untuk template", templateId);
      });
    })
    .catch(err => {
      console.error("❌ Gagal load layout:", err);
      initCanvas(bgUrl);
    });
}

function removeHtmlPreviews() {
  document.querySelectorAll('.draggable-text').forEach(el => el.remove());
}
