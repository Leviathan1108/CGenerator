document.getElementById('save-certificate-btn').addEventListener('click', function () {
    const layoutJson = JSON.stringify(canvas.toJSON());
  
    fetch('/templateadmin/upload', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({
        template_id: TEMPLATE_ID, // pastikan variabel ini diisi di view
        layout_storage: layoutJson
      })
    })
    .then(response => response.json())
    .then(data => {
      alert('Layout berhasil disimpan!');
    })
    .catch(error => {
      console.error('Error saving layout:', error);
    });
  });