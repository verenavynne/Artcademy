 <nav class="navbar navbar-expand-lg bg-body-tertiary py-0 sticky-top" id="mainNavbar" >
    <div class="container-fluid px-5 py-4" style="background-color:var(--cream-color);">
        <a href="">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="153px" height="38px">
        </a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end ps-3" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
            <div class="offcanvas-header pt-5 ">
                <h5 class="offcanvas-title fw-bold fs-2" style="color: black;" id="offcanvasMenuLabel">Menu</h5>
                <button type="button" class="btn-close text-reset pe-5" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav flex-column flex-lg-row align-items-lg-center justify-content-lg-center w-100 wide-gap" style="font-size: 16px">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('course') ? 'active' : '' }}" href="{{ route('course') }}">Kursus</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link " href="">Event</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('membership') ? 'active' : '' }}" href="{{ route('membership') }}">Membership</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('forum') ? 'active' : '' }}" href="{{ route('forum') }}">Forum</a>
                    </li>
                    
                </ul>

                <div class="d-flex flex-row align-items-center gap-2">
                    @if (Auth::check())
                        <!-- <p class="fw-bold" style="font-size: 18px; color: black; margin: 0; white-space: nowrap;">Hi, {{ Auth::user()->name }}</p>
                        <a href="{{ route('my-profile') }}">
                            <img src="{{ asset('assets/default-profile.jpg') }}" class="rounded-circle" style="box-shadow: rgba(67, 39, 0, 0.2); object-fit: cover" alt="Profile Icon" width="43" height="43">
                        </a> -->
                        <div class="dropdown">
                            <a class="profil d-flex align-items-center text-decoration-none text-dark " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('assets/default-profile.jpg') }}" class="rounded-circle" style="box-shadow: rgba(67, 39, 0, 0.2); object-fit: cover" alt="Profile Icon" width="54" height="54">

                                <div class="d-flex flex-column text-start">
                                    <span class="fw-medium" style= "font-size: 18px">Farren</span>
                                    <small class="text-muted" style="font-size: 14px;">Siswa</small>
                                </div>
                                <iconify-icon icon="mdi:chevron-down" class="dropdown-icon ms-2"></iconify-icon>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="z-index: 9999;">
                                <li><a class="dropdown-item" href="{{ route('my-profile') }}">Profil</a></li>
                                <li>
                                    <a href="#" class="dropdown-item text-danger"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Keluar
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @elseif(!Auth::check())
                        <a href="{{ route('login') }}" class="btn navbar-button-login d-flex justify-content-center align-items-center"  role="button">Masuk</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    .profil{
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
    }

    .dropdown-icon {
    align-self: flex-start; 
    margin-top: 4px; 
    color: #333;
    transition: transform 0.3s ease;
    }

    .dropdown.show .dropdown-icon {
    transform: rotate(180deg);
    }

    a[aria-expanded="true"] .dropdown-icon {
    transform: rotate(180deg);
    }

    .dropdown-menu {
        font-size: 18px;
        border: none;
        box-shadow: 0 6px 12px rgba(67, 39, 0, 0.2);
        margin-top: 12px !important;
        padding: 12px 12px;
    }

    .dropdown-item:hover{
        background: var(--cream-color);
        border-radius: 4px;
    }

    @media (min-width: 992px) { 
        .wide-gap {
            gap: 60px; 
        }
    }

    @media (max-width: 768px) { 
        .wide-gap {
            gap: 1px; 
        }

        .offcanvas {
            max-width: 250px; 
            font-size: 12px; 
        }
    }
</style>
