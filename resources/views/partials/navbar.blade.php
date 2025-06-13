<header class="header d-flex justify-content-between align-items-center text-light flex-grow-0"
    style="background-color: #232E66; font-family: 'Montserrat', sans-serif;">
    <h1 class="mt-3 ms-2 me-5 fw-bold">
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
                    class="btn btn-light bg-light border shadow-none dropdown-toggle rounded-circle p-0 d-flex align-items-center justify-content-center"
                    data-bs-toggle="dropdown" aria-expanded="false"
                    style="height: 60px; width: 60px; overflow: hidden;">
                    @if(Auth::check() && Auth::user()->photo_profile)
                        <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile"
                            class="rounded-circle w-100 h-100 rounded-circle" style="object-fit: cover; display: block;">
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
                            <strong class="text-light"> {{ Auth::check() ? Auth::user()->username : 'Guest' }} </strong>
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
                    <!-- untuk menampilkan tombol login jika user sudah login -->
                    @auth
                        <li class="text-center">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                title="Logout">
                                <i class="bi bi-box-arrow-right text-dark fs-6"> {{ __('Logout') }}</i>
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <li class="text-center">
                            <a class="dropdown-item" href="/settings" title="Settings">
                                <i class="bi bi-gear-fill text-dark fs-6"> Settings</i>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- sidebar -->
<nav class="sidebar" style="font-family: 'Montserrat', sans-serif; background-color: #232E66; width: 294px;">
    <ul class="nav rounded-4 flex-column d-flex mx-auto mt-4">
        <li class="nav-item">
            <a class="nav-link fs-6 text-light" href="/">Dashboard</a>
        </li>
        <li class="nav-item">
            @if (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin']))
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/templatesuperadmin">Templates Superadmin</a>
                </li>
            @endif
        </li>
        <li class="nav-item">
            <a class="nav-link fs-6 text-light" href="/templateadmin">Create New Certificate</a>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-6 text-light" href="/verifications">Verifications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-6 text-light" href="/recipients">Recipients</a>
        </li>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-6 text-light" href="/subscriptions">Subscriptions</a>
        </li>

        @if (Auth::check() && Auth::user()->role == 'superadmin')
            <li class="nav-item">
                <a class="nav-link fs-6 text-light" href="/user">User Management</a>
            </li>
        @endif

        <li class="nav-item">
            @if (Auth::check() && Auth::user()->role == 'superadmin')
                <a class="nav-link fs-6 text-light" href="/history">View History</a>
            @endif
        </li>
    </ul>
</nav>