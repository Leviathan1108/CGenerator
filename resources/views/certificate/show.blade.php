<h2>Certificate Details</h2>
<p>Event: {{ $certificate->event_name }}</p>
<p>Verification Code: {{ $certificate->verification_code }}</p>

<!-- Menampilkan sertifikat sebagai gambar -->
<img src="{{ asset('storage/certificates/'.$certificate->image_path) }}" alt="Sertifikat" />

<!-- Atau menampilkan PDF -->
<iframe src="{{ asset('storage/certificates/'.$certificate->pdf_filename) }}" width="100%" height="600px"></iframe>
