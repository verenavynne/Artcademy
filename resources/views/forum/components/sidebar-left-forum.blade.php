<div class="sidebar-left d-flex flex-column justify-content-between align-content-center">
    <div class="d-flex align-items-start flex-column">
        <div class="profile-box justify-content-center align-items-center d-flex flex-row gap-2">
            <img src="{{  $user->profilePicture ? asset('storage/' . $user->profilePicture) : asset('assets/default-profile.jpg') }}" 
            class="profile-picture rounded-circle"
            alt="" width="74" height="74" style="object-fit: cover">
            <div class="col">
                <p class="fw-bold " style="font-size: var(--font-size-primary); margin:0">{{ $user->name }}</p>
                <p class="pb-2" style="font-size: 12px; margin: 0">{{ $user->profession }}</p>
                @php
                    $membershipName = $membershipTransaction->membership->membershipName ?? null;
                    $specialization = $user->lecturer->specialization ?? null;

                    if( ($membershipStatus === 'active' && $membershipName === 'Basic Canvas') || 
                        ($user->role === 'lecturer' && $specialization === 'Seni Lukis & Digital Art')) {
                        $bgColor = '#FFF4E0';
                        $textColor = 'var(--orange-gradient-color)';
                    } elseif( ($membershipStatus === 'active' && $membershipName === 'Masterpiece Pro') || 
                        ($user->role === 'lecturer' && $specialization === 'Seni Tari')) {
                        $bgColor = '#FFEAF0';
                        $textColor = 'var(--pink-gradient-color)';
                    } elseif($user->role === 'lecturer' && $specialization === 'Seni Musik') {
                        $bgColor = '#fffdeaff';
                        $textColor = 'var(--yellow-gradient-color)';
                    } elseif( ($membershipStatus === 'active'&& $membershipName === 'Creative Studio') || 
                        ($user->role === 'lecturer' && $specialization === 'Seni Fotografi')) {
                        $bgColor = '#E7F6FE';
                        $textColor = 'var(--blue-gradient-color)';
                    } else {
                        $bgColor = '#D9D9D9';
                        $textColor = '#6c757d';
                    }
                @endphp
                <div class="profile-detail-membership-container" style="background: {{ $bgColor }};">
                    <p class="profile-detail-membership" style="background: {{ $textColor }}; background-clip: text;">
                        @if ($user->role === 'student')
                            {{ $membershipStatus === 'active' ? 'Membership ' . $membershipTransaction->membership->membershipName : 'Belum Berlangganan' }}
                        @else
                            Tutor {{ $user->lecturer->specialization ?? '-' }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <hr class="divider w-100">
        <ul class="nav flex-column sidebar-content w-100">
            <li class="nav-item">
                <a href="{{ route('forum') }}" class="nav-link-profile active" style="gap: 12px">
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
                <a href="{{ route('my-profile', ['tab'=>'post']) }}" class="nav-link-profile" style="gap: 12px">
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
                <a href="{{ route('my-profile') }}" class="nav-link-profile" style="gap: 12px">
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

    <a href="{{ route('forum') }}" data-target="buat-post" class="btn py-3 px-4 w-100 text-dark yellow-gradient-btn
            d-flex flex-row justify-content-center align-items-center gap-2">
        <iconify-icon icon="ic:round-plus"></iconify-icon>
        <p style="margin: 0; font-size: var(--font-size-primary)">Buat Post</p>
    </a>
    
</div>

<style>
 
    .divider{
        margin-block: 22px;
    }
    
    .sidebar-left{
        position: sticky;
        top: 91px;
        padding: 25px;
        justify-content: center;
        border-radius: 20px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        min-height: 500px;
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

    }

    .profile-detail-membership{
        font-size: 14px;
        margin: 0;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
        
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

        const buatPostButton = document.querySelector('[data-target="buat-post"]');
    
        if (buatPostButton) {
            buatPostButton.addEventListener("click", () => {
                const target = document.getElementById("buat-post");
                if (target) {
                    target.scrollIntoView({ behavior: "smooth", block: "start" });
                }
            });
        }

    });


</script>