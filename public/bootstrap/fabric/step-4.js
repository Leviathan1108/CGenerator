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

  addText('title', 'Certificate of Appreciation', {
    top: percentY(12), left: percentX(50),
    fontSize: 24, fontWeight: 'bold', originX: 'center', textAlign: 'center'
  });
  
  addText('description', 'This certificate is proudly presented to:', {
    top: percentY(20), left: percentX(50),
    fontSize: 14, originX: 'center', textAlign: 'center'
  });
  
  addText('recipient', 'Nama Peserta', {
    top: percentY(28), left: percentX(50),
    fontSize: 28, fontWeight: 'bold', originX: 'center'
  });
  
  addText('role', 'Sebagai Peserta', {
    top: percentY(33), left: percentX(50),
    fontSize: 16, originX: 'center'
  });
  
  addText('event', 'Judul Event Panjang', {
    top: percentY(52), left: percentX(50),
    fontSize: 16, originX: 'center'
  });
  
  addText('date', 'Jakarta, 19 Mei 2025', {
    top: percentY(58), left: percentX(50),
    fontSize: 14, originX: 'center'
  });
  
  addText('signature_name', 'Nama Penandatangan', {
    top: percentY(90), left: percentX(50),
    fontSize: 14, originX: 'center'
  });

  function percentX(p) {
    return (canvas.width * p) / 100;
  }
  
  function percentY(p) {
    return (canvas.height * p) / 100;
  }
  
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
    width: options.width || 400,
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