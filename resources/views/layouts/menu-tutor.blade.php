<div class="sidebar-tutor d-flex flex-column justify-content-between p-6" id="sidebarTutor">
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
        <a href="{{ route('lecturer.home') }}" class="nav-link-tutor {{ request()->routeIs('lecturer.home') ? 'active' : '' }}" style="gap: 12px">
          <iconify-icon 
            icon="mage:dashboard-fill" 
            data-regular="mage:dashboard" 
            data-filled="mage:dashboard-fill"
            class="dashboard-icon">
          </iconify-icon>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{#}" class="nav-link-tutor" style="gap: 12px">
          <iconify-icon 
            icon="majesticons:book-plus-line" 
            data-regular="majesticons:book-plus-line" 
            data-filled="majesticons:book-plus"
            class="kursussaya-icon">
          </iconify-icon>
          <span>Kursus Saya</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('lecturer.nilai-projek') }}" class="nav-link-tutor {{ request()->routeIs('lecturer.nilai-projek') ? 'active' : '' }}" style="gap: 12px">
          <iconify-icon 
            icon="iconamoon:file-document" 
            data-regular="iconamoon:file-document" 
            data-filled="majesticons:book-plus"
            class="iconamoon:file-document-fill">
          </iconify-icon>
          <span>Nilai Projek</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('lecturer.jadwal-saya') }}" class="nav-link-tutor {{ request()->routeIs('lecturer.jadwal-saya') ? 'active' : '' }}" style="gap: 12px">
          <iconify-icon 
            icon="material-symbols:edit-calendar-outline-rounded" 
            data-regular="material-symbols:edit-calendar-outline-rounded" 
            data-filled="material-symbols:edit-calendar-rounded"
            class="jadwalsaya-icon">
          </iconify-icon>
          <span>Jadwal Saya</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link-tutor" style="gap: 12px">
          <iconify-icon 
            icon="iconamoon:comment-dots" 
            data-regular="iconamoon:comment-dots" 
            data-filled="iconamoon:comment-dots"
            class="forum-icon">
          </iconify-icon>
          <span>Forum</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link-tutor" style="gap: 12px">
          <iconify-icon 
            icon="fluent:person-12-regular" 
            data-regular="fluent:person-12-regular" 
            data-filled="fluent:person-12-filled"
            class="profilsaya-icon">
          </iconify-icon>
          <span>Profil Saya</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('profile.info') }}" class="nav-link-tutor {{ request()->routeIs('profile.info') ? 'active' : '' }}" style="gap: 12px">
          <iconify-icon 
            icon="fluent:notepad-person-16-regular" 
            data-regular="fluent:notepad-person-16-regular" 
            data-filled="fluent:notepad-person-16-filled"
            class="infopribadi-icon">
          </iconify-icon>
          <span>Info Pribadi</span>
        </a>
      </li>

    </ul>
  </div>
</div>



<style>
.sidebar-tutor {
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
.sidebar-tutor.closed {
  width: 80px;
  padding: 25px 0;
  align-items: center;
}

.sidebar-tutor.closed .burger-wrapper {
  top: 20px;
  right: auto;
  left: 50%;
  transform: translateX(-50%);
}

@media (max-width: 992px) {
    .sidebar-tutor {
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

.sidebar-tutor.closed .sidebar-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 28px;
}

.sidebar-tutor.closed .nav-link-tutor span {
  display: none;
  padding: 0px 52px 0px 0px;
  opacity: 0;
  transform: translateX(-10px);
  transition: opacity 0.3s ease, transform 0.3s ease;
}

.sidebar-tutor:not(.closed) .nav-link-tutor span {
  opacity: 1;
  transform: translateX(0);
  transition: opacity 0.3s ease 0.3s, transform 0.3s ease 0.3s;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.nav-link-tutor {
  transition: background-color 0.25s ease, gap 0.3s ease, transform 0.3s ease;
}

.sidebar-tutor.closed .nav-link-tutor {
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

.sidebar-tutor.closed .nav-item {
  width: 100%;
  display: flex;
  justify-content: center;
}


.sidebar-tutor.closed .nav-link-tutor iconify-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 26px;
}

</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const navLinks = document.querySelectorAll(".nav-link-tutor");
  const burgerMenu = document.getElementById('burgerMenu');
  const sidebarTutor = document.getElementById('sidebarTutor');

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
    sidebarTutor.classList.add("closed");
  }

  burgerMenu.addEventListener("click", () => {
    sidebarTutor.classList.toggle("closed");
    localStorage.setItem("sidebarClosed", sidebarTutor.classList.contains("closed"));
  });
});
</script>


<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
