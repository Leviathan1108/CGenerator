<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/fabric@latest/dist/index.min.js"></script>
    <script>
    import { StaticCanvas, FabricText } from 'fabric'
    const canvas = new StaticCanvas();
    const helloWorld = new FabricText('Hello world!');
    canvas.add(helloWorld);
    canvas.centerObject(helloWorld);
    const imageSrc = canvas.toDataURL();
    // some download code down here
    const a = document.createElement('a');
    a.href = imageSrc;
    a.download = 'image.png';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    </script>
</body>
</html>