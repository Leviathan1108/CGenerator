<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sertifikat</title>
</head>
<body>
    <h1>Daftar Sertifikat</h1>
    <table border="1">
        <tr>
            <th>Certificate Id</th>
            <th>Template Id</th>
            <th>Recipient Id</th>
            <th>Status</th>
        </tr>
        @foreach ($certificates as $certificate)
        <tr>
            <td>{{ $certificate->certificate_id }}</td>
            <td>{{ $certificate->template_id }}</td>
            <td>{{ $certificate->recipient_id }}</td>
            <td>{{ $certificate->status }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
