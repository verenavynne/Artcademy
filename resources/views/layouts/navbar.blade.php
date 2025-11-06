 <nav class="navbar navbar-expand-lg bg-body-tertiary py-0 ">
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
                        <a class="nav-link " href="">Membership</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link " href="">Forum</a>
                    </li>
                    
                </ul>

                <div class="d-flex flex-row align-items-center gap-2">
                    @if (Auth::check())
                        <p class="fw-bold" style="font-size: 18px; color: black; margin: 0; white-space: nowrap;">Hi, {{ Auth::user()->name }}</p>
                        <a href="#">
                            <img src="{{ asset('assets/default-profile.jpg') }}" class="rounded-circle" style="box-shadow: rgba(67, 39, 0, 0.2); object-fit: cover" alt="Profile Icon" width="43" height="43">
                        </a>
                    @elseif(!Auth::check())
                        <a href="{{ route('login') }}" class="btn navbar-button-login d-flex justify-content-center align-items-center"  role="button">Masuk</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

<style>


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
