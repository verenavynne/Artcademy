@extends('layouts.master')

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">

    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="#">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column" style="width: 65%;">
            <div class="course-card-detail card d-flex flex-row" style="background: var(--orange-gradient-color)">
                <div class="course-card-detail-content d-flex flex-column justify-content-center" style="gap: 12px; padding-inline-end: 26px">
                    <p style="margin:0; font-size: var(--font-size-big); font-weight: 700">Dasar-dasar Concept Art untuk Game & Film</p>
                    <div class="d-flex flex-row gap-5">
                        <div class="d-flex flex-column" style="gap:12px">
                           <p style="margin:0; font-size: var(--font-size-small);">Pelajari Dasar-Dasar Mendesain Karakter, Environment, dan Prop untuk Industri Kreatif, Mulai dari Nol Hingga Siap Berkarya!</p>
                           <div class="course-time-container d-flex flex-row gap-1 mb-2">
                                <img src="{{ asset('assets/icons/icon_clock.svg') }}" alt="Clock" height="24" width="24">
                                <p style="margin:0; color: black; font-size: var(--font-size-small)">8 Jam 17 Menit</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column ps-5" style="gap: 22px">
                    <div class="d-flex justify-content-end">
                        <div class="course-card-detail-header d-flex" style="background:#D99F18; ">
                            <p style="margin: 0; color: white; font-size: var(--font-size-small)" >Seni Lukis & Digital Art</p>
                        </div>

                    </div>
                    <div class="d-flex flex-start pe-5">
                        <img src="{{ asset('assets/course/course_default_picture.png') }}" alt="Course Picture" width="176" height="126" style="">

                    </div>
                </div>

            </div>
            <div class="d-flex flex-column" style="gap: 22px;">
                <div class="d-flex flex-row justify-content-between">
                    <p style="margin:0; font-size: var(--font-size-big); font-weight: 700">Dasar-dasar Concept Art untuk Game & Film</p>
                    <a href="#">
                        <img src="{{ asset('assets/icons/icon_bookmark.svg') }}" alt="Bookmark" style="width: 24px; height: 24px;">
                    </a>
                </div>
                 <div class="course-level-text-container" style="background: #FFEFDE">
                    <p class="course-level-text" style="background: var(--orange-gradient-color); margin: 0; background-clip: text; font-weight: 700; font-size:var(--font-size-small)">Level Dasar</p>
                </div>

                <div class="d-flex flex-row align-items-center" style="gap:5px">
                    <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700; color: var(--dark-gray-color) ">4.9</p>
                    <div class="d-flex flex-row" style="gap: 5px">
                        <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                        <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                        <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                        <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                        <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                    </div>
                    <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">(300+ reviews)</p>
                </div>
            </div>

            <div class="d-flex flex-row category-btn-group gap-4 pb-4">
                <a href="#">
                    <button class="category-btn active">Deskripsi</button>
                </a>
                <a href="#">
                    <button class="category-btn">Silabus</button>
                </a>
                <a href="#">
                    <button class="category-btn">Tutor</button>
                </a>
                <a href="#">
                    <button class="category-btn">Kelas Zoom</button>
                </a>
                <a href="#">
                    <button class="category-btn">Testimoni</button>
                </a>
            </div>

            <div class="description-section d-flex flex-column">
                <p class="title text-start fw-bold">Deskripsi Khusus</p>
                <p class="text-start sub-title">Ingin berkarier di industri game atau film sebagai concept artist? Course ini adalah langkah pertamamu! Kamu akan mempelajari fundamental concept art—mulai dari desain karakter, environment, hingga prop design—dengan pendekatan praktis ala profesional. Di akhir course, kamu akan memiliki 1 karya concept art lengkap yang siap jadi bagian portofoliomu!</p>
            </div>

            <hr class="divider">

            <div class="sylabus-section d-flex flex-column">
                <p class="title text-start fw-bold">Silabus</p>
                <div class="minggu-section d-flex flex-column">
                    <div class="minggu-container d-flex flex-row">
                        <p class="minggu-title"><span style="font-weight: 700">Minggu 1 : </span>Pengenalan Concept Art & Ideation</p>
                        <img src="{{ asset('assets/icons/icon_arrow_down.svg') }}" alt="Arrow Icon" width="24" height="24" style="">
                    </div>
                    <div class="minggu-container d-flex flex-row">
                        <p class="minggu-title"><span style="font-weight: 700">Minggu 1 : </span>Pengenalan Concept Art & Ideation</p>
                        <img src="{{ asset('assets/icons/icon_arrow_down.svg') }}" alt="Arrow Icon" width="24" height="24" style="">
                    </div>
                    <div class="minggu-container d-flex flex-row">
                        <p class="minggu-title"><span style="font-weight: 700">Minggu 1 : </span>Pengenalan Concept Art & Ideation</p>
                        <img src="{{ asset('assets/icons/icon_arrow_up.svg') }}" alt="Arrow Icon" width="24" height="24" style="">
                    </div>
                    <div class="minggu-container d-flex flex-row">
                        <p class="minggu-title"><span style="font-weight: 700">Minggu 1 : </span>Pengenalan Concept Art & Ideation</p>
                        <img src="{{ asset('assets/icons/icon_arrow_down.svg') }}" alt="Arrow Icon" width="24" height="24" style="">
                    </div>

                    <div class="minggu-materi-container d-flex flex-column" >
                        <div class="materi-line d-flex flex-row">
                            <div class="materi-title d-flex flex-row align-items-center">
                                <div class="materi-number"><p>1</p></div>
                                <p>Perspektif 1-Point & 2-Point untuk Pemula</p>
                            </div>

                            <div class="materi-icon d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_video.svg') }}" alt="Video Icon" width="24" height="24" style="">
                                <p>Video</p>
                            </div>

                            <div class="materi-icon d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_time.svg') }}" alt="Time Icon" width="24" height="24" style="">
                                <p>20 menit</p>
                            </div>
                        </div>

                        <div class="materi-line d-flex flex-row">
                            <div class="materi-title d-flex flex-row align-items-center">
                                <div class="materi-number"><p>1</p></div>
                                <p>Perspektif 1-Point & 2-Point untuk Pemula</p>
                            </div>

                            <div class="materi-icon d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_video.svg') }}" alt="Video Icon" width="24" height="24" style="">
                                <p>Video</p>
                            </div>

                            <div class="materi-icon d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_time.svg') }}" alt="Time Icon" width="24" height="24" style="">
                                <p>20 menit</p>
                            </div>
                        </div>

                        <div class="materi-line d-flex flex-row">
                            <div class="materi-title d-flex flex-row align-items-center">
                                <div class="materi-number"><p>1</p></div>
                                <p>Perspektif 1-Point & 2-Point untuk Pemula</p>
                            </div>

                            <div class="materi-icon d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_video.svg') }}" alt="Video Icon" width="24" height="24" style="">
                                <p>Video</p>
                            </div>

                            <div class="materi-icon d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_time.svg') }}" alt="Time Icon" width="24" height="24" style="">
                                <p>20 menit</p>
                            </div>
                        </div>

                        <div class="materi-line d-flex flex-row">
                            <div class="materi-title d-flex flex-row align-items-center">
                                <div class="materi-number"><p>1</p></div>
                                <p>Perspektif 1-Point & 2-Point untuk Pemula</p>
                            </div>

                            <div class="materi-icon d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_video.svg') }}" alt="Video Icon" width="24" height="24" style="">
                                <p>Video</p>
                            </div>

                            <div class="materi-icon d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_time.svg') }}" alt="Time Icon" width="24" height="24" style="">
                                <p>20 menit</p>
                            </div>
                        </div>

                    </div>

                    
                </div>

            </div>

            <hr class="divider">

            <div class="tutor-section d-flex flex-column">
                <p class="title text-start fw-bold">Tutor</p>
            </div>
        </div>
        <div class="d-flex" style="width: 35%;">
            

        </div>

    </div>


</div>

<style>
    .navigation-prev .page-link{
        background: var(--yellow-gradient-color);
        border-radius: 50%;
        color: black;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 7.571px 15.143px 0px rgba(67, 39, 0, 0.20);
    }

    .course-card-detail{
        padding-inline: 40px;
        padding-block: 30px;
        border-radius: 40px;
        margin-block-end: 22px;
    }

    .course-card-detail-header{
        display: flex;
        height: 31px;
        padding: 10px;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        width: max-content;
    }

    .course-time-container{
        display: flex;
        height: 44px;
        padding: 10px;
        justify-content: center;
        align-items: center;
        border-radius: 100px;
        background: white;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.15);
        width: max-content;
    }

    .course-level-text-container{
        border-radius: 10px;
        display: flex;
        padding: 4px 20px;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        width: max-content;;
    }

    .course-level-text{
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .category-btn-group{
        justify-content: space-between;
    }
    .category-btn-group a{
        text-decoration: none;
        padding: 32px 0;
    }

    .category-btn{
        border-radius: 1000px;
        background: white;
        border: none;
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        height: 42px;
        padding: 10px 40px;
        font-size: var(--font-size-primary);
        justify-content: space-center;
    }

    .category-btn.active{
        background: var(--pink-medium-gradient-color);
    }

    .title{
        margin: 0;
        font-size: var(--font-size-title); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-block-end: 18px;
    
    }

    .sub-title{
        margin: 0;
        font-size: var(--font-size-primary);
        font-weight: 400;
        color:var(--dark-gray-color)
    }

    .divider{
        border: none;
        height: 3px;
        background-color: var(--orange-color);
        border-radius: 2px;
        margin-block: 34px;
    }

    .minggu-section {
        gap: 21px;
    }

    .minggu-container{
        height: 68px;
        padding: 10px 35px;
        align-items: center;
        align-self: stretch;
        justify-content: space-between;
        border-radius: 100px;
        background: white;
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
    }

    .minggu-title{
        margin: 0;
        font-size: var(--font-size-primary);
    }

    .minggu-materi-container{
        padding: 35px;
        align-items: flex-start;
        border-radius: 40px;
        background: #F9EEDB;
        min-height: 264px;
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
        gap: 22px;
    }

    .materi-line {
        font-size: var(--font-size-small);
        color: var(--black-color);
        justify-content: space-between;
        align-items: center;
        gap: 150px;
    }

    .materi-line p {
        margin: 0;
    }

    .materi-icon{
        gap: 8px;
    }

    .materi-number{
        display: flex; /* ⬅️ ini kunci utama */
        align-items: center; /* rata vertikal */
        justify-content: center;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        background: var(--yellow-gradient-color);
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
        font-weight: 700;
        align-items: center;
        justify-content: center; 
    }

    .materi-title{
        min-width: 365px;
        gap: 11px;
    }
</style>
@endsection