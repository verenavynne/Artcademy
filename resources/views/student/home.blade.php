@extends('layouts.master')

@section('content')
<div class="container-fluid px-5">
    <!-- search bar -->
    <div class="d-flex align-items-center gap-4 w-100">
        <div class="position-relative flex-grow-1">
            <input type="text" class="custom-input-2 form-control rounded-pill" placeholder="Mau belajar apa hari ini?">
            <iconify-icon icon="icon-park-outline:search" class="search-icon position-absolute">
            </iconify-icon>
        </div>

        <div class="d-flex gap-4 fs-4">
            <iconify-icon icon="material-symbols:bookmark-outline-rounded"></iconify-icon>
            <iconify-icon icon="solar:bell-linear"></iconify-icon>
        </div>
    </div>

    <!-- header -->
    <div class="row align-items-start pt-2">
        <div class="col-md-7 pt-5">
            <h1 class="fw-bold pt-5 mt-3" style="font-size: 60px;">
                <span class="text-pink-gradient">Jelajahi Dunia Seni</span> <span class="text-dark">Tanpa Batas</span>
            </h1>

            <p class="text-secondary fs-5 pt-1">
                Saatnya upgrade skill dan tunjukin karya terbaikmu lewat portofolio yang kece. Terhubung bareng kreator sekreatif kamu, biar makin banyak inspirasi dan kolaborasi!
            </p>
            <div class="mt-4">
                <button class="btn px-4 py-2 yellow-gradient-btn text-dark">
                    Belajar Sekarang
                </button>
            </div>
        </div>

        <div class="col-md-5 d-flex justify-content-center pt-4" style="position: relative; z-index: 2">
            <img src="{{ asset('assets/home/top.png') }}" alt="Top Illustration" class="img-fluid" style="max-width: 597px;">
        </div>
    </div>
</div>

<!-- why -->
<div class="wave-top" style="margin-top: -200px; z-index: 1">
    <svg viewBox="0 0 1440 150" preserveAspectRatio="none" style="display: block; width: 100%; height: 150px;">
        <path d="M 0 0 C 360 150 1080 150 1440 0 L 1440 150 L 0 150 Z" fill="var(--orange-color)"></path>
    </svg>
</div>
<section class="why-artcademy">
    <div class="container text-center">
        <h2 class="fw-bold mb-2">Kenapa Artcademy?</h2>
        <p class="mb-5">Karena belajar seni harusnya fleksibel, seru, dan nggak sendirian</p>

        <div class="row text-center">
            <div class="col-md-3 p-4">
                <img src="{{ asset('assets/home/why-1.png') }}" class="mb-3" height="150px">
                <h5 class="fw-bold">Belajar Fleksibel Bersertifikat</h5>
                <p class="small">Akses berbagai kursus seni bersertifikat favorit kamu kapan aja dan di mana aja tanpa batas</p>
            </div>
            <div class="col-md-3 p-4 why-border-left why-border-right">
                <img src="{{ asset('assets/home/why-2.png') }}" class="mb-3" height="150px">
                <h5 class="fw-bold">Portofolio Keren</h5>
                <p class="small">Tunjukan karyamu kepada dunia dengan tampilan 3D Mockup yang super keren!</p>
            </div>
            <div class="col-md-3 p-4">
                <img src="{{ asset('assets/home/why-3.png') }}" class="mb-3" height="150px">
                <h5 class="fw-bold">Forum Kreatif</h5>
                <p class="small">Gabung forum kreatif, diskusi, sharing, dan dapet insight dari seniman lainnya!</p>
            </div>
            <div class="col-md-3 p-4 why-border-left">
                <img src="{{ asset('assets/home/why-4.png') }}" class="mb-3" height="150px">
                <h5 class="fw-bold">Event Seru Tiap Saat</h5>
                <p class="small">Dari webinar hingga workshop, buka peluang belajar dan kolaborasi baru.</p>
            </div>
        </div>
    </div>
</section>


<div class="wave-bottom">
    <svg viewBox="0 0 1440 150" preserveAspectRatio="none" style="display: block; width: 100%; height: 150px;">
        <path d="M0 150 C360 0 1080 0 1440 150 L1440 0 L0 0 Z" fill="var(--orange-color)"></path>
    </svg>
</div>

<a href="{{ route('logout') }}" class="nav-link mt-4"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<style>
    .search-icon {
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .why-artcademy {
        background: radial-gradient(circle at center,rgba(255, 210, 63, 1) 0%, var(--orange-color) 34%);
        padding: 40px 0;
        color: var(--brown-color);
        position: relative;
    }

    .why-border-left {
        border-left: 3px solid rgba(255, 190, 87, 1);
    }

    .why-border-right {
        border-right: 3px solid rgba(255, 210, 89, 1);
    }
</style>
@endsection
