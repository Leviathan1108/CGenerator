<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Sertifikat</title>
</head>
<body>
    <h1>Buat Sertifikat</h1>
    <form action="{{ route('certificates.store') }}" method="POST">
        @csrf

        <label>Template:</label>
        <select name="template_id" required>
            @foreach ($templates as $template)
                <option value="{{ $template->id }}">{{ $template->name }}</option>
            @endforeach
        </select>

        <label>Recipient:</label>
        <select name="recipient_id" required>
            @foreach ($recipients as $recipient)
                <option value="{{ $recipient->recipient_id }}">{{ $recipient->name }}</option>
            @endforeach
        </select>

        <label>Issued By:</label>
        <select name="issued_by">
            <option value="">Pilih</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <label>Issue Date:</label>
        <input type="date" name="issue_date" value="{{ date('Y-m-d') }}" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
            <option value="revoked">Revoked</option>
        </select>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
