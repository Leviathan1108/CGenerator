<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penerima</title>
</head>
<body>
    <h1>Daftar Penerima</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
        @foreach ($recipients as $recipient)
        <tr>
            <td>{{ $recipient->recipient_id }}</td>
            <td>{{ $recipient->name }}</td>
            <td>{{ $recipient->email }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
