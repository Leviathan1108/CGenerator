// Inisialisasi fabric.js canvas
const canvas = new fabric.Canvas('certificateCanvas', {
  width: 1200,
  height: 850
});

if (window.templateData?.image) {
  fabric.Image.fromURL(window.templateData.image, function(img) {
      img.set({ selectable: false, evented: false });
      canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
          scaleX: canvas.width / img.width,
          scaleY: canvas.height / img.height
      });
  });
}

if (window.templateData?.layout?.objects?.length > 0) {
  canvas.loadFromJSON(window.templateData.layout, canvas.renderAll.bind(canvas));
}
  
  // Tambahkan teks awal sebagai contoh (kamu bisa ubah/replace dengan inputan nanti)
  const titleText = new fabric.Text('Certificate of Completion', {
    left: canvas.width / 2,
    top: 100,
    fontSize: 32,
    fontWeight: 'bold',
    originX: 'center',
    fill: '#16235e'
  });
  canvas.add(titleText);
  
  const nameText = new fabric.Text('Recipient Name', {
    left: canvas.width / 2,
    top: 200,
    fontSize: 28,
    originX: 'center',
    fill: '#333'
  });
  canvas.add(nameText);
  
  const courseText = new fabric.Text('has successfully completed the course', {
    left: canvas.width / 2,
    top: 250,
    fontSize: 18,
    originX: 'center',
    fill: '#666'
  });
  canvas.add(courseText);
  
  // Fungsi generate / download canvas
  document.getElementById('downloadBtn').addEventListener('click', function () {
    const dataURL = canvas.toDataURL({
      format: 'png',
      quality: 1
    });
  
    const link = document.createElement('a');
    link.href = dataURL;
    link.download = 'certificate.png';
    link.click();
  });
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
function saveLayout() {
    const layoutJSON = JSON.stringify(canvas.toJSON());
    document.getElementById('layout_storage').value = layoutJSON;
}
window.saveLayout = saveLayout;
const canvasElement = document.getElementById('certificateCanvas');
const savedLayout = window.templateData.layout;

if (savedLayout && savedLayout.objects && savedLayout.objects.length > 0) {
    canvas.loadFromJSON(savedLayout, function () {
        canvas.renderAll();
    });
}