<div class="sidebar-profile d-flex flex-column justify-content-between p-6" id="sidebarProfile">

    <!-- Sidebar Navigation -->
    <ul class="nav flex-column gap-2 sidebar-content">
        <li class="nav-item">
            <a href="{{ route('my-profile') }}" class="nav-link-profile {{ request()->routeIs('my-profile') ? 'active' : '' }}" style="gap: 12px">
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
            <a href="{{ route('profile.courses') }}" class="nav-link-profile {{ request()->routeIs('profile.courses') ? 'active' : '' }}" style="gap: 12px">
            <iconify-icon 
                icon="mingcute:book-2-line" 
                data-regular="mingcute:book-2-line" 
                data-filled="mingcute:book-2-fill"
                class="kursussaya-icon">
            </iconify-icon>
            <span>Kursus Saya</span>
            </a>
        </li>
    
        <li class="nav-item">
            <a href="{{ route('profile.schedule') }}" class="nav-link-profile {{ request()->routeIs('profile.schedule') ? 'active' : '' }}" style="gap: 12px">
            <iconify-icon 
                icon="tabler:calendar-week-filled" 
                data-regular="tabler:calendar-week-filled" 
                data-filled="bxs:calendar"
                class="jadwalsaya-icon">
            </iconify-icon>
            <span>Jadwal Saya</span>
            </a>
        </li>
    
        <li class="nav-item">
            <a href="{{ route('profile.info') }}" class="nav-link-profile {{ request()->routeIs('profile.info') ? 'active' : '' }}"  style="gap: 12px">
            <iconify-icon 
                icon="fluent:notepad-person-16-regular" 
                data-regular="fluent:notepad-person-16-regular" 
                data-filled="fluent:notepad-person-16-filled"
                class="infopribadi-icon">
            </iconify-icon>
            <span>Info Pribadi</span>
            </a>
        </li>
    
        <li class="nav-item">
            <a href="{{ route('profile.history') }}" class="nav-link-profile {{ request()->routeIs('profile.history') ? 'active' : '' }}" style="gap: 12px">
            <iconify-icon 
                icon="uis:history" 
                data-regular="uis:history" 
                data-filled="uim:history"
                class="riwayattransaksi-icon">
            </iconify-icon>
            <span>Riwayat Transaksi</span>
            </a>
        </li>

    </ul>
 
</div>

<style>
    .sidebar-profile {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        height: max-content;
        padding: 25px;
        background: var(--white, #FFF);
        box-shadow: 0 4px 8px rgba(67, 39, 0, 0.20);
        border-radius: 20px;
        overflow: visible; 
        transition: width 0.4s ease, padding 0.4s ease, border-radius 0.4s ease, box-shadow 0.4s ease;
    }



    @media (max-width: 992px) {
        .sidebar-profile {
        width: 100%;
        border-radius: 0;
        box-shadow: none;
        }
    }

    /* Isi Sidebar */
    .sidebar-content {
        transition: opacity 0.3s ease 0.3s;
    }

    .nav-link-profile {
        transition: background-color 0.25s ease, gap 0.3s ease, transform 0.3s ease;
    }

    /* navbar admin */
    .nav-link-profile {
        color: var(--Dark-gray, #474747);
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
        font-size: 18px;
        font-weight: 500;
        display: flex;
        align-items: center;
        padding: 12px 12px 12px 12px; 
        border-radius: 10px;
        transition: all 0.25s ease-in-out;
        text-decoration: none !important;
        width: 100%;
    }

    .nav-link-profile::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 2.5px;
        width: 100%;
        font-weight: 700;
    }

    .nav-link-profile:hover {
        background-color: rgba(255, 221, 160, 0.25);
        color: #000;
        text-decoration: none !important;
        font-weight: 700;
    }

    .nav-link-profile:hover::after {
        transform: scaleX(1);
    }

    .nav-link-profile.active {
        font-weight: 600;
        color: #000;
    }

    .nav-link-profile.active::after {
        transform: scaleX(1);
    }

</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll(".nav-link-profile");
    
        navLinks.forEach(link => {
            const icon = link.querySelector("iconify-icon");
            if (!icon) return;

            const filledIcon = icon.getAttribute("data-filled");
            const regularIcon = icon.getAttribute("data-regular");
            
            if (link.classList.contains("active")) {
                icon.setAttribute("icon", filledIcon);
            } else {
                icon.setAttribute("icon", regularIcon);
            }
        });
    });
</script>