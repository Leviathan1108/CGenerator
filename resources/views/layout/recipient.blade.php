<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Certificate - Step 3</title>
  <link rel="stylesheet" href="{{ asset('bootstrap/css/upload.css') }}">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<header>
  <div class="navbar">
    <div class="navbar-left">
      <a href="/"><div class="logo">Certificate Generator</div></a>
    </div>
    <div class="navbar-center">
      <div class="search-box">
        <input type="text" placeholder="Search here ..." />
      </div>
    </div>
    <div class="navbar-right">
      <button class="login-btn">Login</button>
    </div>
  </div>
</header>

<body class="bg-gray-100">
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

  <div class="row g-4">
    <div class="col-12">
      <h5 class="fw-bold">Add Recipients</h5>

      <!-- Input nama penerima -->
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Enter recipient name..." id="recipient-name">
        <button class="btn btn-primary" type="button" onclick="addRecipient()">Add</button>
      </div>

      <!-- Upload CSV -->
      <div class="mb-3">
        <label for="upload-csv" class="form-label">Upload CSV</label>
        <input class="form-control" type="file" id="upload-csv">
      </div>

      <!-- List penerima -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Recipient Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="recipient-list">
          <!-- Daftar nama akan di-generate di sini -->
        </tbody>
      </table>

      <!-- Tombol Back dan Next -->
      <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('templateadmin.dataInput') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('templateadmin.previewCertificate') }}" class="btn btn-primary">Next</a>
      </div>

    </div>
  </div>
</main>

<script>
let recipients = [];

function addRecipient() {
  const nameInput = document.getElementById('recipient-name');
  const name = nameInput.value.trim();
  if (name) {
    recipients.push(name);
    renderRecipients();
    nameInput.value = '';
  }
}

function removeRecipient(index) {
  recipients.splice(index, 1);
  renderRecipients();
}

function renderRecipients() {
  const list = document.getElementById('recipient-list');
  list.innerHTML = '';
  recipients.forEach((name, index) => {
    list.innerHTML += `
      <tr>
        <td>${name}</td>
        <td>
          <button class="btn btn-sm btn-outline-primary me-1" onclick="editRecipient(${index})">Edit</button>
          <button class="btn btn-sm btn-outline-danger" onclick="removeRecipient(${index})">Remove</button>
        </td>
      </tr>
    `;
  });
}

function editRecipient(index) {
  const newName = prompt('Edit recipient name:', recipients[index]);
  if (newName !== null && newName.trim() !== '') {
    recipients[index] = newName.trim();
    renderRecipients();
  }
}
</script>

</body>
</html>
