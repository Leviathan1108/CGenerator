<form action="{{ route('certificates.store') }}" method="POST">
    @csrf
    <label>Template:</label>
    <select name="template_id" required>
        @foreach ($templates as $template)
            <option value="{{ $template->id }}">{{ $template->name }}</option>
        @endforeach
    </select>

    <label>Penerima:</label>
    <select name="recipient_id" required>
        @foreach ($recipients as $recipient)
            <option value="{{ $recipient->id }}">{{ $recipient->name }}</option>
        @endforeach
    </select>

    <label>Tanggal Terbit:</label>
    <input type="date" name="issued_date" value="{{ date('Y-m-d') }}" required>

    <label>Status:</label>
    <select name="status" required>
        <option value="draft">Draft</option>
        <option value="published">Published</option>
        <option value="revoked">Revoked</option>
    </select>

    <button type="submit">Simpan</button>
</form>
