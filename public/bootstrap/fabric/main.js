console.log("main.js dimuat");

const canvas = new fabric.Canvas('certificateCanvas');
const originalWidth = 2000;
const originalHeight = 1414;

// Cek apakah elemen canvas tersedia
window.addEventListener('DOMContentLoaded', () => {
  const canvasElement = document.getElementById('certificateCanvas');
  if (!canvasElement) {
    console.error('Element #certificateCanvas tidak ditemukan!');
  }
});

// Inisialisasi ukuran awal canvas
canvas.setWidth(originalWidth);
canvas.setHeight(originalHeight);

// Fungsi untuk resize canvas agar fit ke wrapper
function resizeCanvasToFit() {
  const wrapper = document.querySelector('.canvas-wrapper');
  if (!wrapper) {
    console.warn("Elemen .canvas-wrapper belum tersedia");
    return;
  }

  const scale = Math.min(
    wrapper.clientWidth / originalWidth,
    wrapper.clientHeight / originalHeight
  );

  canvas.setDimensions({
    width: originalWidth * scale,
    height: originalHeight * scale
  });

  canvas.setZoom(scale);
  canvas.renderAll();
}


window.addEventListener('resize', resizeCanvasToFit);
window.addEventListener('load', resizeCanvasToFit);

// Ambil data dari Laravel
console.log("Data Template:", window.templateData);

if (window.templateData?.image) {
  console.log("Memuat gambar dari URL:", window.templateData.image);

  fabric.Image.fromURL(window.templateData.image, function (img) {
    if (!img) {
      console.error("Gambar gagal dimuat!");
      return;
    }

    console.log("Gambar dimuat, ukuran:", img.width, img.height);

    // Scale gambar agar pas sebagai background
    img.scaleToWidth(canvas.width);
    img.scaleToHeight(canvas.height);

    img.set({
      originX: 'center',
      originY: 'center',
      left: canvas.width / 2,
      top: canvas.height / 2,
      selectable: false,
      evented: false,
      hasBorders: false,
      hasControls: false
    });

    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));

    // Load layout jika tersedia
    if (window.templateData?.layout?.objects?.length > 0) {
      console.log("Memuat layout dari database...");
      canvas.clear(); // hapus isi sebelumnya
      canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas)); // set lagi background
      canvas.loadFromJSON(window.templateData.layout, canvas.renderAll.bind(canvas));
    } else {
      console.log("Tidak ada layout disimpan. Menambahkan teks default...");

      const titleText = new fabric.Text('Sertifikat Penyelesaian', {
        left: canvas.width / 2,
        top: 100,
        fontSize: 32,
        fontWeight: 'bold',
        originX: 'center',
        fill: '#16235e'
      });

      const recipientName = window.templateData?.recipientName || 'Nama Penerima';
      const courseName = window.templateData?.courseName || 'Nama Kursus';

      const nameText = new fabric.Text(recipientName, {
        left: canvas.width / 2,
        top: 200,
        fontSize: 28,
        originX: 'center',
        fill: '#333',
        customType: 'recipient'
      });

      const courseText = new fabric.Text(courseName, {
        left: canvas.width / 2,
        top: 250,
        fontSize: 18,
        originX: 'center',
        fill: '#666'
      });

      canvas.add(titleText, nameText, courseText);
    }
  });
} else {
  console.error("Tidak ada gambar di window.templateData!");
}

// Fungsi untuk menambah teks ke canvas
function addText() {
  const text = new fabric.Textbox('Teks Baru', {
    left: 100,
    top: 100,
    fontSize: 24,
    fill: '#000',
    selectable: true,
    evented: true
  });
  canvas.add(text).setActiveObject(text);
}
window.addText = addText;

// Tangkap nama penerima dari canvas
function captureRecipientName() {
  const objects = canvas.getObjects();
  const recipientObj = objects.find(obj => obj.customType === 'recipient');
  if (recipientObj) {
    document.getElementById('recipient_name').value = recipientObj.text;
  }
}

// Simpan layout JSON ke input hidden
function saveLayout() {
  const layoutJSON = JSON.stringify(canvas.toJSON());
  document.getElementById('layout_storage').value = layoutJSON;
  captureRecipientName();
}
window.saveLayout = saveLayout;

// Tombol download
const downloadBtn = document.getElementById('downloadBtn');
if (downloadBtn) {
  downloadBtn.addEventListener('click', function () {
    const dataURL = canvas.toDataURL({
      format: 'jpeg',
      quality: 0.9
    });

    const link = document.createElement('a');
    link.href = dataURL;
    link.download = 'sertifikat.png';
    link.click();
  });
}
