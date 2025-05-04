<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Generator Dashboard</title>
        
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}">
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
<meta name="apple-mobile-web-app-title" content="MyWebSite" />
    
    <link href={{ asset('bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('css/app.css') }} rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    @stack('styles')
    <style>
        .sidebar .nav-link:hover {
            background-color: #FBB041;
            border-radius: 10px;
        }

        .checkbox-container {
            background-color: #FBB041;
            border-radius: 20px;
            font-size: medium;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 250px;
            height: 40px;
            padding: 0 5px;
        }

        .checkbox-container input[type="checkbox"] {
            margin-right: 10px;
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #f8f9fa;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .checkbox-container input[type="checkbox"]::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            background-color: transparent;
            transform: translate(-50%, -50%) scale(0);
            transition: background-color 0.3s, transform 0.3s;
            clip-path: polygon(14% 44%, 0% 65%, 50% 100%, 100% 26%, 80% 0%, 52% 54%);
        }

        .checkbox-container input[type="checkbox"]:checked {
            background-color: #FBB041;
            border-color: #232E66;
        }

        .checkbox-container input[type="checkbox"]:checked::before {
            background-color: rgb(0, 0, 0);
            transform: translate(-50%, -50%) scale(1);
        }

        .dropdown-toggle::after {
            display: none !important;
        }
    </style>
</head>
<body style="background-color: #f8f9fa;">
    <!-- Menambahkan Allert-Success -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow rounded-3 px-4 py-2 text-center"
        role="alert" style="z-index: 9999; max-width: 400px;">
        <strong><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</strong>
    </div>
    <script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            // Bootstrap fade out
            alert.classList.remove('show');
            alert.classList.add('hide');
            setTimeout(() => alert.remove(), 500); // remove after fade
        }
    }, 3000); // auto-close after 3s
</script>
@endif
    <div class="row" style="display: flex; margin: 0;">
        @include('partials.navbar')

        <div class="main-content ms-4" style="flex: 1; padding: 18; font-family: 'Poppins', sans-serif;">
            @yield('content')
        </div>
    </div>
    <!-- Tempat untuk konten halaman -->

    <script src={{ asset('bootstrap/js/bootstrap.js') }}></script>
    <script src={{asset('bootstrap/js/bootstrap.min.js')}}></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>