@extends('layouts.master')

@section('content')
<div class="container-fluid px-5">
    <!-- search bar -->
    <div class="d-flex align-items-center pt-1 gap-4 w-100">
        <div class="position-relative flex-grow-1">
           <form class="d-flex w-100 mb-0" method="GET" action="{{route('course')}}">
                <input 
                    type="text" 
                    class="custom-input-2 form-control rounded-pill" 
                    placeholder="Mau belajar apa hari ini?"
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

        @include('components.notification-panel')
    </div>

    <!-- header -->
    <div class="row align-items-start pt-2">
        <div class="col-md-7 pt-5">
            <h1 class="fw-bold pt-5 mt-3" style="font-size: 60px;">
                <span class="text-pink-gradient">Jelajahi Dunia Seni</span> <span class="text-dark">Tanpa Batas</span>
            </h1>

            <p class="pt-1" style="color: var(--dark-gray-color); font-size: 18px;">
                Saatnya upgrade skill dan tunjukin karya terbaikmu lewat portofolio yang kece. Terhubung bareng kreator sekreatif kamu, biar makin banyak inspirasi dan kolaborasi!
            </p>
            <div class="mt-4">
                <a href="{{ auth()->check() ? route('course') : route('login') }}">
                    <button class="yellow-gradient-btn">
                        Belajar Sekarang
                    </button>
                </a>
            </div>
        </div>

        <div class="pink-blur-blob"></div>

        <div class="col-md-5 d-flex justify-content-center pt-4" style="position: relative; z-index: 3">
            <img src="{{ asset('assets/home/top.png') }}" alt="Top Illustration" class="img-fluid" style="max-width: 110%; z-index: 2;">
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
        <p class="mb-5" style="font-size: 18px;">Karena belajar seni harusnya fleksibel, seru, dan nggak sendirian</p>

        <div class="row text-center">
            <div class="col-md-3 p-4">
                <img src="{{ asset('assets/home/why-1.png') }}" class="mb-3" height="150px">
                <h5 class="fw-bold" style="font-size: 18px;">Belajar Fleksibel Bersertifikat</h5>
                <p class="small" style="font-size: 18px;">Akses berbagai kursus seni bersertifikat favorit kamu kapan aja dan di mana aja tanpa batas</p>
            </div>
            <div class="col-md-3 p-4 why-border-left why-border-right">
                <img src="{{ asset('assets/home/why-2.png') }}" class="mb-3" height="150px">
                <h5 class="fw-bold" style="font-size: 18px;">Portofolio Keren</h5>
                <p class="small" style="font-size: 18px;">Tunjukan karyamu kepada dunia dengan tampilan 3D Mockup yang super keren!</p>
            </div>
            <div class="col-md-3 p-4">
                <img src="{{ asset('assets/home/why-3.png') }}" class="mb-3" height="150px">
                <h5 class="fw-bold" style="font-size: 18px;">Forum Kreatif</h5>
                <p class="small" style="font-size: 18px;">Gabung forum kreatif, diskusi, sharing, dan dapet insight dari seniman lainnya!</p>
            </div>
            <div class="col-md-3 p-4 why-border-left">
                <img src="{{ asset('assets/home/why-4.png') }}" class="mb-3" height="150px">
                <h5 class="fw-bold" style="font-size: 18px;">Event Seru Tiap Saat</h5>
                <p class="small" style="font-size: 18px;">Dari webinar hingga workshop, buka peluang belajar dan kolaborasi baru.</p>
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
    <p class="mb-5" style="font-size: 18px;">Di Artcademy, kamu bebas memilih jalur senimu dan menjadikannya bagian dari perjalanan kreatifmu</p>

    <div class="big-card d-flex justify-content-around align-items-center flex-wrap">
        <a href="/course" class="text-decoration-none text-dark">
            <div class="choice-item">
                <div class="img-wrapper">
                    <img src="{{ asset('assets/home/category-painting.png') }}" alt="Seni Lukis" height="100px">
                </div>
                <p class="fw-bold mt-3" style="font-size: 18px;">Seni Lukis & Digital Art</p>
            </div>
        </a>

        <a href="/course" class="text-decoration-none text-dark">
            <div class="choice-item">
                <div class="img-wrapper">
                    <img src="{{ asset('assets/home/category-music.png') }}" alt="Seni Musik" height="100px">
                </div>
                <p class="fw-bold mt-3" style="font-size: 18px;">Seni Musik</p>
            </div>
        </a>

        <a href="/course" class="text-decoration-none text-dark">
            <div class="choice-item">
                <div class="img-wrapper">
                    <img src="{{ asset('assets/course-header-pic.png') }}" alt="Seni Fotografi" height="90px">
                </div>
                <p class="fw-bold mt-3" style="font-size: 18px;">Seni Fotografi</p>
            </div>
        </a>

        <a href="/course" class="text-decoration-none text-dark">
            <div class="choice-item">
                <div class="img-wrapper">
                    <img src="{{ asset('assets/home/category-dance.png') }}" alt="Seni Tari" height="150px">
                </div>
                <p class="fw-bold mt-3" style="font-size: 18px;">Seni Tari</p>
            </div>
        </a>
    </div>
</div>

<!-- hits -->
<div class="container-fluid mb-4 mt-5 pb-5 pt-5" style="background: var(--cream2-color)">
    <div class="p-4">
        <h2 class="fw-bold mt-4 text-center"><span class="text-pink-gradient">Yang Lagi Hits </span>di Artcademy</h2>
        <p class="mb-5 text-center" style="font-size: 18px;">Rekomendasi kursus paling cocok buat mulai perjalanan kreatifmu</p>

        <a href="{{ route('course') }}" class="text-decoration-none d-block pe-5 me-3 pb-4">
            <div class="d-flex flex-row justify-content-end gap-2">
                <p class="fw-bold" style="margin:0; font-size: var(--font-size-primary); color:var(--dark-gray-color)">Lihat semua</p>
                <div class="navigation-next d-flex flex-start" >
                    <img src="{{ asset('assets/icons/icon_pagination_next.svg') }}" alt="" height="8" width="8">
                </div>
            </div>
        </a>
      

        <div class="d-flex flex-wrap justify-content-center" style="gap: 36px">
            @foreach ($courses as $course)
                @include('components.course-card', ['course' => $course])
            @endforeach
                
        </div>
    </div>
</div>

<!-- tutor -->
<div class="container-fluid mt-4 mb-5">
    <div class="p-4">
        <h2 class="fw-bold mt-4 text-center"><span class="text-pink-gradient">Tutor Keren, </span>Ilmu Nggak Kaleng-Kaleng!</h2>
        <p class="mb-5 text-center" style="font-size: 18px;">Para tutor berpengalaman siap berbagi ilmu dan insight kreatif buat kamu</p>

        <div class="d-flex justify-content-center flex-column p-5" style="gap: 36px;">
            @if($tutors->isEmpty())
                <p>Tidak ada tutor</p>
            @endif
            <div class="position-relative">
                <button id="scrollLeft" class="carousel-btn left-btn">
                    <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="Left Arrow">
                </button>
                <div class="all-tutor d-flex overflow-auto pb-3" style="scroll-behavior: smooth; gap: 36px">
                    @foreach ($tutors as $tutor)
                        @include ('components.home-tutor-card')
                    @endforeach
                </div>

                <button id="scrollRight" class="carousel-btn right-btn">
                    <img src="{{ asset('assets/icons/icon_pagination_next.svg') }}" alt="Right Arrow">
                </button>

            </div>
              
        </div>
    </div>
</div>

<!-- membership -->
<div class="container-fluid pink-gradient-background mt-4 pb-5">
  <div class="p-4">
        <h2 class="fw-bold mt-4 text-center pt-5"><span class="text-pink-gradient">Semua Bisa Jadi Karya, </span>Asal Punya Aksesnya</h2>
        <p class="mb-5 text-center" style="font-size: 18px;">Pilih paket membership sesuai levelmu dan mulai eksplorasi tanpa batas!</p>

        <div class="pricing-container">
            @foreach ($memberships as $membership)
                @include('components.membership-card')
            @endforeach
        </div>
    </div>
</div>

<!-- event -->
<div class="container-fluid mt-4 mb-5">
    <div class="p-4">
        <h2 class="fw-bold mt-4 text-center"><span class="text-pink-gradient">Ikuti Event Seru </span>Artcademy!</h2>
        <p class="mb-5 text-center" style="font-size: 18px;">Ikut event-nya, dapet ilmunya, dan bangun koneksi kreatif bareng!</p>

         <div class="d-flex mb-5 gap-4 justify-content-center flex-column p-5">
            @if($events->isEmpty())
                <p>Tidak ada event</p>
            @endif
            <div class="position-relative">
                <button id="scrollLeftEvent" class="carousel-btn left-btn">
                    <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="Left Arrow">
                </button>
                <div class="all-events-wrapper overflow-auto">
                    <div class="all-events d-flex gap-4">
                        @foreach ($events as $event)
                            @include('components.event-card', ['event' => $event])
                        @endforeach
                    </div>
                </div>

                <button id="scrollRightEvent" class="carousel-btn right-btn">
                    <img src="{{ asset('assets/icons/icon_pagination_next.svg') }}" alt="Right Arrow">
                </button>

            </div>
           
        </div>
    </div>
</div>

<!-- forum -->
<div class="container-fluid pb-5 pt-4 mt-5 position-relative forum-section" style="background: var(--cream2-color); overflow: visible;">
    <div class="container p-4 position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-md-6 col-sm-12">
                <div class="forum-image-wrapper" style="position: relative; ">
                    
                    <img
                        src="{{ asset('assets/home/image forum.png') }}"
                        alt="Top Illustration"
                        class="img-fluid forum-image"
                    >
                </div>
            </div>
            <div class="col-md-6 col-sm-12 pt-5 pb-4">
                <h2 class="fw-bold" style="font-size: 3rem;">Diskusi di Forum Kreatif!</h2>
                 <p class="mt-3 mb-4" style="font-size: 18px;">
                    Diskusikan karyamu dengan sesama kreator, dapatkan feedback mendalam dari mentor profesional,
                    dan temukan peluang kolaborasi seru bersama <strong>50.000++</strong> seniman yang siap berbagi inspirasi setiap hari!
                </p>
                <a href="{{ route('forum') }}">
                    <button class="btn px-4 py-2 yellow-gradient-btn text-dark">Lihat Forum</button>
                </a>
            </div>
        </div>
    </div>
</div>


<!-- testi -->
<div class="container-fluid mt-4 mb-5">
    <div class="p-4">
        <h2 class="fw-bold mt-4 text-center"><span class="text-pink-gradient">Apa kata mereka tentang Artcademy?</span></h2>
        <p class="mb-5 text-center" style="font-size: 18px;">Simak testimoni dari para alumni yang berhasil wujudin ide jadi karya nyata</p>

        <div class="d-flex justify-content-center flex-column p-5" style="gap: 36px;">
           
            <div class="position-relative">
                <button id="scrollLeftTestimoni" class="carousel-btn left-btn">
                    <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="Left Arrow">
                </button>

                <div class="all-testimoni-wrapper overflow-auto">
                    <div class="all-testimoni d-flex gap-4">
                        @foreach ($testimonis as $testimoni)
                            @include('components.home-testimoni-card',['testimomi' => $testimoni])
                        @endforeach
                    </div>
                </div>

                <button id="scrollRightTestimoni" class="carousel-btn right-btn">
                    <img src="{{ asset('assets/icons/icon_pagination_next.svg') }}" alt="Right Arrow">
                </button>

            </div>
              
        </div>
         
    </div>
</div>

<!-- question -->
<div class="container-fluid mt-4 mb-5 text-center p-5 contact-us-section" style="background: var(--orange-gradient-color); height: 350px; color: var(--brown-color); **position: relative;** overflow: hidden;">
    <h2 class="fw-bold" style="font-size: 3rem; margin-top: 40px;">Masih Punya Pertanyaan?</h2>
    <p class="mb-3 text-center" style="font-size: 18px;">Yuk, ngobrol bareng tim Artcademy, kami siap bantuin kamu memulai perjalanan kreatifmu!</p>
    <button class="btn px-4 py-2 yellow-gradient-btn text-dark">Kontak Kami</button>
    
    <div class="contact-us-image-wrapper">
        <img
            src="{{ asset('assets/home/contact-us.png') }}"
            alt="Top Illustration"
            class="img-fluid contact-us-image"
        >
    </div>
</div>

<!-- Illustration -->
<p class="mb-2 text-center" style="font-size: 18px; font-weight: 500; color: var(--brown-color);">Mulai dari ide kecil, wujudkan jadi karya nyata, dari hobi yang kamu suka, jadi skill yang menginspirasi!</p>
<p class="mb-5 text-center" style="font-size: 18px; color: var(--brown-color);">—Artcademy</p>

<style>
    .pricing-container {
        display: flex;
        justify-content: center;
        gap: 48px;
        padding: 40px 20px;
        flex-wrap: wrap;
    }


    .pink-blur-blob{
        width: 500px;
        height: 500px;
        flex-shrink: 0;
        border-radius: 519px;
        background: var(--pink-medium, #FF5D8B);
        filter: blur(250px);
        z-index: -1 ! important;
        position: absolute;
        right: 0%;
        top: 100%;
        transform: translateY(-50%);
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
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s ease-in-out;
    }

    .choice-item:hover {
        background: var(--pink-gradient-color);
        color: #fff;
        transform: scale(1.06);

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

    .course-card.card{
        background-color: white;
        width: 300px;
        height: max-content;
        border-radius: 44px;
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        border: none;
        padding:8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

      .course-card.card:hover{
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
      }

    .navigation-next{
        background: var(--yellow-gradient-color);
        border-radius: 50%;
        color: black;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 7.571px 15.143px 0px rgba(67, 39, 0, 0.20);
    }

    
    .all-tutor::-webkit-scrollbar {
        display: none;
    }

    .all-testimoni-wrapper,
    .all-events-wrapper {
        overflow-x: auto;
        scroll-behavior: smooth;
        padding-bottom: 10px;
    }

    .all-testimoni-wrapper::-webkit-scrollbar,
    .all-events-wrapper::-webkit-scrollbar {
        display: none;
    }

    .all-testimoni,
    .all-events {
        display: inline-flex;
        width: max-content;
    }

    .carousel-btn {
        background: var(--yellow-gradient-color);
        border-radius: 50%;
        color: black;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 7.571px 15.143px 0px rgba(67, 39, 0, 0.20);
        position: absolute;
        top: 40%;
        transform: translateY(-50%);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 5;
    }

    .left-btn {
        left: -20px;
    }

    .right-btn {
        right: -20px;
    }

    /* question */
    .contact-us-section {
    position: relative; /* Penting: Membuat container ini menjadi referensi untuk position: absolute *//* Mencegah gambar yang keluar batas mengganggu layout */
    }

    .contact-us-image-wrapper {
        position: absolute; /* Posisikan gambar relatif terhadap container-fluid */
        right: 0; /* Posisikan ke paling kanan */
        top: 120px; /* Posisikan vertikal di tengah */
        transform: translateY(-50%); /* Geser ke atas 50% dari tingginya sendiri agar benar-benar di tengah vertikal */
        z-index: 1; /* Pastikan gambar berada di atas background */
    }

    .contact-us-image {
        max-height: 400px; /* Batasi tinggi maksimum */
        width: auto; /* Jaga aspek rasio */
    }

    /* Penyesuaian untuk layar kecil (Opsional: atur visibilitas/ukuran jika diperlukan) */
    @media (max-width: 768px) {
        .contact-us-image-wrapper {
            right: 0px; /* Geser sedikit ke luar agar tidak terlalu menutupi konten utama */
            max-height: 300px; /* Kecilkan sedikit gambarnya */
        }
    }


    /* forum */
    .forum-section {
    position: relative; /* Penting: Membuat container ini menjadi referensi untuk position: absolute *//* Mencegah gambar yang keluar batas mengganggu layout */
    }

    .forum-image-wrapper {
        position: absolute; /* Posisikan gambar relatif terhadap container-fluid */
        right: 0; /* Posisikan ke paling kanan */
        top: -283px; /* Posisikan vertikal di tengah */
        transform: translateY(-50%); /* Geser ke atas 50% dari tingginya sendiri agar benar-benar di tengah vertikal */
        z-index: 1; /* Pastikan gambar berada di atas background */
        height: 100%
        
    }

    .forum-image {
        position: absolute;
        max-height: 508px; /* Batasi tinggi maksimum */
        width: auto; /* Jaga aspek rasio */
    }

    /* Penyesuaian untuk layar kecil (Opsional: atur visibilitas/ukuran jika diperlukan) */
    @media (max-width: 768px) {
        .forum-image-wrapper {
            right: 0px; /* Geser sedikit ke luar agar tidak terlalu menutupi konten utama */
            max-height: 300px; /* Kecilkan sedikit gambarnya */
        }
    }
</style>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {

    // Carousel Tutor
    const scrollContainer = document.querySelector('.all-tutor');
    const scrollLeftBtn = document.getElementById('scrollLeft');
    const scrollRightBtn = document.getElementById('scrollRight');

    scrollLeftBtn.addEventListener('click', () => {
        scrollContainer.scrollBy({ left: -400, behavior: 'smooth' });
    });

    scrollRightBtn.addEventListener('click', () => {
        scrollContainer.scrollBy({ left: 400, behavior: 'smooth' });
    });

    // Carousel Event
    const scrollEventContainer = document.querySelector('.all-events-wrapper');
    const scrollLeftBtnEvent = document.getElementById('scrollLeftEvent');
    const scrollRightBtnEvent = document.getElementById('scrollRightEvent');

    scrollLeftBtnEvent.addEventListener('click', () => {
        scrollEventContainer.scrollBy({ left: -400, behavior: 'smooth' });
    });

    scrollRightBtnEvent.addEventListener('click', () => {
        scrollEventContainer.scrollBy({ left: 400, behavior: 'smooth' });
    });

     // Carousel Testimoni
    const scrollTestimoniContainer = document.querySelector('.all-testimoni-wrapper');
    const scrollLeftBtnTestimoni = document.getElementById('scrollLeftTestimoni');
    const scrollRightBtnTestimoni = document.getElementById('scrollRightTestimoni');

    scrollLeftBtnTestimoni.addEventListener('click', () => {
        scrollTestimoniContainer.scrollBy({ left: -400, behavior: 'smooth' });
    });

    scrollRightBtnTestimoni.addEventListener('click', () => {
        scrollTestimoniContainer.scrollBy({ left: 400, behavior: 'smooth' });
    });

});
</script>
