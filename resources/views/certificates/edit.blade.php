<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sertifikat</title>
</head>
<body>
    <h1>Edit Sertifikat</h1>
    <form action="{{ route('certificates.update', $certificate->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Template:</label>
        <select name="template_id" required>
            @foreach ($templates as $template)
                <option value="{{ $template->id }}" {{ $template->id == $certificate->template_id ? 'selected' : '' }}>
                    {{ $template->name }}
                </option>
            @endforeach
        </select>

        <label>Recipient:</label>
        <select name="recipient_id" required>
            @foreach ($recipients as $recipient)
                <option value="{{ $recipient->id }}" {{ $recipient->id == $certificate->recipient_id ? 'selected' : '' }}>
                    {{ $recipient->name }}
                </option>
            @endforeach
        </select>

        <label>UID:</label>
        <input type="text" name="uid" value="{{ $certificate->uid }}" readonly>

        <label>Verification Code:</label>
        <input type="text" name="verification_code" value="{{ $certificate->verification_code }}" readonly>

        <label>Issue Date:</label>
        <input type="date" name="issued_date" value="{{ \Carbon\Carbon::parse($certificate->issued_date)->format('Y-m-d') }}" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="draft" {{ $certificate->status == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ $certificate->status == 'published' ? 'selected' : '' }}>Published</option>
            <option value="revoked" {{ $certificate->status == 'revoked' ? 'selected' : '' }}>Revoked</option>
        </select>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
