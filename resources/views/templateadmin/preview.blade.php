<!DOCTYPE html>
<html>
<head>
    <title>Certificate Preview</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .certificate {
            background-image: url('{{ Storage::url($background) }}');
            background-size: cover;
            width: 800px;
            height: 600px;
            text-align: center;
            position: relative;
        }
        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            width: 100px;
        }
        .data {
            position: absolute;
            bottom: 100px;
            width: 100%;
            text-align: center;
        }
        .name {
            font-size: 32px;
            font-weight: bold;
        }
        .event {
            font-size: 24px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <img src="{{ Storage::url($logo) }}" alt="Logo" class="logo">
        <div class="data">
            <p class="name">{{ $data['name'] }}</p>
            <p class="event">{{ $data['event'] }}</p>
        </div>
    </div>
</body>
</html>
