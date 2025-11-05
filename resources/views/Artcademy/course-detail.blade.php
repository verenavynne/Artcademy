@extends('layouts.master')

@section('content')

@if (session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif

@if (session('info'))
    <div class="alert alert-warning mt-3">{{ session('info') }}</div>
@endif

@php

    $backgroundColor = match($course->courseType) {
        'Seni Lukis & Digital Art' => 'var(--orange-gradient-color)',    
        'Seni Tari' => 'var(--pink-gradient-color)',         
        'Seni Fotografi' => 'var(--blue-gradient-color)',     
        'Seni Musik' => 'var(--yellow-gradient-color)', 
    };

    $backgroundCourseTypeText = match($course->courseType){
        'Seni Lukis & Digital Art' => '#D99F18',    
        'Seni Tari' => '#E24D77',         
        'Seni Fotografi' => '#4296CC',     
        'Seni Musik' => '#D5B91B', 
    };

    $backgroundCourseLevel= match($course->courseLevel){
        'dasar' => ' #FFEFDE',    
        'menengah' => '#E7F6FE',         
        'lanjutan' => '#FFEAF0', 
    };

    $backgroundCourseLevelText = match($course->courseLevel){
        'dasar' => 'var(--orange-gradient-color)',    
        'menengah' => 'var(--blue-gradient-color)',         
        'lanjutan' => 'var(--pink-gradient-color)', 
    };

    $jam = floor($course->courseDurationInMinutes / 60);
    $menit = $course->courseDurationInMinutes % 60;

        $testimonis = [
        ['name' => 'Vynne', 'rating' => 5, 'time' => '2 days ago', 'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis'],
        ['name' => 'Vynne', 'rating' => 5, 'time' => '2 days ago', 'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis'],
        ['name' => 'Vynne', 'rating' => 5, 'time' => '2 days ago', 'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis'],
        ['name' => 'Vynne', 'rating' => 5, 'time' => '2 days ago', 'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis'],
    ];
@endphp

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">

    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-center gap-5">
        <!-- Sisi Kiri -->
        <div class="d-flex flex-column" style="width: 60%;">
            <div class="course-card-detail card d-flex flex-row" style="background: {{ $backgroundColor }}">
                <div class="course-card-detail-content d-flex flex-column justify-content-center" style="gap: 12px; padding-inline-end: 26px">
                    <p style="margin:0; font-size: var(--font-size-big); font-weight: 700">{{ $course->courseName }}</p>
                    <div class="d-flex flex-row gap-5">
                        <div class="d-flex flex-column" style="gap:12px">
                           <p style="margin:0; font-size: var(--font-size-small);">{{ $course->courseSummary }}</p>
                           <div class="course-time-container d-flex flex-row gap-1 mb-2">
                                <img src="{{ asset('assets/icons/icon_clock.svg') }}" alt="Clock" height="24" width="24">
                                <p style="margin:0; color: black; font-size: var(--font-size-small)">{{ $jam }} Jam {{ $menit }} Menit</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column ps-5" style="gap: 22px">
                    <div class="d-flex justify-content-end">
                        <div class="course-card-detail-header d-flex" style="background:{{ $backgroundCourseTypeText }}; ">
                            <p style="margin: 0; color: white; font-size: var(--font-size-small)" >{{ $course->courseType }}</p>
                        </div>

                    </div>
                    <div class="d-flex flex-start pe-5">
                        <img src="{{ asset($course->coursePicture) }}" alt="Course Picture" width="176" height="126" style="">

                    </div>
                </div>

            </div>
            <div class="d-flex flex-column" style="gap: 22px;">
                <div class="d-flex flex-row justify-content-between">
                    <p style="margin:0; font-size: var(--font-size-big); font-weight: 700">{{ $course->courseName }}</p>
                    <a href="#">
                        <img src="{{ asset('assets/icons/icon_bookmark.svg') }}" alt="Bookmark" style="width: 24px; height: 24px;">
                    </a>
                </div>
                 <div class="course-level-text-container" style="background: {{ $backgroundCourseLevel }}">
                    <p class="course-level-text" style="background: {{ $backgroundCourseLevelText }}; margin: 0; background-clip: text; font-weight: 700; font-size:var(--font-size-small)">Level {{ ucfirst($course->courseLevel) }}</p>
                </div>

                <div class="d-flex flex-row align-items-center" style="gap:5px">
                    <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700; color: var(--dark-gray-color) ">{{ $course->courseReview }}</p>
                    <div class="d-flex flex-row" style="gap: 5px">
                        @for ($i = 0; $i < 5; $i++)
                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                        @endfor
                    </div>
                    <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">(300+ reviews)</p>
                </div>
            </div>

            <div class="d-flex flex-row category-btn-group gap-4 py-4">
                <button class="category-btn" data-target="deskripsi-section">Deskripsi</button>

                <button class="category-btn" data-target="silabus-section">Silabus</button>

                <button class="category-btn" data-target="tutor-section">Tutor</button>

                <button class="category-btn" data-target="zoom-section">Kelas Zoom</button>

                <button class="category-btn" data-target="testimoni-section">Testimoni</button>
            </div>

            <div id="deskripsi-section" class="description-section d-flex flex-column">
                <p class="title text-start fw-bold">Deskripsi Khusus</p>
                <p class="text-start sub-title">{{ $course->courseText }}</p>
            </div>

            <hr class="divider">

            <!-- Sylabus Section -->
            <div id="silabus-section" class="sylabus-section d-flex flex-column">
                <p class="title text-start fw-bold">Silabus</p>
                <div class="minggu-section-container d-flex flex-column">
                    @foreach ($course->weeks as $week)
                        <div class="minggu-section d-flex flex-column">
                            <div class="minggu-container d-flex flex-row">
                                <p class="minggu-title">{{ $week->weekName }}</p>
                                <img src="{{ asset('assets/icons/icon_arrow_down.svg') }}" alt="Arrow Icon" class="arrow-icon" width="24" height="24" style="">
                            </div>
                            <div class="minggu-materi-container flex-column" >
                                @foreach ($week->materials as $index => $material)
                                    <div class="materi-line d-flex flex-row">
                                        <div class="materi-title d-flex flex-row align-items-center">
                                            <div class="materi-number"><p>{{ $index + 1 }}</p></div>
                                            @if ($material->vblName !== null)
                                                <p>{{ $material->vblName }}</p>
                                            @elseif ($material->articleName !== null)
                                                <p>{{ $material->articleName}}</p>
                                            @endif
                                        </div>
            
                                        <div class="materi-icon d-flex flex-row">
                                            @if ($material->vblName !== null)
                                                <img src="{{ asset('assets/icons/icon_video.svg') }}" width="24" height="24">
                                                <p>Video</p>
                                            @elseif ($material->articleName !== null)
                                                <img src="{{ asset('assets/icons/icon_article.svg') }}" width="24" height="24">
                                                <p>Artikel</p>
                                            @endif
                                        </div>
            
                                        <div class="materi-icon d-flex flex-row">
                                            <img src="{{ asset('assets/icons/icon_time.svg') }}" alt="Time Icon" width="24" height="24" style="">
                                            <p>{{ $material->duration }} menit</p>
                                        </div>
                                    </div>
                                @endforeach
        
        
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            </div>

            <hr class="divider">

            <!-- Projek Akhir -->
            <div class="projek-section d-flex flex-column">
                <p class="title text-start fw-bold">Projek Akhir</p>
                    @include('components.course-project-card',[
                        'project' => $project,
                        'projectTools'=>$projectTools,
                        'projectCriterias' => $projectCriterias
                        ])

            </div>

            <hr class="divider">

            <!-- Tutor Section -->
            <div id="tutor-section" class="tutor-section d-flex flex-column">
                <p class="title text-start fw-bold">Tutor</p>
                <div class="tutor-card-container d-flex flex-row">
                    @foreach ($course->courseLecturers as $tutor)
                        @include('components.tutor-card', ['tutor'=>$tutor])
                    @endforeach
                </div>
            </div>

            <hr class="divider">

            <!-- Kelas Zoom Section -->
            <div id="zoom-section" class="zoom-section d-flex flex-column">
            <p class="title text-start fw-bold">Kelas Zoom</p>
            <div class="zoom-card-container">
                @foreach($course->zooms as $zoom)
                    @include('components.zoom-card',['zoom' => $zoom])
                @endforeach
            </div>
            </div>

            <hr class="divider">

            <!-- Testimoni Section -->
            <div id="testimoni-section" class="testimoni-section d-flex flex-column">
                <p class="title text-start fw-bold">Testimoni</p>
                <div class="testimoni-wrapper d-flex flex-column" style="gap: 28px">
                    <div class="testimoni-recap d-flex flex-row gap-2">
                        <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                        <p style="margin: 0">4.6 / 5.0</p>
                    </div>

                    <div class="d-flex flex-row review-btn-group gap-4">
                        <a href="#">
                            <button class="review-btn active">Semua</button>
                        </a>
                        <a href="#">
                            <button class="review-btn d-flex flex-row align-items-center justify-content-center">
                            <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                5(60)
                            </button>
                        </a>
                        <a href="#">
                            <button class="review-btn d-flex flex-row align-items-center justify-content-center">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                4(41)
                            </button>
                        </a>
                        <a href="#">
                            <button class="review-btn d-flex flex-row align-items-center justify-content-center">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                3(15)</button>
                        </a>
                        <a href="#">
                            <button class="review-btn d-flex flex-row align-items-center justify-content-center">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                2(1)
                            </button>
                        </a>
                        <a href="#">
                            <button class="review-btn d-flex flex-row align-items-center justify-content-center">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                                1(0)
                            </button>
                        </a>
                    </div>

                    <div class="testimoni-card-container flex-wrap gap-4">
                        @foreach ($testimonis as $testimoni)
                            @include('components.testimoni-card',['testimoni'=>$testimoni])
                        @endforeach
                    </div>


                    <div class="testimoni-button d-flex justify-content-center align-items-center">
                        <a href="#">
                            <button class="testimoni-btn"><p>Lihat selengkapnya</p></button>
                        </a>
                    </div>

                </div>
            </div>

            <hr class="divider">

            <!-- Carousel course card -->
            @include('components.other-course-carousel')
            
        </div>

        <!-- Sisi Kanan -->
        <div class="d-flex justify-content-center" style="width: 40%;">
            @if (Auth::check())
                @if($isEnrolled)
                    @if($isSubmitted)
                        @include('components.course-project-progress-card',['isSubmitted' => $isSubmitted, 'isDisabled' => $isDisabled,'submission' => $submission])
                    @else
                        @php
                            $unlockedWeeks = $course->weeks->filter(function($week) use ($weekProgress) {
                                $progress = $weekProgress[$week->id] ?? null;
                                return $progress && $progress->status === 'unlocked';
                            });

                            $latestUnlockedWeek = $unlockedWeeks->last();
                        @endphp

                        @if ($latestUnlockedWeek)
                            @include('components.course-week-start-progress-card', [
                                'week' => $latestUnlockedWeek,
                                'index' => $loop->index ?? 0,
                                'weekProgress' => $weekProgress,
                                'materiProgress' => $materiProgress
                            ])
                        @endif
                    @endif
                    
                @else
                    @include('components.course-benefit-card')
                @endif
            @else
                @include('components.course-benefit-card')
            @endif

        </div>

    </div>


</div>

<style>
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

    .sub-title{
        margin: 0;
        font-size: var(--font-size-primary);
        font-weight: 400;
        color:var(--dark-gray-color)
    }

    .minggu-section-container,
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
        transition: all 0.3s ease;
        cursor: pointer;
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
        min-height: max-content;
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
        gap: 22px;
        display: none;
        animation: fadeIn 0.3s ease forwards;
    }

    .minggu-section.active .minggu-materi-container {
        display: flex;
    }

    .arrow-icon {
        transition: transform 0.3s ease;
    }

    .minggu-section.active .arrow-icon {
        transform: rotate(180deg);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .materi-line {
        font-size: var(--font-size-small);
        color: var(--black-color);
        justify-content: space-between;
        align-items: center;
        gap: 100px;
    }

    .materi-line p {
        margin: 0;
    }

    .materi-icon{
        gap: 8px;
    }

    .materi-number{
        display: flex; 
        align-items: center; 
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

    .review-btn-group{
        justify-content: space-between;
    }

    .review-btn-group a{
        text-decoration: none;
    }

    
</style>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    
    const mingguContainers = document.querySelectorAll(".minggu-container");

    mingguContainers.forEach(container => {
        container.addEventListener("click", function() {
            const parentSection = this.closest(".minggu-section"); 
            
            parentSection.classList.toggle("active");
        });
    });

    const categoryBtn = document.querySelectorAll('.category-btn');

    categoryBtn.forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            const section = document.getElementById(button.getAttribute('data-target'));
            if (section) section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });

    });

    const firstButton = document.querySelector('.category-btn[data-target="deskripsi-section"]');
    if (firstButton) {
        firstButton.classList.add("active");
    }
});


</script>