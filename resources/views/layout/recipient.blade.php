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
        <input type="text" id="searchInput" placeholder="Search here ..." oninput="renderRecipients()" />
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
      <div class="progress-bar bg-primary" style="width: 40%;"></div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-12">
      <h5 class="fw-bold">Add Recipients</h5>

      <!-- Input nama & email penerima -->
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Enter recipient name..." id="recipient-name">
        <input type="email" class="form-control" placeholder="Enter recipient email..." id="recipient-email">
        <button class="btn btn-primary" type="button" onclick="addRecipient()">Add</button>
      </div>

      <!-- Upload CSV -->
      <div class="mb-3">
        <label for="upload-csv" class="form-label">Upload CSV (Name,Email)</label>
        <input class="form-control" type="file" id="upload-csv">
      </div>

      <!-- List penerima -->
      <table class="table table-bordered">
    <thead>
        <tr>
            <th>Recipient Name</th>
            <th>Recipient Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr id="contact-{{ $contact->id }}">
            <td class="contact-name">{{ $contact->name }}</td>
            <td class="contact-email">{{ $contact->email }}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-1" onclick="editRecipient({{ $contact->id }})">Edit</button>
                <button class="btn btn-sm btn-outline-danger" onclick="removeRecipient({{ $contact->id }})">Remove</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



      <!-- Tombol Back dan Next -->
      <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('templateadmin.contacts') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('certificate.preview') }}" class="btn btn-primary">Next</a>
      </div>

    </div>
  </div>
</main>

<script>
let recipients = [];
function addRecipient() {
    const nameInput = document.getElementById('recipient-name');
    const emailInput = document.getElementById('recipient-email');
    const name = nameInput.value.trim();
    const email = emailInput.value.trim();

    if (name && email) {
        // Send the data to the server using AJAX
        fetch("{{ route('templateadmin.contacts.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                name: name,
                email: email
            })
        })
        .then(response => response.json())
        .then(data => {
            // Dynamically add the new contact to the table
            const tableBody = document.querySelector('table tbody');
            tableBody.innerHTML += `
                <tr id="contact-${data.id}">
                    <td class="contact-name">${data.name}</td>
                    <td class="contact-email">${data.email}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary me-1" onclick="editRecipient(${data.id})">Edit</button>
                        <button class="btn btn-sm btn-outline-danger" onclick="removeRecipient(${data.id})">Remove</button>
                    </td>
                </tr>
            `;

            // Clear the input fields
            nameInput.value = '';
            emailInput.value = '';
        })
        .catch(error => console.error('Error:', error));
    }
}

function editRecipient(contactId) {
    const row = document.getElementById(`contact-${contactId}`);
    const nameCell = row.querySelector('.contact-name');
    const emailCell = row.querySelector('.contact-email');

    const newName = prompt('Edit recipient name:', nameCell.textContent);
    const newEmail = prompt('Edit recipient email:', emailCell.textContent);

    if (newName && newEmail) {
        fetch(`/templateadmin/contacts/${contactId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                name: newName,
                email: newEmail
            })
        })
        .then(response => response.json())
        .then(data => {
            nameCell.textContent = data.name;
            emailCell.textContent = data.email;
        })
        .catch(error => console.error('Error:', error));
    }
}



function removeRecipient(contactId) {
    fetch(`/templateadmin/contacts/${contactId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (response.ok) {
            // Remove the contact from the table if successful
            const row = document.getElementById(`contact-${contactId}`);
            row.remove();
        } else {
            alert('Error removing contact');
        }
    })
    .catch(error => console.error('Error:', error));
}



function renderRecipients() {
  const list = document.querySelector('table tbody');
  const searchTerm = document.getElementById('searchInput').value.toLowerCase();
  list.innerHTML = ''; // Clear the table

  // Make sure the recipients array has the latest data from the database or AJAX
  recipients
    .filter(r => 
      r.name.toLowerCase().includes(searchTerm) || 
      r.email.toLowerCase().includes(searchTerm)
    )
    .forEach((recipient, index) => {
      list.innerHTML += `
        <tr id="contact-${recipient.id}">
          <td>${recipient.name}</td>
          <td>${recipient.email}</td>
          <td>
            <button class="btn btn-sm btn-outline-primary me-1" onclick="editRecipient(${recipient.id})">Edit</button>
            <button class="btn btn-sm btn-outline-danger" onclick="removeRecipient(${recipient.id})">Remove</button>
          </td>
        </tr>
      `;
    });
}


// Upload CSV
document.getElementById('upload-csv').addEventListener('change', function(e) {
  console.log('File selected:', e.target.files[0]); // DEBUG
  const file = e.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function(e) {
    console.log('File content loaded'); // DEBUG
    const lines = e.target.result.split('\n');
    lines.forEach(line => {
      const [name, email] = line.split(',');
      if (name && email) {
        const trimmedName = name.trim();
        const trimmedEmail = email.trim();

        fetch("{{ route('templateadmin.contacts.store') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            name: trimmedName,
            email: trimmedEmail
          })
        })
        .then(response => response.json())
        .then(data => {
          recipients.push({ id: data.id, name: data.name, email: data.email });
          renderRecipients();
        })
        .catch(error => console.error('Upload CSV error:', error));
      }
    });
  };
  reader.readAsText(file);
});


</script>

</body>
</html>
