<div class="sidebar-admin d-flex flex-column justify-content-between p-6">
    <div>
        <div class="d-flex justify-content-end mb-3">
            <i class="fa-solid fa-bars text-dark fs-5"></i>
        </div>

        <ul class="nav flex-column gap-3">
            <li class="nav-item">
                <a href="#" class="nav-link-admin active">
                    <iconify-icon icon="mage:dashboard-fill" class="dashboard-icon me-2"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-admin">
                    <iconify-icon icon="fluent:person-wrench-20-regular" class="daftarpengguna-icon me-2"></iconify-icon>
                    Daftar Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-admin">
                    <iconify-icon icon="majesticons:book-plus-line" class="manajemenkursus-icon me-2"></iconify-icon>
                    Manajemen Kursus
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-admin">
                    <iconify-icon icon="material-symbols:edit-calendar-outline-rounded" class="manajemenevent-icon me-2"></iconify-icon>
                    Manajemen Event
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-admin">
                    <iconify-icon icon="ic:round-warning-amber" class="laporanforum-icon me-2"></iconify-icon>
                    Laporan Forum
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-admin">
                    <iconify-icon icon="fluent:person-12-regular" class="profilsaya-icon me-2"></iconify-icon>
                    Profil Saya
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
.sidebar-admin {
    display: flex;
    width: auto;
    height: 661px;
    padding: 28px 25px 25px 25px;
    justify-content: center;
    align-items: flex-start;
    gap: 10px;
    border-radius: 20px;
    background: var(--white, #FFF);
    box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
    min-height: calc(100vh - 48px);
    height: auto;
    display: flex;
    flex-direction: column;
}


.sidebar-admin i {
    font-size: 18px;
    min-width: 20px;
}


@media (max-width: 992px) {
    .sidebar-admin {
        width: 100%;
        height: auto;
        position: relative;
        border-radius: 0;
        box-shadow: none;
    }
}
</style>
