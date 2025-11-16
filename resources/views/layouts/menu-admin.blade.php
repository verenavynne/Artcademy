<div class="sidebar-admin d-flex flex-column justify-content-between p-6" id="sidebarAdmin">
  <div>
    <!-- Burger Menu -->
    <div class="burger-wrapper">
      <iconify-icon 
        icon="majesticons:menu"
        id="burgerMenu"
        class="burgermenu-icon"
        style="align-item: center; font-size: 32px; color: var(--black-color); cursor: pointer;">
      </iconify-icon>
    </div>

    <!-- Sidebar Navigation -->
    <ul class="nav flex-column gap-2 sidebar-content">
      <li class="nav-item">
        <a href="{{ route('admin.home') }}" class="nav-link-admin {{ request()->routeIs('admin.home') ? 'active' : '' }}" style="gap: 12px">
          <iconify-icon 
            icon="mage:dashboard" 
            data-regular="mage:dashboard" 
            data-filled="mage:dashboard-fill"
            class="dashboard-icon">
          </iconify-icon>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.user.list') }}" class="nav-link-admin {{ request()->routeIs('admin.user.list') ? 'active' : '' }}" style="gap: 12px">
          <iconify-icon 
            icon="fluent:person-wrench-20-regular" 
            data-regular="fluent:person-wrench-20-regular" 
            data-filled="fluent:person-wrench-20-filled"
            class="daftarpengguna-icon">
          </iconify-icon>
          <span>Daftar Pengguna</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.courses.index') }}" class="nav-link-admin {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}" style="gap: 12px">
          <iconify-icon 
            icon="majesticons:book-plus-line" 
            data-regular="majesticons:book-plus-line" 
            data-filled="majesticons:book-plus"
            class="manajemenkursus-icon">
          </iconify-icon>
          <span>Manajemen Kursus</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.zoom.index') }}" class="nav-link-admin {{ request()->routeIs('admin.zoom.*') ? 'active' : '' }}" style="gap: 12px">
          <iconify-icon 
            icon="streamline-plump:webcam-video-remix" 
            data-regular="streamline-plump:webcam-video-remix" 
            data-filled="streamline-plump:webcam-video-solid"
            class="manajemen-icon">
          </iconify-icon>
          <span>Manajemen Zoom</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link-admin" style="gap: 12px">
          <iconify-icon 
            icon="material-symbols:edit-calendar-outline-rounded" 
            data-regular="material-symbols:edit-calendar-outline-rounded" 
            data-filled="material-symbols:edit-calendar-rounded"
            class="manajemenevent-icon">
          </iconify-icon>
          <span>Manajemen Event</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link-admin" style="gap: 12px">
          <iconify-icon 
            icon="ic:round-warning-amber" 
            data-regular="ic:round-warning-amber" 
            data-filled="ic:round-report-problem"
            class="laporanforum-icon">
          </iconify-icon>
          <span>Laporan Forum</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.profile') }}" class="nav-link-admin {{ request()->routeIs('admin.profile') ? 'active' : '' }}" style="gap: 12px">
          <iconify-icon 
            icon="fluent:person-12-regular" 
            data-regular="fluent:person-12-regular" 
            data-filled="fluent:person-12-filled"
            class="profilsaya-icon">
          </iconify-icon>
          <span>Profil Saya</span>
        </a>
      </li>
    </ul>
  </div>
</div>



<style>
.sidebar-admin {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  width: 300px;
  height: 100%;
  padding: 25px;
  background: var(--white, #FFF);
  box-shadow: 0 4px 8px rgba(67, 39, 0, 0.20);
  border-radius: 20px;
  overflow: visible; /* biar burger tetap kelihatan */
  transition: width 0.4s ease, padding 0.4s ease, border-radius 0.4s ease, box-shadow 0.4s ease;
}

/* Tombol Burger */
.burger-wrapper {
  position: absolute;
  top: 20px;
  right: 20px;
  z-index: 10;
  transition: all 0.3s ease-in-out;
}

/* Sidebar Close Mode */
.sidebar-admin.closed {
  width: 80px;
  padding: 25px 0;
  align-items: center;
}

.sidebar-admin.closed .burger-wrapper {
  top: 20px;
  right: auto;
  left: 50%;
  transform: translateX(-50%);
}

@media (max-width: 992px) {
    .sidebar-admin {
      width: 100%;
      border-radius: 0;
      box-shadow: none;
    }
}

/* Isi Sidebar */
.sidebar-content {
  margin-top: 36px;
  transition: opacity 0.3s ease 0.3s;
}

.sidebar-admin.closed .sidebar-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 28px;
}

.sidebar-admin.closed .nav-link-admin span {
  display: none;
  padding: 0px 52px 0px 0px;
  opacity: 0;
  transform: translateX(-10px);
  transition: opacity 0.3s ease, transform 0.3s ease;
}

.sidebar-admin:not(.closed) .nav-link-admin span {
  opacity: 1;
  transform: translateX(0);
  transition: opacity 0.3s ease 0.3s, transform 0.3s ease 0.3s;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.nav-link-admin {
  transition: background-color 0.25s ease, gap 0.3s ease, transform 0.3s ease;
}

.sidebar-admin.closed .nav-link-admin {
  width: 50px;
  height: 50px;
  margin: 0 auto;
  padding: 0;
  border-radius: 12px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0;
  transition: all 0.3s ease;
}

.sidebar-admin.closed .nav-item {
  width: 100%;
  display: flex;
  justify-content: center;
}


.sidebar-admin.closed .nav-link-admin iconify-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 26px;
}

</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const navLinks = document.querySelectorAll(".nav-link-admin");
  const burgerMenu = document.getElementById('burgerMenu');
  const sidebarAdmin = document.getElementById('sidebarAdmin');

  navLinks.forEach(link => {
    const icon = link.querySelector("iconify-icon");
    if(link.classList.contains("active")) {
      if(icon) icon.setAttribute("icon", icon.getAttribute("data-filled"));
    } else {
      if(icon) icon.setAttribute("icon", icon.getAttribute("data-regular"));
    }

    link.addEventListener("click", function() {
      navLinks.forEach(l => {
        l.classList.remove("active");
        const iconL = l.querySelector("iconify-icon");
        if(iconL) iconL.setAttribute("icon", iconL.getAttribute("data-regular"));
      });
      this.classList.add("active");
      const thisIcon = this.querySelector("iconify-icon");
      if(thisIcon) thisIcon.setAttribute("icon", thisIcon.getAttribute("data-filled"));
    });
  });

  const sidebarState = localStorage.getItem("sidebarClosed");
  if(sidebarState === "true") {
    sidebarAdmin.classList.add("closed");
  }

  burgerMenu.addEventListener("click", () => {
    sidebarAdmin.classList.toggle("closed");
    localStorage.setItem("sidebarClosed", sidebarAdmin.classList.contains("closed"));
  });
});
</script>


<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
