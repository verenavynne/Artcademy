@extends('layouts.master')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-4" style="margin-bottom: 75px;">

    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-between" style="width: 100%; ">
        <div style="width: 20%">
            @include('profile.components.sidebar-profile')

        </div>

        <div class="d-flex flex-column" style="width: 75%; gap: 32px">
            <div class="profile-banner-card d-flex flex-row justify-content-between">
                <div class="profile-banner-info justify-content-center align-items-center d-flex flex-row gap-5">
                    <div class="profile-image">
                        <img src="{{ asset('assets/default-profile.jpg') }}"
                        class="profile-picture rounded-circle object-fit"
                        alt="" width="120" height="120">

                        <button class="edit-profile-btn">
                            <img src="{{ asset('assets/icons/icon_edit.svg') }}" alt="" width="16" height="16">
                        </button>

                    </div>
                    <div class="profile-detail-info d-flex flex-column gap-2">
                        <p class="profile-detail-name">{{ $user->name }}</p>
                        <div class="profile-detail-membership-container">
                            <p class="profile-detail-membership">Membership Creative Studio</p>

                        </div>

                    </div>

                </div>
                <div class="profile-logout d-flex flex-row gap-2 align-items-start justify-content-center">
                    <img src="{{ asset('assets/icons/icon_logout.svg') }}" alt="">
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-text" style="">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

            @include('profile.components.tab', ['firstTab' => 'Portfolio', 'secondTab' => 'Post'])
            <div class="tab-content-container">
                <div class="tab-content active" data-tab-content="portfolio">
                    <div class="portfolio-section-container justify-content-center align-items-center gap-4">
                        @foreach($portfolios as $portfolio)
                            <div class="portfolio-card d-flex flex-column justify-content-center align-items-center position-relative" 
                                data-portfolio-id="{{ $portfolio->id }}">

                                <div class="dropdown position-absolute top-0 end-0 m-3">
                                    <button class="btn btn-link text-dark p-0" type="button" id="dropdownMenu{{ $portfolio->id }}"
                                        data-bs-toggle="dropdown" aria-expanded="false"
                                        onclick="event.stopPropagation()">
                                        <iconify-icon icon="qlementine-icons:menu-dots-16"></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $portfolio->id }}">
                                        <li>
                                            <a href="{{ route('portfolio.edit', $portfolio->id) }}">
                                                <button type="button" class="dropdown-item">Edit</button>
                                            </a>
                                        </li>
                                        <li>
                                            <button 
                                                type="button" 
                                                class="dropdown-item text-danger"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteConfirmModal{{ $portfolio->id }}"
                                                onclick="event.stopPropagation()">
                                                Hapus
                                            </button>
                                        </li>
                                    </ul>
                                </div>


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
        
                        @if($portfolios->isEmpty())
                            <p class="text-muted text-center">Belum ada portofolio.</p>
                        @endif
                    </div>

                </div>

                  <div class="tab-content" data-tab-content="post">
                    <div class="d-flex flex-column align-items-center gap-3">
                        
                        <p class="text-muted text-center">Belum ada postingan.</p>
                    </div>
                </div>
            </div>


        </div>
       
    </div>

    <a href="{{ route('add-portfolio') }}"
        class="btn yellow-gradient-btn position-fixed bottom-0 end-0 m-4 shadow">
        <iconify-icon icon="ic:round-plus"></iconify-icon>
        Tambah Portofolio
    </a>

    <!-- Pop up each porto -->
    @include('profile.components.portfolio-popup')  
    
    <!-- Pop up konfirmasi delete -->
    @foreach ($portfolios as $portfolio)
     
        <div class="modal fade" id="deleteConfirmModal{{ $portfolio->id }}" tabindex="-1" aria-labelledby="deleteConfirmModalLabel{{ $portfolio->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content d-flex justify-content-center flex-column text-center p-4" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
                
                <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                
                <!-- <img src="{{ asset('assets/course/zoom_berhasil_daftar.png') }}" alt="Berhasil dikumpulkan" class="mb-3" width="80" style="align-self: center"> -->
                
                <h5 class="fw-bold mb-2" style="font-size: var(--font-size-title)">Konfirmasi Hapus</h5>
                <p class="mb-4" style="margin: 0; font-size: var(--font-size-primary); color: var(--dark-gray-color)">
                    Yakin ingin hapus portofolio <span class="fw-bold">{{ $portfolio->portfolioName }}</span> ?
                </p>

                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">Hapus</button>
                    </form>
                </div>
                
            </div>
        </div>

    @endforeach

    
    
</div>

<style>

    .portfolio-card .dropdown button {
        color: var(--black-color);
        border: none;
        background: none;
    }

    .portfolio-card .dropdown button:hover {
        opacity: 0.7;
    }

    .portfolio-card .dropdown-menu{
        border-radius: 10px;
        background: white;
        border: none;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
    }
    
    .dropdown-item{
        font-size: 16px;

    }

    .modal {
        z-index: 2000 !important;
    }

    .modal-backdrop.show {
        z-index: 1500 !important;
    }

    .modal-content {
        position: relative;
        z-index: 2001;
    }

    .modal video,
    .modal img {
        position: relative;
        z-index: 1;
        pointer-events: auto;
    }

    .btn-close {
        z-index: 2100;
        position: absolute;
        top: 20px;
        right: 20px;
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

    .edit-profile-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 40px;
        height: 40px;
        border: none;
        cursor: pointer;
        background: linear-gradient(180deg, #FFDE22 0%, #F4A700 100%);
        border-radius: 50rem;
        box-shadow: 0px 4px 8px 0px var(--brown-shadow-color);
        transition: all 0.3s ease;
        
    }

    .edit-profile-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(0,0,0,0.25);
    }

    .profile-detail-name{
        font-size: 24px;
        color: var(--black-color);
        font-weight: 600;
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

    .logout-text{
        margin: 0;
        color: #FF2424;
        font-size: var(--font-size-primary);
        font-weight: 700;
        text-decoration: none;
        background:none; 
        border:none; 
        padding:0;
        cursor:pointer;
    }

    .portfolio-section-container{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        justify-items: center;

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

    .yellow-gradient-btn{
        display: flex;
        justify-content: center;
        align-items:center;
        padding: 10px 20px;

    }

    .tab-content-container {
        width: 100%;
        position: relative;
    }

    .tab-content {
        display: none;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .tab-content.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }


</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tabLinks = document.querySelectorAll(".tab-link");
    const tabContents = document.querySelectorAll(".tab-content");

    tabLinks.forEach(btn => {
        btn.addEventListener("click", () => {
            const target = btn.getAttribute("data-tab");

            tabLinks.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            tabContents.forEach(content => {
                if (content.getAttribute("data-tab-content") === target) {
                    content.classList.add("active");
                } else {
                    content.classList.remove("active");
                }
            });
        });
    });


    // Atur warna portofolio card
    const colors = ['#F9EEDB', '#FFE9E2'];
    const columns = 2; 

    document.querySelectorAll('.portfolio-card').forEach((card, index) => {
        const row = Math.floor(index / columns);
        const col = index % columns;
        const colorIndex = (row + col) % 2; 
        card.style.backgroundColor = colors[colorIndex];
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
});
</script>


@endsection



