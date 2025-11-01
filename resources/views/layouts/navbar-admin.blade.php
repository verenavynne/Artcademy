<nav class="navbar-admin d-flex justify-content-between align-items-center px-4 py-3">
    <div class="d-flex align-items-center">
        <a href="">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="153px" height="38px">
        </a>
    </div>

    <div class="d-flex align-items-center gap-4">
        <button class="btn btn-link position-relative p-0">
           <iconify-icon icon="solar:bell-linear" class="notif-icon"></iconify-icon>
        </button>

        <div class="dropdown">
            <a class="profil d-flex align-items-center text-decoration-none text-dark " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('assets/default-profile.jpg') }}" class="rounded-circle" style="box-shadow: rgba(67, 39, 0, 0.2); object-fit: cover" alt="Profile Icon" width="54" height="54">

                <div class="d-flex flex-column text-start">
                    <span class="fw-medium" style= "font-size: 18px">Farren</span>
                    <small class="text-muted" style="font-size: 14px;">Admin</small>
                </div>
                <iconify-icon icon="mdi:chevron-down" class="dropdown-icon ms-2"></iconify-icon>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><a class="dropdown-item text-danger" href="#">Keluar</a></li>
            </ul>
        </div>
    </div>
</nav>


<style>
.navbar-admin {
    background-color: transparent;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    padding-top: 12px;
    padding-bottom: 12px;
    border-bottom: none;
}

.navbar-admin h5 {
    font-family: 'Afacad', sans-serif;
}

.notif-icon{
    color: #1B1B1B;
    display: flex;
    width: 57px;
    height: 56px;
    padding: 2px 3px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    border-radius: 100px;
    background: #FFF;
    transition: all 0.2s ease;

    /* drop shadow brown */
    box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
}

.notif-icon:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(67, 39, 0, 0.2);
}

.profil{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
}

.dropdown-icon {
  align-self: flex-start; /* ikon juga rata atas */
  margin-top: 4px; /* biar sejajar dengan teks nama */
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
    font-size: 14px;
}
</style>