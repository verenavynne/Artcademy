@extends('layouts.master')

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">

    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="#">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-center gap-5">
        <!-- Sisi Kiri -->
        <div class="d-flex flex-column" style="width: 60%;">
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

            <!-- Sylabus Section -->
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

            <!-- Tutor Section -->
            <div class="tutor-section d-flex flex-column">
                <p class="title text-start fw-bold">Tutor</p>
                <div class="tutor-card-container d-flex flex-row">
                    <div class="tutor-card d-flex flex-row">
                        <img class="tutor-profile-image" src="{{ asset('assets/course/default_tutor_profile.png') }}" alt="Tutor Profile Icon" style="">
                        <div class="tutor-info-container d-flex flex-column justify-content-center">
                            <div class="d-flex flex-column" style="padding-block-end: 9px">
                                <p class="tutor-name fw-bold">Jane Doe</p>
                                <p class="tutor-info">Visual Artist di ABC</p>

                            </div>
                            <div class="d-flex flex-row gap-1 align-items-center">
                                <img src="{{ asset('assets/icons/icon_suitcase.svg') }}" alt="Arrow Icon" width="18" height="18" style="">
                                <p class="tutor-info">5 tahun</p>
                            </div>
                        </div>
                         <img src="{{ asset('assets/logo/logo_linkedin.png') }}" alt="Linkedin logo" width="33" height="33" style="">
                    </div>
                    <div class="tutor-card d-flex flex-row">
                        <img class="tutor-profile-image" src="{{ asset('assets/course/default_tutor_profile.png') }}" alt="Tutor Profile Icon" style="">
                        <div class="tutor-info-container d-flex flex-column justify-content-center">
                            <div class="d-flex flex-column" style="padding-block-end: 9px">
                                <p class="tutor-name fw-bold">Jane Doe</p>
                                <p class="tutor-info">Visual Artist di ABC</p>

                            </div>
                            <div class="d-flex flex-row gap-1 align-items-center">
                                <img src="{{ asset('assets/icons/icon_suitcase.svg') }}" alt="Arrow Icon" width="18" height="18" style="">
                                <p class="tutor-info">5 tahun</p>
                            </div>
                        </div>
                         <img src="{{ asset('assets/logo/logo_linkedin.png') }}" alt="Linkedin logo" width="33" height="33" style="">
                    </div>
                    <div class="tutor-card d-flex flex-row">
                        <img class="tutor-profile-image" src="{{ asset('assets/course/default_tutor_profile.png') }}" alt="Tutor Profile Icon" style="">
                        <div class="tutor-info-container d-flex flex-column justify-content-center">
                            <div class="d-flex flex-column" style="padding-block-end: 9px">
                                <p class="tutor-name fw-bold">Jane Doe</p>
                                <p class="tutor-info">Visual Artist di ABC</p>

                            </div>
                            <div class="d-flex flex-row gap-1 align-items-center">
                                <img src="{{ asset('assets/icons/icon_suitcase.svg') }}" alt="Arrow Icon" width="18" height="18" style="">
                                <p class="tutor-info">5 tahun</p>
                            </div>
                        </div>
                         <img src="{{ asset('assets/logo/logo_linkedin.png') }}" alt="Linkedin logo" width="33" height="33" style="">
                    </div>
                </div>
                
                
            </div>

            <hr class="divider">

            <!-- Kelas Zoom Section -->
            <div class="zoom-section d-flex flex-column">
            <p class="title text-start fw-bold">Kelas Zoom</p>
            <div class="zoom-card-container d-flex flex-row justify-content-between">
                <div class="zoom-card card article-card" height="100%">
                    <div class="zoom-card-header d-flex flex-column justify-content-between" style="background: var(--orange-gradient-color)">
                        <div class="zoom-text-container d-flex flex-row mb-2 gap-2" style="background: #D99F18">
                            <div class="zoom-record-icon"></div>
                            <p style="margin: 0; color: white; font-size: var(--font-size-mini)" >Kelas Zoom</p>
                        </div>
                        <p style="margin: 0; color: black; font-size: var(--font-size-tiny); font-weight: 700">Live Demo: Membuat Karakter Game dari Nol dalam 90 Menit</p>
                        <div class="d-flex flex-row justify-content-center align-items-center gap-3" >
                            <div class="zoom-date-container d-flex flex-row gap-1 mb-2">
                                <img src="{{ asset('assets/icons/icon_calendar.svg') }}" alt="Tutor Profile" width="16" height="16">
                                <p style="margin:0; color: black; font-size: var(--font-size-mini)">1 Juni 2025</p>
                            </div>
                            <img class="zoom-tutor-profile" src="{{ asset('assets/course/default_tutor_profile_zoom.png') }}" alt="zoom Picture">
                        </div>
                    </div>
                    <div class="zoom-card-bottom d-flex flex-column align-items-start">
                    
                        <p class="zoom-title" >Live Demo: Membuat Karakter Game dari Nol dalam 90 Menit</p>
                            
                        <div class="d-flex flex-row align-items-center gap-2">
                                
                            <img src="{{ asset('assets/course/default_tutor_profile_zoom.png') }}" 
                            class="rounded-circle zoom-tutor-image" 
                            width="37" 
                            height="37" 
                            >
                            <div class="d-flex flex-column">
                                <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color); font-weight: 700">
                                    Tutor: John Doe</p>
                                        <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">
                                    Game artist di ABC</p>

                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center" style="gap:5px">
                            <div class="d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_calendar.svg') }}" alt="Star" height="16" width="16">
                                
                            </div>
                            <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">1 Juni 2025</p>
                        </div>
                        <button type="submit" class="btn w-100 text-dark yellow-gradient-btn">Daftar Sekarang</button>

                    </div>
                </div>
                <div class="zoom-card card article-card" height="100%">
                    <div class="zoom-card-header d-flex flex-column justify-content-between" style="background: var(--orange-gradient-color)">
                        <div class="zoom-text-container d-flex flex-row mb-2 gap-2" style="background: #D99F18">
                            <div class="zoom-record-icon"></div>
                            <p style="margin: 0; color: white; font-size: var(--font-size-mini)" >Kelas Zoom</p>
                        </div>
                        <p style="margin: 0; color: black; font-size: var(--font-size-tiny); font-weight: 700">Live Demo: Membuat Karakter Game dari Nol dalam 90 Menit</p>
                        <div class="d-flex flex-row justify-content-center align-items-center gap-3" >
                            <div class="zoom-date-container d-flex flex-row gap-1 mb-2">
                                <img src="{{ asset('assets/icons/icon_calendar.svg') }}" alt="Tutor Profile" width="16" height="16">
                                <p style="margin:0; color: black; font-size: var(--font-size-mini)">1 Juni 2025</p>
                            </div>
                            <img class="zoom-tutor-profile" src="{{ asset('assets/course/default_tutor_profile_zoom.png') }}" alt="zoom Picture">
                        </div>
                    </div>
                    <div class="zoom-card-bottom d-flex flex-column align-items-start">
                    
                        <p class="zoom-title" >Live Demo: Membuat Karakter Game dari Nol dalam 90 Menit</p>
                            
                        <div class="d-flex flex-row align-items-center gap-2">
                                
                            <img src="{{ asset('assets/course/default_tutor_profile_zoom.png') }}" 
                            class="rounded-circle zoom-tutor-image" 
                            width="37" 
                            height="37" 
                            >
                            <div class="d-flex flex-column">
                                <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color); font-weight: 700">
                                    Tutor: John Doe</p>
                                        <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">
                                    Game artist di ABC</p>

                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center" style="gap:5px">
                            <div class="d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_calendar.svg') }}" alt="Star" height="16" width="16">
                                
                            </div>
                            <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">1 Juni 2025</p>
                        </div>
                        <button type="submit" class="btn w-100 text-dark yellow-gradient-btn">Daftar Sekarang</button>

                    </div>
                </div>
                <div class="zoom-card card article-card" height="100%">
                    <div class="zoom-card-header d-flex flex-column justify-content-between" style="background: var(--orange-gradient-color)">
                        <div class="zoom-text-container d-flex flex-row mb-2 gap-2" style="background: #D99F18">
                            <div class="zoom-record-icon"></div>
                            <p style="margin: 0; color: white; font-size: var(--font-size-mini)" >Kelas Zoom</p>
                        </div>
                        <p style="margin: 0; color: black; font-size: var(--font-size-tiny); font-weight: 700">Live Demo: Membuat Karakter Game dari Nol dalam 90 Menit</p>
                        <div class="d-flex flex-row justify-content-center align-items-center gap-3" >
                            <div class="zoom-date-container d-flex flex-row gap-1 mb-2">
                                <img src="{{ asset('assets/icons/icon_calendar.svg') }}" alt="Tutor Profile" width="16" height="16">
                                <p style="margin:0; color: black; font-size: var(--font-size-mini)">1 Juni 2025</p>
                            </div>
                            <img class="zoom-tutor-profile" src="{{ asset('assets/course/default_tutor_profile_zoom.png') }}" alt="zoom Picture">
                        </div>
                    </div>
                    <div class="zoom-card-bottom d-flex flex-column align-items-start">
                    
                        <p class="zoom-title" >Live Demo: Membuat Karakter Game dari Nol dalam 90 Menit</p>
                            
                        <div class="d-flex flex-row align-items-center gap-2">
                                
                            <img src="{{ asset('assets/course/default_tutor_profile_zoom.png') }}" 
                            class="rounded-circle zoom-tutor-image" 
                            width="37" 
                            height="37" 
                            >
                            <div class="d-flex flex-column">
                                <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color); font-weight: 700">
                                    Tutor: John Doe</p>
                                        <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">
                                    Game artist di ABC</p>

                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center" style="gap:5px">
                            <div class="d-flex flex-row">
                                <img src="{{ asset('assets/icons/icon_calendar.svg') }}" alt="Star" height="16" width="16">
                                
                            </div>
                            <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">1 Juni 2025</p>
                        </div>
                        <button type="submit" class="btn w-100 text-dark yellow-gradient-btn">Daftar Sekarang</button>

                    </div>
                </div>

            </div>
            </div>

            <hr class="divider">

            <!-- Testimoni Section -->
            <div class="testimoni-section d-flex flex-column">
                <p class="title text-start fw-bold">Kelas Zoom</p>
                <div class="testimoni-wrapper d-flex flex-column" style="gap: 28px">
                    <div class="testimoni-recap d-flex flex-row gap-2">
                        <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                        <p>4.6 / 5.0</p>
                    </div>

                    <div class="d-flex flex-row category-btn-group gap-4">
                        <a href="#">
                            <button class="category-btn active">Semua</button>
                        </a>
                        <a href="#">
                            <button class="category-btn d-flex flex-row align-items-center justify-content-center">
                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                5(60)
                            </button>
                        </a>
                        <a href="#">
                            <button class="category-btn d-flex flex-row align-items-center justify-content-center">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                4(41)
                            </button>
                        </a>
                        <a href="#">
                            <button class="category-btn d-flex flex-row align-items-center justify-content-center">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                3(15)</button>
                        </a>
                        <a href="#">
                            <button class="category-btn d-flex flex-row align-items-center justify-content-center">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                2(1)
                            </button>
                        </a>
                        <a href="#">
                            <button class="category-btn d-flex flex-row align-items-center justify-content-center">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                1(0)
                            </button>
                        </a>
                    </div>

                    <div class="testimoni-card-container">
                        <div class="testimoni-card d-flex flex-column">
                            <div class="testimoni-header d-flex flex-row">
                                <img src="{{ asset('assets/course/testimoni_default_profile.svg') }}" 
                                class="rounded-circle testimoni-profile" 
                                width="55" 
                                height="55" 
                                >
                                <div class="testimoni-name d-flex flex-column">
                                    <p class="fw-bold">Vynne</p>
                                    <div class="d-flex flex-row" style="gap:5px">
                                        <div class="d-flex flex-row" style="gap: 5px">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                        </div>
                                        <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">2 days ago</p>

                                    </div>

                                </div>

                            </div>
                            <p class="testimoni-review">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis</p>

                            <div class="testimoni-footer d-flex flex-row justify-content-between">
                                <div class="d-flex flex-row">
                                    <img src="{{ asset('assets/icons/icon_likes.svg') }}" alt="Like" height="16" width="16">
                                    <p class="membantu-text">Membantu</p>
                                </div>
                                <p class="lihat-testimoni-text">Lihat selengkapnya</p>

                            </div>
                                
                        </div>
                        <div class="testimoni-card d-flex flex-column">
                            <div class="testimoni-header d-flex flex-row">
                                <img src="{{ asset('assets/course/testimoni_default_profile.svg') }}" 
                                class="rounded-circle testimoni-profile" 
                                width="55" 
                                height="55" 
                                >
                                <div class="testimoni-name d-flex flex-column">
                                    <p class="fw-bold">Vynne</p>
                                    <div class="d-flex flex-row" style="gap:5px">
                                        <div class="d-flex flex-row" style="gap: 5px">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                        </div>
                                        <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">2 days ago</p>

                                    </div>

                                </div>

                            </div>
                            <p class="testimoni-review">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis</p>

                            <div class="testimoni-footer d-flex flex-row justify-content-between">
                                <div class="d-flex flex-row">
                                    <img src="{{ asset('assets/icons/icon_likes.svg') }}" alt="Like" height="16" width="16">
                                    <p class="membantu-text">Membantu</p>
                                </div>
                                <p class="lihat-testimoni-text">Lihat selengkapnya</p>

                            </div>
                                
                        </div>
                        <div class="testimoni-card d-flex flex-column">
                            <div class="testimoni-header d-flex flex-row">
                                <img src="{{ asset('assets/course/testimoni_default_profile.svg') }}" 
                                class="rounded-circle testimoni-profile" 
                                width="55" 
                                height="55" 
                                >
                                <div class="testimoni-name d-flex flex-column">
                                    <p class="fw-bold">Vynne</p>
                                    <div class="d-flex flex-row" style="gap:5px">
                                        <div class="d-flex flex-row" style="gap: 5px">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                        </div>
                                        <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">2 days ago</p>

                                    </div>

                                </div>

                            </div>
                            <p class="testimoni-review">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis</p>

                            <div class="testimoni-footer d-flex flex-row justify-content-between">
                                <div class="d-flex flex-row">
                                    <img src="{{ asset('assets/icons/icon_likes.svg') }}" alt="Like" height="16" width="16">
                                    <p class="membantu-text">Membantu</p>
                                </div>
                                <p class="lihat-testimoni-text">Lihat selengkapnya</p>

                            </div>
                                
                        </div>
                        <div class="testimoni-card d-flex flex-column">
                            <div class="testimoni-header d-flex flex-row">
                                <img src="{{ asset('assets/course/testimoni_default_profile.svg') }}" 
                                class="rounded-circle testimoni-profile" 
                                width="55" 
                                height="55" 
                                >
                                <div class="testimoni-name d-flex flex-column">
                                    <p class="fw-bold">Vynne</p>
                                    <div class="d-flex flex-row" style="gap:5px">
                                        <div class="d-flex flex-row" style="gap: 5px">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                        </div>
                                        <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">2 days ago</p>

                                    </div>

                                </div>

                            </div>
                            <p class="testimoni-review">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis</p>

                            <div class="testimoni-footer d-flex flex-row justify-content-between">
                                <div class="d-flex flex-row">
                                    <img src="{{ asset('assets/icons/icon_likes.svg') }}" alt="Like" height="16" width="16">
                                    <p class="membantu-text">Membantu</p>
                                </div>
                                <p class="lihat-testimoni-text">Lihat selengkapnya</p>

                            </div>
                                
                        </div>

                    </div>

                    <div class="testimoni-button d-flex justify-content-center align-items-center">
                        <a href="#">
                            <button class="testimoni-btn"><p>Lihat selengkapnya</p></button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="width: 40%;">
            <div class="benefit-card d-flex flex-column">
                <p class="benefit-title text-start fw-bold">Benefit Kursus</p>
                <hr class="benefit-divider">
                <div class="benefit-list d-flex flex-column">
                    <div class="list-benefit d-flex flex-row">
                        <img src="{{ asset('assets/icons/icon_video_gradient.svg') }}" alt="Like" height="24" width="24">
                        <p>15 Video materi pembelajaran step-by-step</p>
                    </div>
                    <div class="list-benefit d-flex flex-row">
                        <img src="{{ asset('assets/icons/icon_video_gradient.svg') }}" alt="Like" height="24" width="24">
                        <p>15 Video materi pembelajaran step-by-step</p>
                    </div>
                    <div class="list-benefit d-flex flex-row">
                        <img src="{{ asset('assets/icons/icon_video_gradient.svg') }}" alt="Like" height="24" width="24">
                        <p>15 Video materi pembelajaran step-by-step</p>
                    </div>
                    <div class="list-benefit d-flex flex-row">
                        <img src="{{ asset('assets/icons/icon_video_gradient.svg') }}" alt="Like" height="24" width="24">
                        <p>15 Video materi pembelajaran step-by-step</p>
                    </div>
                    <div class="list-benefit d-flex flex-row">
                        <img src="{{ asset('assets/icons/icon_video_gradient.svg') }}" alt="Like" height="24" width="24">
                        <p>15 Video materi pembelajaran step-by-step</p>
                    </div>

                </div>

                <button type="submit" class="btn w-100 text-dark yellow-gradient-btn">Daftar Sekarang</button>

            </div>

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

    .testimoni-recap p{
        margin: 0;
        font-size: 22px;
        font-weight: 600;
        color: var(--black-color);
    }

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
@endsection