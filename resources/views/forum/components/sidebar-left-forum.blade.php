<div class="sidebar-left position-fixed d-flex flex-column justify-content-between align-content-center">
    <div class="d-flex align-items-start flex-column">
        <div class="profile-box justify-content-center align-items-center d-flex flex-row gap-2">
            <img src="{{  $user->profilePicture ? asset('storage/' . $user->profilePicture) : asset('assets/default-profile.jpg') }}" 
            class="profile-picture rounded-circle"
            alt="" width="74" height="74" style="object-fit: cover">
            <div class="col">
                <p class="fw-bold " style="font-size: var(--font-size-primary); margin:0">{{ $user->name }}</p>
                <p class="pb-2" style="font-size: 12px; margin: 0">{{ $user->profession }}</p>
                <div class="profile-detail-membership-container">
                    <p class="profile-detail-membership">Membership Creative Studio</p>
                </div>
            </div>
        </div>
        <hr class="divider w-100">
        <ul class="nav flex-column sidebar-content w-100">
            <li class="nav-item">
                <a href="#" class="nav-link-profile active" style="gap: 12px">
                <iconify-icon 
                    icon="streamline-flex:home-2-remix" 
                    data-regular="streamline-flex:home-2-remix" 
                    data-filled="streamline-flex:home-2-solid"
                    class="feedutama-icon icon">
                </iconify-icon>
                <span>Feed Utama</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-profile" style="gap: 12px">
                <iconify-icon 
                    icon="mingcute:grid-2-line" 
                    data-regular="mingcute:grid-2-line" 
                    data-filled="mingcute:book-2-fill"
                    class="kursussaya-icon icon">
                </iconify-icon>
                <span>Postingan Saya</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link-profile" style="gap: 12px">
                <iconify-icon 
                    icon="mdi:file-document-box-outline" 
                    data-regular="mdi:file-document-box-outline" 
                    data-filled="mingcute:book-2-fill"
                    class="kursussaya-icon icon">
                </iconify-icon>
                <span>Portofolio Saya</span>
                </a>
            </li>
        </ul>
    </div>

    <button class="btn py-3 px-4 w-100 text-dark yellow-gradient-btn d-flex flex-row justify-content-center align-items-center gap-2">
        <iconify-icon icon="ic:round-plus"></iconify-icon>
        <p style="margin: 0; font-size: var(--font-size-primary)">Buat Post</p>
    </button>
    
</div>

<style>
 
    .divider{
        margin-block: 22px;
    }
    
    .sidebar-left{
        width: 22%;
        padding: 25px;
        justify-content: center;
        border-radius: 20px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        min-height: 600px;
    }

    

    .sidebar-content {
        transition: opacity 0.3s ease 0.3s;
    }

    .sidebar-content .icon{
        font-size: 24;
    }

    .profile-detail-membership-container{
        border-radius: 10px;
        display: flex;
        padding: 4px 10px;
        justify-content: center;
        align-items: center;
        font-size: var(--font-size-primary);
        background: #E7F6FE;

    }

    .profile-detail-membership{
        font-size: 14px;
        margin: 0;
        background: var(--blue-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        
    }

    .nav-link-profile {
        transition: background-color 0.25s ease, gap 0.3s ease, transform 0.3s ease;
    }


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