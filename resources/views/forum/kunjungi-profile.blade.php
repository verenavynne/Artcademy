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
    <div class="d-flex justify-content-center align-items-center px-5 gap-5 w-100 pt-1" style="margin-bottom: 18px">
        <div class="position-relative flex-grow-1">
            <input type="text" class="custom-input-2 form-control rounded-pill" placeholder="Mau belajar apa hari ini?">
            <iconify-icon icon="icon-park-outline:search" class="search-icon position-absolute">
            </iconify-icon>
        </div>

        @if($authUser->role === 'student')
            @include('components.notification-panel')
        @endif
       
    </div>
    <div class="row">
        <div class="col-3">
            @include('forum.components.sidebar-left-forum')
        </div>

        <!-- Form Side -->
        <div class="col-6 d-flex flex-column align-items-center gap-2">
            <div class="feed-wrapper d-flex flex-column gap-2 w-100">
                <div class="profile-banner-card d-flex flex-row gap-2">
                     <div class="navigation-prev d-flex flex-start">
                        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
                        </a>
                    </div>
                   
                    <div class="profile-banner-info justify-content-center align-items-center d-flex flex-row gap-4">
                        <div class="profile-image">
                            <img src="{{ $user->profilePicture ? asset('storage/' . $user->profilePicture) : asset('assets/default-profile.jpg') }}"
                            class="profile-picture rounded-circle object-fit"
                            alt="" width="120" height="120">

                        </div>
                        <div class="profile-detail-info d-flex flex-column gap-2">
                            <p class="profile-detail-name">{{ $user->name }}</p>
                            <p style="margin: 0">{{ $user->profession }}</p>
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
                                        'mediaPath' => asset('storage/' . $portfolio->portfolioPath),
                                        'portfolioId' => $portfolio->id,
                                        'mockupSize' => 230,
                                        'animation' => true
                                    ])
                                    <p>{{ $portfolio->portfolioName }}</p>
                                </div>
                            @endforeach
            
                        
                        </div>
                        @if($portfolios->isEmpty())
                            <div class="d-flex flex-column align-items-center gap-3" >
                                <p class="text-muted text-center">Belum ada portofolio</p>
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
                        <div class="d-flex flex-column align-items-center gap-3">
                            
                            <p class="text-muted text-center">Belum ada postingan.</p>
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
        padding: 4px 20px;
        justify-content: center;
        align-items: center;
        font-size: var(--font-size-primary);

    }

    .profile-detail-membership{
        margin: 0;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    .portfolio-section-container{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        justify-items: center;

    }

    .profile-post-content-container{
        .post-card{
            min-width: 690px;
            max-width: 690px

        }
    }

    .portfolio-card{
        padding-inline: 30px;
        padding-block: 40px;
        border-radius: 30px;
        width: 350px;
        height: 300px;
        cursor: pointer;
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

    })

</script>