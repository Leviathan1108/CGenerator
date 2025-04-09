<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subscription</title>
</head>
<body>
    <h1>Edit Subscription</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('subscriptions.update', $subscription->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nama:</label>
        <input type="text" name="name" value="{{ $subscription->name }}" required><br>

        <label for="price">Harga:</label>
        <input type="number" name="price" step="0.01" value="{{ $subscription->price }}" required><br>

        <label for="duration">Durasi (hari):</label>
        <input type="number" name="duration" value="{{ $subscription->duration }}" required><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('subscriptions.index') }}">Kembali ke Daftar Subscription</a>
</body>
</html>
