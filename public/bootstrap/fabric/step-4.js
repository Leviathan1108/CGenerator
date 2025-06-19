let canvas;
let backgroundImage = null;
let logoImage = null;
let signatureImage = null;

window.addEventListener('DOMContentLoaded', () => {
  canvas = new fabric.Canvas('certificate-canvas', {
    width: 950,
    height: 700,
    selection: false,
    preserveObjectStacking: true
  });

  const selectedImg = document.getElementById('selected_template_img');
  if (!selectedImg || !selectedImg.value) {
    console.warn("Template tidak ditemukan.");
    return;
  }

  const path = window.location.origin + "/storage/" + selectedImg.value;
  const templateId = selectedImg.dataset.templateId;

  console.log("Template path:", selectedImg.value);
  console.log("Path yang akan dipakai:", path);

  // Hanya jalankan salah satu
  if (document.body.classList.contains('load-saved-layout')) {
    loadLayoutFromServer(templateId, path);
  } else {
    initCanvas(path);
  }

  // Tetap jalankan event binding ke form
  bindFormFields();

  // Tombol reset
  document.getElementById('reset-canvas-btn')?.addEventListener('click', () => {
    initCanvas(path);
  });
});

function initCanvas(certBgUrl) {
    removeHtmlPreviews(); // 🧹 bersihkan dulu
  canvas.clear();
  loadBackground(certBgUrl);

  addText('title', 'Certificate of Appreciation', { top: 100, left: 100, fontSize: 28, fontWeight: 'bold' });
  addText('description', 'This certificate is proudly presented to:', { top: 150, left: 100, fontSize: 14 });
  addText('recipient', 'Nama Peserta', { top: 200, left: 100, fontSize: 26, fontWeight: 'bold' });
  addText('role', 'Sebagai Peserta', { top: 250, left: 100, fontSize: 16 });
  addText('event', 'Judul Event Panjang', { top: 300, left: 100, fontSize: 16 });
  addText('date', 'Jakarta, 19 Mei 2025', { top: 350, left: 100, fontSize: 14 });
  addText('signature_name', 'Nama Penandatangan', { top: 600, left: 100, fontSize: 14 });

  // UID Placeholder (tidak bisa digeser)
  const uidPlaceholder = new fabric.Textbox('UID_PLACEHOLDER', {
    left: 800,
    top: 670,
    fontSize: 12,
    fill: 'red',
    selectable: false,
    evented: false,
    fontStyle: 'italic',
    customId: 'uid'
  });
  canvas.add(uidPlaceholder);
}

function loadBackground(url) {
  fabric.Image.fromURL(url, function(img) {
    if (!img) {
      console.error("Gagal memuat background:", url);
      return;
    }
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
    ...options,
    customId: id
  });
  canvas.add(textbox);
}

function addImage(id, url, options = {}) {
  const existing = getObjectById(id);
  if (existing) canvas.remove(existing);

  fabric.Image.fromURL(url, function(img) {
    if (!img) {
      console.error("Gagal memuat gambar:", url);
      return;
    }
    img.set({
      left: options.left || 50,
      top: options.top || 50,
      scaleX: options.scaleX || 0.2,
      scaleY: options.scaleY || 0.2,
      hasControls: true,
      hasBorders: true,
      originX: 'left',
      originY: 'top',
      customId: id
    });
    canvas.add(img);

    if (id === 'logo') logoImage = img;
    if (id === 'signature') signatureImage = img;
  }, { crossOrigin: 'anonymous' });
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

function formatDate(input) {
  const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  const d = new Date(input);
  if (isNaN(d)) return input;
  return `Jakarta, ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
}

function bindFormFields() {
  document.querySelector('[name="recipient"]')?.addEventListener('input', e => updateText('recipient', e.target.value));
  document.querySelector('[name="event_name"]')?.addEventListener('input', e => updateText('event', e.target.value));
  document.querySelector('[name="title"]')?.addEventListener('input', e => updateText('title', e.target.value));
  document.querySelector('[name="role"]')?.addEventListener('input', e => updateText('role', e.target.value));
  document.querySelector('[name="date"]')?.addEventListener('input', e => updateText('date', formatDate(e.target.value)));
  document.querySelector('[name="description"]')?.addEventListener('input', e => updateText('description', e.target.value));
  document.querySelector('[name="signature_name"]')?.addEventListener('input', e => updateText('signature_name', e.target.value));

  document.querySelector('[name="logo"]')?.addEventListener('change', e => {
    const file = e.target.files[0];
    if (file) {
      addImage('logo', URL.createObjectURL(file), { left: 20, top: 20, scaleX: 0.1, scaleY: 0.1 });
    }
  });

  document.querySelector('[name="signatureImage"]')?.addEventListener('change', e => {
    const file = e.target.files[0];
    if (file) {
      addImage('signature', URL.createObjectURL(file), { left: 600, top: 600, scaleX: 0.2, scaleY: 0.2 });
    }
  });
}

// Layout persistence
function saveLayoutToServer(templateId) {
  const layout = canvas.toJSON(['customId']);

  fetch('/certificate/layout', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
      template_id: templateId,
      layout: layout
    })
  })
  .then(res => res.json())
  .then(data => {
      console.log("Layout disimpan.");
      if (callback) callback();
    })
    .catch(err => console.error("Save layout error:", err));
}

function loadLayoutFromServer(templateId, bgUrl) {
  fetch(`/certificate/layout?template_id=${templateId}`)
    .then(res => res.json())
    .then(data => {
      if (data && !data.error) {
        removeHtmlPreviews(); // 🧹 bersihkan dulu
        canvas.clear();
        loadBackground(bgUrl);
        canvas.loadFromJSON(data, () => {
          // Hapus objek ganda dengan customId yang sama
          const seen = new Set();
          canvas.getObjects().forEach(obj => {
            if (obj.customId) {
              if (seen.has(obj.customId)) canvas.remove(obj);
              else seen.add(obj.customId);
            }
          });

          canvas.renderAll();
          console.log("Layout berhasil dimuat dari server.");
        });
      }
    })
    .catch(err => console.error("Load error:", err));
}
function removeHtmlPreviews() {
  const previews = document.querySelectorAll('.draggable-text');
  previews.forEach(el => el.remove());
}