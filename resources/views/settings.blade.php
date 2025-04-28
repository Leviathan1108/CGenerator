<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Generator Dashboard</title>
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
</head>

<body>
    <div class="row" style="display: flex; margin: 0;">
        <header class="navbar d-flex justify-content-between align-items-center text-light flex-grow-0"
            style="background-color: #232E66; font-family: 'Montserrat', sans-serif;">
            <h1 class="mt-3 ms-4 fw-bold">
                <span>Certificate</span>
                <br>
                <span>Generator</span>
            </h1>
            <div class="d-flex align-items-center gap-2 mx-2">
                <input type="text" class="form-control" placeholder="Search"
                    style="width: 1200px; background-color: #D9D9D9; border-radius: 16px;">
                <div class="btn-group">
                    <div class="dropdown">
                        <!-- Tombol profil -->
                        <button
                            class="btn btn-light bg-light border shadow-none rounded-circle p-0 d-flex align-items-center justify-content-center"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="height: 60px; width: 60px; overflow: hidden;">
                            @if(Auth::check() && Auth::user()->photo_profile)
                                <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile"
                                    class="rounded-circle w-100 h-100 rounded-circle"
                                    style="object-fit: cover; display: block;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                    style="height: 50px; width: 50px;">👤</div>
                            @endif
                        </button>

                        <!-- Dropdown Content -->
                        <ul class="dropdown-menu dropdown-menu-end shadow p-3"
                            style="min-width: 250px; background-color: #FBB041;">
                            <!-- Bagian atas: foto profil besar dan username -->
                            <li class="text-center mb-2">
                                <div class="d-flex flex-column align-items-center">
                                    <!-- unutuk menampilkan foto profile -->
                                    @if(Auth::check() && Auth::user()->photo_profile)
                                        <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile"
                                            class="rounded-circle" style="height: 50px; width: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                            style="height: 50px; width: 50px;">👤</div>
                                    @endif
                                    <strong class="text-light"> {{ Auth::check() ? Auth::user()->username : 'Guest' }}
                                    </strong>
                                    <a href="#" class="text-decoration-none text-white small">View Profile</a>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider border-white">
                            </li>

                            <!-- Bagian bawah: ikon-only menu (dari kamu) -->
                            @guest
                                <li class="text-center">
                                    <a class=" dropdown-item login text-decoration-none text-dark fs-6 mx-1"
                                        href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-left text-dark fs-6"> {{ __('Login') }}</i>
                                    </a>
                                </li>
                            @endguest
                            <!-- untuk menampilkan tombol home -->
                            <li class="text-center">
                                <a class="dropdown-item" href="/home" title="Settings">
                                    <i class="bi bi-house-fill text-dark fs-6"> home</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- sidebar -->
        <nav class="sidebar"
            style="font-family: 'Montserrat', sans-serif; background-color: #232E66; width: 294px; height: 100dvh;">
            <h4 class="d-flex justify-center my-4">
                @if(Auth::check() && Auth::user()->photo_profile)
                    <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile" class="rounded-circle"
                        style="height: 160px; width: 160px; object-fit: cover;">
                @else
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                        style="height: 90px; width: 90px;">👤</div>
                @endif
            </h4>

            <div class="d-flex justify-center">
                <form action="{{ route('users.update', Auth::user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="photo_profile" class="btn btn-light mb-4" style="width: 190px;">Change Photo</label>
                    <input type="file" name="photo_profile" id="photo_profile" class="d-none">
                    <input type="text" class="form-control" style="width: 190px;" name="username" id="username"
                        placeholder="username" value="{{ Auth::user()->username }}" required><br>
                    <div class="d-flex justify-center gap-2">
                        <button type="submit" class="btn btn-success w-50">Save</button>
                    </div>
                </form>
            </div>
        </nav>
        <!-- content -->
        <div class="main-content ms-4" style="flex: 1; padding: 18; font-family: 'Poppins', sans-serif;">
            <h3 class="mt-4 fs-1 fw-bold">Profile Settings</h3>
            <h3 class="fs-4">Manage your personal information and account preferences</h3>

            <div class="content rounded rounded-4" style="background-color: #C5C5C5; height: 80%;">

                <h3 class="fs-3 fw-bold ms-3 pt-3">Personal information</h3>
                <h3 class="fs-4 ms-3">Update your personal details and information</h3>
                <form action="" method="get" class="ms-3 me-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- First & Last Name -->
                        <div>
                            <label for="first" class="block font-semibold mb-1">First Name</label>
                            <input type="text" id="first" class="w-full border border-black rounded p-2 bg-white"
                                placeholder="First name">
                        </div>
                        <div>
                            <label for="last" class="block font-semibold mb-1">Last Name</label>
                            <input type="text" id="last" class="w-full border  border-black rounded p-2  bg-white"
                                placeholder="Last name">
                        </div>
                    </div>

                    <!-- Email Address - full width -->
                    <div class="col-span-1">
                        <label for="email" class="block font-semibold mb-1">Email Address</label>
                        <input type="email" id="email" class="w-full border rounded p-2  border-black  bg-white"
                            placeholder="Email address">
                        <p class="text-sm text-gray-600 mt-1">This email will be used for notifications and account
                            recovery</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Phone & Language -->
                        <div>
                            <label for="phone" class="block font-semibold mb-1">Phone Number</label>
                            <input type="number" id="phone" class="w-full border  border-black rounded p-2  bg-white"
                                placeholder="+62">
                        </div>
                        <div>
                            <label for="language" class="block font-semibold mb-1">Preferred Language</label>
                            <select id="language" class="w-full border  border-black rounded p-2 bg-white">
                                <option value="eng">English</option>
                                <option value="idn">Indonesia</option>
                            </select>
                            <p class="text-sm text-gray-600 mt-1">Include country code (e.g., + for US)</p>
                        </div>
                    </div>
                    <!-- Bio - full width -->
                    <div class="col-span-2">
                        <label for="bio" class="block font-semibold mb-1">Bio</label>
                        <textarea id="bio" class="w-full border border-black rounded p-2 bg-white" rows="4"
                            placeholder="Training professional with 10 years of experience..."></textarea>
                        <p class="text-sm text-gray-600 mt-1">Characters remaining: 321</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src={{ asset('bootstrap/js/bootstrap.js') }}></script>
    <script src={{asset('bootsrap/js/bootstrap.min.js')}}></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>