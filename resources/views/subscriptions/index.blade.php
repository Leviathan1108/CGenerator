<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Subscription</title>
</head>
<body>
    <h1>Daftar Subscription</h1>
    <a href="{{ route('subscriptions.create') }}">Tambah Subscription</a>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Durasi (hari)</th>
            <th>Aksi</th>
        </tr>
        @foreach ($subscriptions as $subscription)
        <tr>
            <td>{{ $subscription->id }}</td>
            <td>{{ $subscription->name }}</td>
            <td>Rp{{ number_format($subscription->price, 2) }}</td>
            <td>{{ $subscription->duration }}</td>
            <td>
                <a href="{{ route('subscriptions.edit', $subscription->id) }}">Edit</a>
                <form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
