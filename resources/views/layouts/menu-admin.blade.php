<div class="sidebar-admin d-flex flex-column justify-content-between p-3">
    <div>
        <div class="d-flex justify-content-end mb-3">
            <i class="fa-solid fa-bars text-dark fs-5"></i>
        </div>

        <ul class="nav flex-column gap-3">
            <li class="nav-item">
                <a href="#" class="nav-link-admin active">
                    <i class="fa-solid fa-table-cells-large me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-admin">
                    <i class="fa-solid fa-user-group me-2"></i>
                    Daftar Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-admin">
                    <i class="fa-solid fa-book-open me-2"></i>
                    Manajemen Kursus
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-admin">
                    <i class="fa-solid fa-calendar-days me-2"></i>
                    Manajemen Event
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-admin">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    Laporan Forum
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-admin">
                    <i class="fa-regular fa-user me-2"></i>
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
