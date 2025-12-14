<div class="benefit-card d-flex flex-column">
    <p class="benefit-title text-start fw-bold">Benefit Kursus</p>
    <hr class="benefit-divider">
    <div class="benefit-list d-flex flex-column">
        <div class="list-benefit d-flex flex-row">
            <img src="{{ asset('assets/icons/icon_video_gradient.svg') }}" alt="Like" height="24" width="24">
            <p>15 Video materi pembelajaran step-by-step</p>
        </div>
        <div class="list-benefit d-flex flex-row">
            <img src="{{ asset('assets/icons/icon_article_gradient.svg') }}" alt="Like" height="24" width="24">
            <p>12 Materi Bacaan Pendukung Eksklusif</p>
        </div>
        <div class="list-benefit d-flex flex-row">
            <img src="{{ asset('assets/icons/icon_sertifikat_gradient.svg') }}" alt="Like" height="24" width="24">
            <p>Sertifikat resmi bukti kelulusan</p>
        </div>
        <div class="list-benefit d-flex flex-row">
            <img src="{{ asset('assets/icons/icon_portofolio_gradient.svg') }}" alt="Like" height="24" width="24">
            <p>Project portofolio profesional</p>
        </div>
        <div class="list-benefit d-flex flex-row">
            <img src="{{ asset('assets/icons/icon_zoom_gradient.svg') }}" alt="Like" height="24" width="24">
            <p>Kelas zoom live dengan ahli</p>
        </div>

    </div>

    @if (Auth::check())
        <form action="{{ route('course.enroll', $course->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn w-100 text-dark yellow-gradient-btn">
                Daftar Sekarang
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="btn w-100 text-dark yellow-gradient-btn">
            Daftar Sekarang
        </a>
    @endif



</div>

<style>
    .benefit-card{
        display: flex;
        width: 439px;
        height: max-content;
        padding: 32px 30px;
        justify-content: center;
        border-radius: 44px;
        background: white;
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
    }

    .benefit-list{
        gap: 10px;
        padding-inline: 5px;
        padding-block: 20px;
    }

    .list-benefit{
        gap: 9px;
    }

    .benefit-title{
        margin: 0;
        font-size: var(--font-size-title); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .benefit-divider{
        border: none;
        height: 3px;
        background-color: var(--orange-color);
        border-radius: 2px;
    }
</style>

