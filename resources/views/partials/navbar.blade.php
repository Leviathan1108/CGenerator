<header class="header d-flex justify-content-between align-items-center text-light flex-grow-0"
            style="background-color: #232E66; font-family: 'Montserrat', sans-serif;">
            <h1 class="mt-3 ms-2 me-5 fw-bold">
                <span>Certificate</span>
                <br>
                <span>Generator</span>
            </h1>
            <div class="d-flex align-items-center gap-2 mx-2">
                <input type="text" class="form-control" placeholder="Search"
                    style="width: 1130px; background-color: #D9D9D9; border-radius: 16px;">
                <div class="btn-group">
                    <button class="btn btn-light bg-light rounded-circle mx-1 px-3 dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false" style="height: 50px; width: 60px;">👤</button>
                        <h2 class="fs-5 m-0 mx-2">Welcome back, {{ Auth::user()->name ?? 'Guest' }}</h2>
                    <!-- mengecek apakah user sudah login -->
                    <ul class="dropdown-menu" style="background-color: #FBB041; color: white;">
                        @guest
                            <li>
                                <a class="login text-decoration-none text-light fs-6 mx-1 my-2"
                                    href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right ms-2"></i>
                                    Login</a>
                            </li>
                        @endguest
                        <!-- untuk menampilkan tombol login jika user sudah login -->
                        @auth
                            <li>
                                <a class="text-decoration-none text-light fs-6 mx-1 my-2" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right ms-2"></i> {{ __('Logout') }} 
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endauth
                    </ul>
                </div>
            </div>
        </header>

        <!-- sidebar -->
        <nav class="sidebar" style="font-family: 'Montserrat', sans-serif; background-color: #232E66; width: 294px;">
            <ul class="nav flex-column d-flex mx-auto mt-5">
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/certi">Create New Certificate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/templates">Templates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/certificates">Certificates</a>
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
                <li class="nav-item">
                    <a class="nav-link fs-6 text-light" href="/settings">Settings</a>
                </li>
            </ul>
        </nav>