@extends($user->role === 'student' ? 'layouts.master' : 'layouts.master-tutor')

@section('hide_footer')
@endsection

@if($user->role === 'lecturer')
    @section('hide_sidebar')
    @endsection
@endif

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-4" style="margin-bottom: 75px;">
    <div class="d-flex justify-content-center align-items-center px-5 gap-5 w-100 pt-1">
        <form class="d-flex w-100" method="GET" action="#">
            <div class="position-relative w-100">
           
                <input 
                    class="form-control form-search" 
                    type="text" 
                    placeholder="Mau belajar apa hari ini?" 
                    aria-label="Search" 
                    name="query"
                    value="{{ request('query') }}"
                >

                <button 
                    type="submit" 
                    class="icon-search btn position-absolute end-0 top-50 translate-middle-y p-0 border-0 bg-transparent"
                    style="z-index: 2;"
                >
                    <img src="{{ asset('assets/icons/icon_search.svg') }}" alt="Search" style="width: 24px; height: 24px;">
                </button>
            </div>
        </form>
        <div class="d-flex flex-row justify-content-center align-items-center gap-5">
            <a href="#">
                <img src="{{ asset('assets/icons/icon_bookmark.svg') }}" alt="Bookmark" style="width: 24px; height: 24px;">
            </a>
            <a href="#">
                <img src="{{ asset('assets/icons/icon_notif.svg') }}" alt="Notification" style="width: 24px; height: 24px;">
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            @include('forum.components.sidebar-left-forum')
        </div>

        <!-- Form Side -->
        <div class="col d-flex flex-column align-items-center gap-2 w-100">
            <div class="feed-wrapper d-flex flex-column gap-2 w-100">
                <div class="profile-banner-card d-flex flex-row gap-2">
                     <div class="navigation-prev d-flex flex-start pb-4">
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
                            <div class="profile-detail-membership-container">
                                <p class="profile-detail-membership">Membership Creative Studio</p>

                            </div>

                        </div>

                    </div>
                </div>

                @include('profile.components.tab', ['firstTab' => 'portfolio', 'secondTab' => 'post', 'activeTab' => $activeTab])

                <div class="tab-content-container">
                    <div class="tab-content {{ $activeTab == 'portfolio' ? 'active' : '' }}" data-tab-content="portfolio">
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
        background: #E7F6FE;

    }

    .profile-detail-membership{
        margin: 0;
        background: var(--blue-gradient-color);
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