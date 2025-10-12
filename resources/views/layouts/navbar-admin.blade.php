<nav class="navbar-admin d-flex justify-content-between align-items-center px-4 py-2">
    <div class="d-flex align-items-center">
        <a href="">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="153px" height="38px">
        </a>
    </div>

    <div class="d-flex align-items-center gap-4">
        <button class="btn btn-link position-relative p-0">
            <i class="fa-regular fa-bell fs-5 text-dark"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
        </button>

        <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="/assets/profile-farren.jpg" alt="Profile" class="rounded-circle me-2" width="32" height="32">
                <div class="d-flex flex-column text-start">
                    <span class="fw-medium">Farren</span>
                    <small class="text-muted" style="font-size: 12px;">Admin</small>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="#">Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>


<style>
.navbar-admin {
    background-color: transparent;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    height: 64px;
}

.navbar-admin h5 {
    font-family: 'Afacad', sans-serif;
}

.dropdown-menu {
    font-size: 14px;
}
</style>