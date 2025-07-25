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
            <img src="{{ asset('assets/home/top.png') }}" alt="Top Illustration" class="img-fluid" style="max-width: 110%;">
        </div>
    </div>
</div>

<!-- why -->
<div class="wave-top" style="margin-top: -200px; z-index: 1">
    <svg viewBox="0 0 1440 150" preserveAspectRatio="none" style="display: block; width: 100%; height: 150px;">
        <path d="M 0 0 C 360 150 1080 150 1440 0 L 1440 150 L 0 150 Z" fill="var(--orange-color)"></path>
    </svg>
</div>
<div class="why-artcademy">
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
</div>
<div class="wave-bottom">
    <svg viewBox="0 0 1440 150" preserveAspectRatio="none" style="display: block; width: 100%; height: 150px;">
        <path d="M0 150 C360 0 1080 0 1440 150 L1440 0 L0 0 Z" fill="var(--orange-color)"></path>
    </svg>
</div>

<!-- categories -->
<div class="container text-center" style="padding-bottom: 3rem">
    <h2 class="fw-bold"><span class="text-pink-gradient">Mau Belajar</span> yang Mana Dulu?</h2>
    <p class="mb-5">Di Artcademy, kamu bebas memilih jalur senimu dan menjadikannya bagian dari perjalanan kreatifmu</p>

    <div class="big-card d-flex justify-content-around align-items-center flex-wrap">
        <a href="/course" class="text-decoration-none text-dark">
            <div class="choice-item">
                <div class="img-wrapper">
                    <img src="{{ asset('assets/home/category-painting.png') }}" alt="Seni Lukis" height="100px">
                </div>
                <p class="fw-bold mt-3">Seni Lukis & Digital Art</p>
            </div>
        </a>

        <a href="/course" class="text-decoration-none text-dark">
            <div class="choice-item">
                <div class="img-wrapper">
                    <img src="{{ asset('assets/home/category-music.png') }}" alt="Seni Musik" height="100px">
                </div>
                <p class="fw-bold mt-3">Seni Musik</p>
            </div>
        </a>

        <a href="/course" class="text-decoration-none text-dark">
            <div class="choice-item">
                <div class="img-wrapper">
                    <img src="{{ asset('assets/course-header-pic.png') }}" alt="Seni Fotografi" height="90px">
                </div>
                <p class="fw-bold mt-3">Seni Fotografi</p>
            </div>
        </a>

        <a href="/course" class="text-decoration-none text-dark">
            <div class="choice-item">
                <div class="img-wrapper">
                    <img src="{{ asset('assets/home/category-dance.png') }}" alt="Seni Tari" height="150px">
                </div>
                <p class="fw-bold mt-3">Seni Tari</p>
            </div>
        </a>
    </div>
</div>

<!-- hits -->
<div class="container-fluid mb-4 mt-5 pb-5 pt-5" style="background: var(--cream2-color)">
    <div class="p-4">
        <h2 class="fw-bold mt-4 text-center"><span class="text-pink-gradient">Yang Lagi Hits </span>di Artcademy</h2>
        <p class="mb-5 text-center">Rekomendasi kursus paling cocok buat mulai perjalanan kreatifmu</p>

        <div class="d-flex gap-4 justify-content-center flex-wrap">
           <div class="card"></div>
           <div class="card"></div>
           <div class="card"></div>
           <div class="card"></div>
        </div>
    </div>
</div>

<!-- tutor -->
<div class="container-fluid mt-4 mb-5">
    <div class="p-4">
        <h2 class="fw-bold mt-4 text-center"><span class="text-pink-gradient">Tutor Keren, </span>Ilmu Nggak Kaleng-Kaleng!</h2>
        <p class="mb-5 text-center">Para tutor berpengalaman siap berbagi ilmu dan insight kreatif buat kamu</p>

         <div class="d-flex gap-4 justify-content-center flex-wrap">
           <div class="card"></div>
           <div class="card"></div>
           <div class="card"></div>
           <div class="card"></div>
        </div>
    </div>
</div>

<!-- membership -->
<div class="container-fluid pink-gradient-background mt-4 pb-5">
  <div class="p-4">
        <h2 class="fw-bold mt-4 text-center pt-5"><span class="text-pink-gradient">Semua Bisa Jadi Karya, </span>Asal Punya Aksesnya</h2>
        <p class="mb-5 text-center">Pilih paket membership sesuai levelmu dan mulai eksplorasi tanpa batas!</p>

        <div class="d-flex gap-4 justify-content-center flex-wrap">
           <div class="card"></div>
           <div class="card"></div>
           <div class="card"></div>
        </div>
    </div>
</div>

<!-- event -->
<div class="container-fluid mt-4 mb-5">
    <div class="p-4">
        <h2 class="fw-bold mt-4 text-center"><span class="text-pink-gradient">Ikuti Event Seru </span>Artcademy!</h2>
        <p class="mb-5 text-center">Ikut event-nya, dapet ilmunya, dan bangun koneksi kreatif bareng!</p>

         <div class="d-flex mb-5 gap-4 justify-content-center flex-wrap">
           <div class="card"></div>
           <div class="card"></div>
           <div class="card"></div>
           <div class="card"></div>
        </div>
    </div>
</div>

<!-- forum -->
<div class="container-fluid pb-5 pt-4 mt-5 position-relative" style="background: var(--cream2-color); overflow: visible;">
    <div class="container p-4 position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-12">
                <div style="position: relative; height: 100%; top: -335px">
                    <img
                        src="{{ asset('assets/home/forum.png') }}"
                        alt="Top Illustration"
                        class="img-fluid"
                        style="max-width: 490px; position: absolute;"
                    >
                </div>
            </div>
            <div class="col-md-6 col-sm-12 pt-5 pb-4">
                <h2 class="fw-bold" style="font-size: 3rem;">Diskusi di Forum Kreatif!</h2>
                 <p class="mt-3 mb-4">
                    Diskusikan karyamu dengan sesama kreator, dapatkan feedback mendalam dari mentor profesional,
                    dan temukan peluang kolaborasi seru bersama <strong>50.000++</strong> seniman yang siap berbagi inspirasi setiap hari!
                </p>
                <button class="btn px-4 py-2 yellow-gradient-btn text-dark">Lihat Forum</button>
            </div>
        </div>
    </div>
</div>


<!-- testi -->
<div class="container-fluid mt-4 mb-5">
    <div class="p-4">
        <h2 class="fw-bold mt-4 text-center"><span class="text-pink-gradient">Apa kata mereka tentang Artcademy?</span></h2>
        <p class="mb-5 text-center">Simak testimoni dari para alumni yang berhasil wujudin ide jadi karya nyata</p>

         <div class="d-flex gap-4 justify-content-center flex-wrap">
           <div class="card"></div>
           <div class="card"></div>
           <div class="card"></div>
           <div class="card"></div>
        </div>
    </div>
</div>

<!-- question -->
<div class="container-fluid mt-4 mb-5 text-center p-5" style="background: var(--orange-gradient-color); height: 350px; color: var(--brown-color);">
    <h2 class="fw-bold" style="font-size: 3rem;  margin-top: 40px;">Masih Punya Pertanyaan?</h2>
    <p class="mb-3 text-center">Yuk, ngobrol bareng tim Artcademy, kami siap bantuin kamu memulai perjalanan kreatifmu!</p>
    <button class="btn px-4 py-2 yellow-gradient-btn text-dark">Kontak Kami</button>
    <div class="row align-items-center">
        <div class="col-md-6 col-sm-12">
            <div style="position: relative; height: 100%; top: -310px; left: 104%">
                <img
                    src="{{ asset('assets/home/contact-us.png') }}"
                    alt="Top Illustration"
                    class="img-fluid"
                    style="max-height: 400px; position: absolute;"
                >
            </div>
        </div>
    </div>
</div>

<!-- Illustration -->
 <p class="mb-2 text-center">Mulai dari ide kecil, wujudkan jadi karya nyata, dari hobi yang kamu suka, jadi skill yang menginspirasi!</p>
 <p class="mb-5 text-center">—Artcademy</p>

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

    .big-card {
        background-color: #fff;
        border-radius: 2rem;
        box-shadow: 0px 4px 10px 0px var(--brown-shadow-color);
        overflow: visible
    }

    .choice-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
        border-radius: 2rem;
    }

    .choice-item:hover {
        background: var(--pink-gradient-color);
        color: #fff;
    }

    .choice-item .img-wrapper {
        background-color: var(--cream-color);
        border-radius: 1.5rem;
        width: 250px;
        height: 170px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .choice-item:hover .img-wrapper {
        background: transparent;
    }

    .choice-item .img-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .pink-gradient-background {
        background: var(--pink-medium-gradient-color);
        border-top-left-radius: 70% 50%;
        border-top-right-radius: 70% 50%;
    }

    .card {
        border-radius: 2rem;
        overflow: hidden;
        background: #fff;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        width: 300px;
        height: 415px;
        display: flex;
        flex-direction: column;
    }
</style>
@endsection
