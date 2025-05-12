<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Certificate - Stepper</title>
  <link rel="stylesheet" href="{{ asset('bootstrap/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<header>
  <!-- Header from your previous navbar layout -->
  <div class="navbar">
    <div class="navbar-left">
      <h1 class="ms-2 me-5 text-light fw-bold text-[40px]">
        <span>Certificate</span>
        <br>
        <span>Generator</span>
      </h1>
    </div>
    <div class="navbar-center">
      <div class="search-box">
        <input type="text" placeholder="Search here ..." />
      </div>
    </div>
    <!-- Tombol profil -->
    <button
      class="btn btn-light bg-light border shadow-none rounded-circle p-0 d-flex align-items-center justify-content-center me-2"
      data-bs-toggle="dropdown" aria-expanded="false" style="height: 60px; width: 60px; overflow: hidden;">
      @if(Auth::check() && Auth::user()->photo_profile)
      <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile"
      class="rounded-circle w-100 h-100 rounded-circle" style="object-fit: cover; display: block;">
    @else
      <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
      style="height: 50px; width: 50px;">👤</div>
    @endif
    </button>

    <!-- Dropdown Content -->
    <ul class="dropdown-menu dropdown-menu-end shadow p-3" style="min-width: 250px; background-color: #FBB041;">
      <!-- Bagian atas: foto profil besar dan username -->
      <li class="text-center">
        <div class="d-flex flex-column align-items-center">
          <!-- unutuk menampilkan foto profile -->
          @if(Auth::check() && Auth::user()->photo_profile)
        <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile" class="rounded-circle"
        style="height: 50px; width: 50px; object-fit: cover;">
      @else
        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
        style="height: 50px; width: 50px;">👤</div>
      @endif
          <strong class="text-light"> {{ Auth::check() ? Auth::user()->username : 'Guest' }} </strong>
          <a href="#" class="text-decoration-none text-white small">View Profile</a>
        </div>
      </li>

      <li>
        <hr class="dropdown-divider border-white">
      </li>

      <!-- Bagian bawah: ikon-only menu (dari kamu) -->
      <li class="text-center">
        <a class="dropdown-item" href="/home" title="Settings">
          <i class="bi bi-house-fill text-dark fs-6"> {{ __('Home') }}</i>
        </a>
      </li>
    </ul>
  </div>
</header>

<body class="bg-gray-100">
  <input type="hidden" id="currentStep" value="1" />

  <main class="max-w-6xl mx-auto mt-8 bg-white rounded-xl shadow-md p-8">
    <h2 class="fw-bold mb-2">Create New Certificate</h2>
    <p class="text-muted">Follow the steps below to create and publish your certificate</p>

    <div class="mb-4">
      <div class="d-flex justify-content-between text-primary fw-semibold">
        <div>1 Select Background</div>
        <div>2 Input Data</div>
        <div>3 Preview</div>
        <div>4 Request Approval</div>
        <div>5 Publish</div>
      </div>
      <div class="progress" style="height: 5px;">
        <div class="progress-bar bg-primary" style="width: 60%;"></div>
      </div>
    </div>
<div class="container">
    <h3 class="mb-4">Certificate Preview</h3>

    <div class="mb-4">
        <label for="contactSelect" class="form-label">Select Contact:</label>
        <select id="contactSelect" class="form-select">
            @foreach ($contacts as $contact)
                <option value="{{ $contact->name }}|{{ $contact->email }}">
                    {{ $contact->name }} ({{ $contact->email }})
                </option>
            @endforeach
        </select>
    </div>

    <canvas id="certCanvas" width="1000" height="700" style="border:1px solid #ccc;"></canvas>
</div>


<script src="{{ asset('bootstrap/fabric/fabric.min.js') }}"></script>
<script>
    const canvas = new fabric.Canvas('certCanvas');

    // Set background image from Laravel storage
    const bgImage = "{{ asset( $template->file_path) }}";

    fabric.Image.fromURL(bgImage, function(img) {
        img.scaleToWidth(canvas.width);
        img.scaleToHeight(canvas.height);
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
        img.set({ selectable: false, evented: false });
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
    });

    let nameText = new fabric.Text("{{ $contacts[0]->name }}", {
      left: 300,
      top: 300,
      fontSize: 30,
      fill: 'black',
      lockDeletion: true // custom flag
    });
  
    canvas.on('before:selection:cleared', function (e) {
      if (!e.target) return;
      // Prevent selection clear if it's one of the name/email texts
      if (e.target.lockDeletion) {
      e.preventDefault?.();
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Delete' || e.key === 'Backspace') {
      const active = canvas.getActiveObject();
      if (active && active.lockDeletion) {
      e.preventDefault();
        }
      }
    });


    canvas.add(nameText);
   

    document.getElementById('contactSelect').addEventListener('change', function() {
        const [name, email] = this.value.split('|');
        nameText.text = name;
        emailText.text = email;
        canvas.renderAll();
    });
</script>
</main>
</body>
</html>
