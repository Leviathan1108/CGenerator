<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Preview Certificate</title>
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.1/fabric.min.js"></script>
  <style>
    .canvas-container {
      position: relative;
      width: 100%;
      height: 600px;
      border: 1px solid #000;
    }
    .canvas-container canvas {
      display: block;
      margin: auto;
    }
  </style>
</head>
<body>

  <main class="container mt-5">
    <h2 class="fw-bold mb-4">Preview Certificate</h2>

    <div class="canvas-container" id="canvas-container">
      <canvas id="canvas"></canvas>
    </div>

    <div class="mt-4">
      <label for="font-select">Select Font:</label>
      <select id="font-select" class="form-control w-auto" onchange="changeFont(this)">
        <option value="Calibri">Calibri</option>
        <option value="Times New Roman">Times New Roman</option>
        <option value="Arial">Arial</option>
      </select>
    </div>

    <div class="mt-4">
      <button class="btn btn-secondary" onclick="goBack()">Back</button>
      <button class="btn btn-primary" onclick="saveCertificate()">Save Certificate</button>
    </div>
  </main>

  <script>
    const canvas = new fabric.Canvas('canvas');
    const recipients = @json($data); // Data penerima dari controller

    // Load background from passed data (if available)
    const backgroundPath = "{{ asset('storage/' . $background) }}"; // Load background image from storage
    fabric.Image.fromURL(backgroundPath, function(img) {
      img.set({
        left: 0,
        top: 0,
        selectable: false, // Background cannot be selected or moved
        hasControls: false,
        hasBorders: false
      });
      canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
    });

    // Add recipient data as text on the canvas
    recipients.forEach((recipient, index) => {
      const text = new fabric.Text(`${recipient.name} - ${recipient.event}`, {
        left: 100,
        top: 100 + (index * 40), // Space out text vertically
        fontFamily: 'Calibri',
        fontSize: 20,
        selectable: true, // Text can be moved around
        hasControls: true,
        hasBorders: true
      });

      canvas.add(text);
    });

    // Function to change font of text
    function changeFont(select) {
      const font = select.value;
      canvas.getObjects('text').forEach(obj => {
        obj.set({ fontFamily: font });
        canvas.renderAll();
      });
    }

    // Function to go back to the previous page
    function goBack() {
      window.history.back();
    }

    // Function to save the certificate (you can implement saving layout to the database)
    function saveCertificate() {
      const jsonData = canvas.toJSON();
      console.log(jsonData); // Log the canvas data for debugging
      // Send jsonData to the server to save the layout (AJAX, etc.)
    }
  </script>

</body>
</html>
