console.log("main.js loaded");

const canvas = new fabric.Canvas('certificateCanvas');
const originalWidth = 2000;
const originalHeight = 1414;

// Inisialisasi ukuran awal canvas
canvas.setWidth(originalWidth);
canvas.setHeight(originalHeight);

// Fungsi resize canvas agar fit ke wrapper
function resizeCanvasToFit() {
  const wrapper = document.querySelector('.canvas-wrapper');
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

// Resize saat load dan saat window resize
window.addEventListener('resize', resizeCanvasToFit);
window.addEventListener('load', resizeCanvasToFit);

// Ambil data dari Laravel (via script di HTML)
console.log("Template data:", window.templateData);

if (window.templateData?.image) {
  console.log("Memuat gambar dari URL:", window.templateData.image);

  fabric.Image.fromURL(window.templateData.image, function (img) {
    if (!img) {
      console.error("Gambar gagal dimuat!");
      return;
    }

    console.log("Gambar dimuat, ukuran:", img.width, img.height);

    // Set gambar sebagai background dengan scaling dinamis
    const scaleX = canvas.width / img.width;
    const scaleY = canvas.height / img.height;
    const scale = Math.min(scaleX, scaleY);

    img.set({
      scaleX: scale,
      scaleY: scale,
      originX: 'center',
      originY: 'center',
      left: canvas.width / 2,
      top: canvas.height / 2,
      selectable: false,
      evented: false
    });

    canvas.setBackgroundImage(img, function () {
      canvas.renderAll();

      // Jika ada layout tersimpan, load
      if (window.templateData?.layout?.objects?.length > 0) {
        console.log("Memuat layout dari database...");
        canvas.loadFromJSON(window.templateData.layout, canvas.renderAll.bind(canvas));
      } else {
        console.log("Tidak ada layout disimpan. Menambahkan teks default...");

        // Teks default
        const titleText = new fabric.Text('Certificate of Completion', {
          left: canvas.width / 2,
          top: 100,
          fontSize: 32,
          fontWeight: 'bold',
          originX: 'center',
          fill: '#16235e'
        });
        const nameText = new fabric.Text('Recipient Name', {
          left: canvas.width / 2,
          top: 200,
          fontSize: 28,
          originX: 'center',
          fill: '#333'
        });
        const courseText = new fabric.Text('has successfully completed the course', {
          left: canvas.width / 2,
          top: 250,
          fontSize: 18,
          originX: 'center',
          fill: '#666'
        });

        canvas.add(titleText, nameText, courseText);
      }
    });
  });
} else {
  console.error("Tidak ada image di window.templateData!");
}

// Fungsi untuk menambah teks baru ke canvas
function addText() {
  const text = new fabric.Textbox('Teks Baru', {
    left: 100,
    top: 100,
    fontSize: 24,
    fill: '#000'
  });
  canvas.add(text).setActiveObject(text);
}
window.addText = addText;

// Fungsi simpan layout ke input hidden
function saveLayout() {
  const layoutJSON = JSON.stringify(canvas.toJSON());
  document.getElementById('layout_storage').value = layoutJSON;
}
window.saveLayout = saveLayout;

// Tombol download sebagai PNG
const downloadBtn = document.getElementById('downloadBtn');
if (downloadBtn) {
  downloadBtn.addEventListener('click', function () {
    const dataURL = canvas.toDataURL({
      format: 'jpeg',
      quality: 0.9
    });

    const link = document.createElement('a');
    link.href = dataURL;
    link.download = 'certificate.png';
    link.click();
  });
}
