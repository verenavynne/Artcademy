@extends(Auth::user()->role === 'student' ? 'layouts.master' : 'layouts.master-tutor')

@section('hide_footer')
@endsection

@if($authUser->role === 'lecturer')
    @section('hide_sidebar')
    @endsection
@endif

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="width: 100%; margin-bottom: 75px;">
    <div class="d-flex justify-content-center align-items-center gap-4 w-100 pt-1" style="margin-bottom: 18px">
        <div class="position-relative flex-grow-1">
            <form class="d-flex w-100" method="GET" action="{{ route('forum') }}" style="margin-block-end: 0">
                <input 
                    type="text" 
                    class="custom-input-2 form-control rounded-pill" 
                    placeholder="Cari post apa hari ini?"
                    name="query"
                    value="{{ request('query') }}"
                >
    
                <button 
                    type="submit"
                    class="btn position-absolute end-0 top-50 p-0 pe-4 border-0 bg-transparent"
                    style="z-index: 5;"
                >
                    <iconify-icon 
                        icon="icon-park-outline:search" 
                        class="search-icon"
                        style="font-size: 22px;"
                    ></iconify-icon>
                </button>
            </form>
        </div>
       
    </div>
    <div class="row">
        <div class="col-3">
            @include('forum.components.sidebar-left-forum' ,['user' => $authUser])
        </div>

        <!-- Form Side -->
        <div class="col-6 d-flex flex-column align-items-center gap-2">
            <div class="feed-wrapper d-flex flex-column gap-4 w-100">
                <div class="profile-banner-card d-flex flex-row gap-2">
                    <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                        <div class="navigation-prev d-flex flex-start">
                            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
                        </div>
                    </a>
                    <div class="profile-banner-info justify-content-center align-items-center d-flex flex-row gap-4">
                        <div class="profile-image">
                            <img src="{{ $selectedUser->profilePicture ? Storage::disk('s3')->temporaryUrl($selectedUser->profilePicture, now()->addDay()) : asset('assets/default-profile.jpg') }}"
                            class="profile-picture rounded-circle object-fit"
                            alt="" width="120" height="120">

                        </div>
                        <div class="profile-detail-info d-flex flex-column gap-2">
                            <p class="profile-detail-name">{{ $selectedUser->name }}</p>
                            <p style="margin: 0">{{ $selectedUser->profession }}</p>
                            @php
                                $membershipName = $selectedUserMembershipTransaction->membership->membershipName ?? null;
                                $specialization = $selectedUser->lecturer->specialization ?? null;

                                if( ($selectedUserMembershipStatus === 'active' && $membershipName === 'Basic Canvas') || 
                                    ($selectedUser->role === 'lecturer' && $specialization === 'Seni Lukis & Digital Art')) {
                                    $bgColor = '#FFF4E0';
                                    $textColor = 'var(--orange-gradient-color)';
                                } elseif( ($selectedUserMembershipStatus === 'active' && $membershipName === 'Masterpiece Pro') || 
                                    ($selectedUser->role === 'lecturer' && $specialization === 'Seni Tari')) {
                                    $bgColor = '#FFEAF0';
                                    $textColor = 'var(--pink-gradient-color)';
                                } elseif($selectedUser->role === 'lecturer' && $specialization === 'Seni Musik') {
                                    $bgColor = '#fffdeaff';
                                    $textColor = 'var(--yellow-gradient-color)';
                                } elseif( ($selectedUserMembershipStatus === 'active'&& $membershipName === 'Creative Studio') || 
                                    ($selectedUser->role === 'lecturer' && $specialization === 'Seni Fotografi')) {
                                    $bgColor = '#E7F6FE';
                                    $textColor = 'var(--blue-gradient-color)';
                                } else {
                                    $bgColor = '#D9D9D9';
                                    $textColor = '#6c757d';
                                }
                            @endphp
                            <div class="profile-detail-membership-container" style="background: {{ $bgColor }}; padding: 4px 20px">
                                <p class="profile-detail-membership" style="background: {{ $textColor }}; background-clip: text;">
                                    @if ($selectedUser->role === 'student')
                                        {{ $selectedUserMembershipStatus === 'active' ? 'Membership ' . $selectedUserMembershipTransaction->membership->membershipName : 'Belum Berlangganan' }}
                                    @else
                                        Tutor {{ $selectedUser->lecturer->specialization ?? '-' }}
                                    @endif
                                </p>
                            </div>

                        </div>

                    </div>
                </div>

                @include('profile.components.tab', ['firstTab' => 'portofolio', 'secondTab' => 'post', 'activeTab' => $activeTab])

                <div class="tab-content-container">
                    <div class="tab-content {{ $activeTab == 'portofolio' ? 'active' : '' }}" data-tab-content="portofolio">
                        <div class="portfolio-section-container justify-content-center align-items-center gap-4">
                            @foreach($portfolios as $portfolio)
                                <div class="portfolio-card d-flex flex-column justify-content-center align-items-center"
                                 data-portfolio-id="{{ $portfolio->id }}">

                                    @include('profile.components.portfolio-mockup', [
                                        'mockupType' => $portfolio->mockupType,
                                        'portoType' => Str::endsWith($portfolio->portfolioPath, '.mp4') ? 'video' : 'image',
                                        'mediaPath' => storage::disk('s3')->temporaryUrl($portfolio->portfolioPath, now()->addDay()),
                                        'portfolioId' => $portfolio->id,
                                        'mockupSize' => 230,
                                        'animation' => true
                                    ])
                                    <p>{{ $portfolio->portfolioName }}</p>
                                </div>
                            @endforeach
            
                        
                        </div>
                        @if($portfolios->isEmpty())
                            <div class="d-flex flex-column align-items-center gap-4" style="margin-top: 70px;">
                                <img src="{{ asset('assets/course/empty.svg') }}" alt="" style="width: 100px">
                                <div>
                                    <h3 class="text-center fw-semibold" style="font-size: 20px; color: var(--black-color)">Portofolio masih kosong!</h3>
                                    <p class="text-center" style="font-size: 18px; color: var(--dark-gray-color)">Pengguna ini sedang menyiapkan karya terbaiknya</p>
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="tab-content {{ $activeTab == 'post' ? 'active' : '' }}" data-tab-content="post">
                        <div class="profile-post-content-container d-flex flex-column align-items-center gap-2 w-100">
                            @foreach($posts as $post)
                                @include('forum.components.post-card',['post'=>$post])
                            @endforeach
                        </div>

                        @if ($posts->isEmpty())
                            <div class="d-flex flex-column align-items-center gap-4" style="margin-top: 70px;">
                                <img src="{{ asset('assets/course/empty.svg') }}" alt="" style="width: 100px">
                                <div>
                                    <h3 class="text-center fw-semibold" style="font-size: 20px; color: var(--black-color)">Masih sepi di sini</h3>
                                    <p class="text-center" style="font-size: 18px; color: var(--dark-gray-color)">Belum ada postingan dari pengguna ini</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
            </div>                             
        
        </div>

        <!-- Side Bar kanan -->
        <div class="col-3">
            @include('forum.components.sidebar-right-forum')
        
        </div>
    </div>

    <!-- Pop up each porto -->
    @include('profile.components.portfolio-popup')  
    
</div>

<style>

    #tutor-wrapper{
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .row {
        --bs-gutter-x: 1.5rem !important;
        gap: unset !important;
        flex-wrap: wrap !important;
    }
    .profile-banner-card{
        height: max-content;
        width: 100%;
        padding-inline: 34px;
        padding-block: 28px;
        border-radius: 24px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);

    }

    .profile-detail-name{
        margin: 0;
        font-size: 24px;
        color: var(--black-color);
        font-weight: 600;
    }

    .profile-image {
        position: relative;
        width: 120px;
        height: 120px;
    }

    .profile-image .profile-picture {
        border-radius: 50%;
        object-fit: cover;
        width: 100%;
        height: 100%;
        border: 3px solid #f8f8f8;
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

    .portfolio-section-container{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        justify-items: center;

    }

    .profile-post-content-container{
        .post-card{
            width: 100%;
            max-width: 690px;
            max-width: 690px

        }
    }

    .portfolio-card{
        padding-inline: 30px;
        padding-block: 40px;
        border-radius: 30px;
        width: 100%;
        height: 300px;
        cursor: pointer;
        aspect-ratio: 7 / 6;
    }

    .portfolio-card p{
        margin: 0;
        color: var(--black-color);
        font-size: var(--font-size-primary);
        font-weight: 700;
    }
</style>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
         // Atur warna portofolio card
        const colors = ['#F9EEDB', '#FFE9E2'];
        const columns = 2; 

        document.querySelectorAll('.portfolio-card').forEach((card, index) => {
            const row = Math.floor(index / columns);
            const col = index % columns;
            const colorIndex = (row + col) % 2; 
            card.style.backgroundColor = colors[colorIndex];
        });

        // Change content based on clicked tab
        const activeTab = "{{ $activeTab }}"; 

        const tabLinks = document.querySelectorAll(".tab-link");
        const tabContents = document.querySelectorAll(".tab-content");

        tabLinks.forEach(link => {
            link.classList.toggle("active", link.getAttribute("data-tab") === activeTab);
        });

        tabContents.forEach(content => {
            content.classList.toggle("active", content.getAttribute("data-tab-content") === activeTab);
        });

        tabLinks.forEach(link => {
            link.addEventListener("click", () => {
                const target = link.getAttribute("data-tab");

                tabLinks.forEach(l => l.classList.remove("active"));
                link.classList.add("active");

                tabContents.forEach(content => {
                    content.classList.toggle("active", content.getAttribute("data-tab-content") === target);
                });
            });
        });

        document.querySelectorAll(".portfolio-card").forEach(card => {
            card.addEventListener("click", function (e) {
                const dropdown = e.target.closest(".dropdown");
                if (!dropdown) {
                    const portfolioId = this.getAttribute("data-portfolio-id");
                    const modal = document.querySelector(`#portoModal${portfolioId}`);
                    const bootstrapModal = new bootstrap.Modal(modal);
                    bootstrapModal.show();
                }
            });
        });

        // Toggle comment post
    document.querySelectorAll('.comment-toggle').forEach(btn => {
            const target = document.querySelector(btn.dataset.target);
            const iconHolder = btn.querySelector('.icon-holder');

            const defaultIcon = btn.dataset.defaultIcon;
            const activeIcon  = btn.dataset.activeIcon;

            btn.addEventListener('click', () => {
                const isOpen = target.style.display === 'block';

                target.style.display = isOpen ? 'none' : 'block';

                iconHolder.innerHTML = isOpen
                    ? `<iconify-icon icon="${defaultIcon}" style="font-size:20px"></iconify-icon>`
                    : `<img src="${activeIcon}" height="20" width="20">`;
            });
        });

        document.querySelectorAll('.reply-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = document.querySelector(btn.dataset.target);
                if (!target) return;

                const isOpen = target.style.display === "block";
                target.style.display = isOpen ? "none" : "block";

                btn.classList.toggle('active', !isOpen);

                const iconHolder = btn.querySelector('.icon-holder');
                const defaultIcon = btn.dataset.defaultIcon;
                const activeIcon = btn.dataset.activeIcon;

                if (!isOpen) {
                    iconHolder.innerHTML = `
                        <img src="${activeIcon}" height="20" width="20">
                    `;
                } else {
                    
                    iconHolder.innerHTML = `
                        <iconify-icon icon="${defaultIcon}" style="font-size: 20px"></iconify-icon>
                    `;
                }
                
            });
        });

    })

</script>