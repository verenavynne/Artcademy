@extends('layouts.master')

@section('content')



<div class="container-fluid d-flex flex-column justify-content-center" style="margin-bottom: 75px;">
    <div class="d-flex justify-content-center align-items-center px-5 gap-5 w-100">
        <form class="d-flex w-100" method="GET" action="{{route('course')}}">
            <div class="position-relative w-100">
           
                <input 
                    class="form-control" 
                    type="text" 
                    placeholder="Mau belajar apa hari ini?" 
                    aria-label="Search" 
                    name="query"
                    value="{{ request('query') }}"
                >

                <button 
                    type="submit" 
                    class="icon-btn btn position-absolute end-0 top-50 translate-middle-y p-0 border-0 bg-transparent"
                    style="z-index: 2;"
                >
                    <img src="{{ asset('assets/icons/icon_search.svg') }}" alt="Search" style="width: 24px; height: 24px;">
                </button>
            </div>
        </form>
        <div class="d-flex flex-row gap-5">
            <a href="#">
                <img src="{{ asset('assets/icons/icon_bookmark.svg') }}" alt="Bookmark" style="width: 24px; height: 24px;">
            </a>
            <a href="#">
                <img src="{{ asset('assets/icons/icon_notif.svg') }}" alt="Notification" style="width: 24px; height: 24px;">
            </a>
        </div>
    </div>

    <div class="d-flex flex-row justify-content-center align-items-center category-btn-group px-5 gap-4">
        <a href="#" >
            <button class="category-btn filter-icon"><img src="{{ asset('assets/icons/icon_filter.svg') }}" alt="Filter"></button>
        </a>
        <a href="{{ route('course', ['type' => null]) }}">
            <button class="category-btn {{ request('type') === null ? 'active' : '' }}">Semua</button>
        </a>
        <a href="{{ route('course', ['type' => 'Seni Lukis & Digital Art']) }}">
            <button class="category-btn {{ request('type') === 'Seni Lukis & Digital Art' ? 'active' : '' }}">Seni Lukis & Digital Art</button>
        </a>
        <a href="{{ route('course', ['type' => 'Seni Musik']) }}">
            <button class="category-btn {{ request('type') === 'Seni Musik' ? 'active' : '' }}">Seni Musik</button>
        </a>
        <a href="{{ route('course', ['type' => 'Seni Fotografi']) }}">
            <button class="category-btn {{ request('type') === 'Seni Fotografi' ? 'active' : '' }}">Seni Fotografi</button>
        </a>
        <a href="{{ route('course', ['type' => 'Seni Tari']) }}">
            <button class="category-btn {{ request('type') === 'Seni Tari' ? 'active' : '' }}">Seni Tari</button>
        </a>
    </div>

    <div class="container-fluid px-5 pb-4">
        <p class="title-dasar text-start fw-bold mb-3">Level Dasar</p>
        <p class="text-start" style="font-size: var(--font-size-normal)">Baru mulai? No worries! Di sini tempat paling pas buat kamu yang lagi cari pondasi kuat di dunia seni</p>
    </div>


    <div class="container-fluid d-flex flex-column px-5 align-items-center">
        @if ($dasarCourses->isEmpty())
            <p class="text-center text-muted" style="font-size: var(--font-size-normal)">
                Belum ada kursus untuk level dasar saat ini.
            </p>
        @else
        <div class="d-flex flex-wrap justify-content-center" style="gap: 36px">
                <!-- Course Card -->
            @foreach ($dasarCourses as $course)
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

            @endphp
                <div class="course-card card article-card" height="100%">
                    <div class="course-card-header d-flex flex-column justify-content-between" style="background: {{ $backgroundColor }}">
                        <div class="course-type-text-container mb-2" style="background: {{ $backgroundCourseTypeText }}">
                            <p style="margin: 0; color: white; font-size: var(--font-size-mini)" >{{ $course->courseType }}</p>
                        </div>
                        <p style="margin: 0; color: black; font-size: var(--font-size-tiny); font-weight: 700">{{ $course->courseName }}</p>
                        <div class="d-flex flex-row justify-content-center align-items-center gap-3" >
                            <div class="course-time-container d-flex flex-row gap-1 mb-2">
                                <img src="{{ asset('assets/icons/icon_clock.svg') }}" alt="Clock" height="18" width="18">
                                <p style="margin:0; color: black; font-size: var(--font-size-mini)">{{$jam}} Jam {{$menit}} Menit</p>
                            </div>
                            <img src="{{ asset($course->coursePicture ) }}" alt="Course Picture" width="110" height="80" style="">
                        </div>
                    </div>
                    <div class="course-card-bottom d-flex flex-column align-items-start">
                        <div class="d-flex flex-row justify-content-space-between gap-2">
                            <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700">{{ $course->courseName }}</p>
                            <img src="{{ asset('assets/icons/icon_bookmark.svg') }}" alt="Bookmark" style="height: 24px; width: 24px">
                        </div>
                        <div class="d-flex flex-row align-items-center gap-2">
                             <div class="position-relative" style="width: 90px; height: 37px;">
                                @foreach ($course->courseLecturers->take(3) as $loopIndex => $courseLecturer )
                                    <img src="{{ asset($courseLecturer->lecturer->user->profilePicture ?? 'assets/default-profile.jpg') }}" 
                                    class="rounded-circle position-absolute tutor-image" 
                                    width="37" 
                                    height="37" 
                                    style="left: {{ 25 * $loopIndex }}px; z-index: {{ $loopIndex + 1 }};">
                                @endforeach
                            </div>
                            <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">
                                Tutor: {{ $course->courseLecturers->take(3)->pluck('lecturer.user.name')->filter()->implode(', ') }}</p>
                        </div>
                        <div class="d-flex flex-row align-items-center" style="gap:5px">
                            <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700; color: var(--dark-gray-color) ">{{ $course->courseReview }}</p>
                            <div class="d-flex flex-row" style="gap: 5px">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                            </div>
                            <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">(300+ reviews)</p>
                        </div>
                        <div class="course-level-text-container" style="background: {{ $backgroundCourseLevel }}">
                            <p class="course-level-text" style="background: {{ $backgroundCourseLevelText }}; margin: 0; background-clip: text; font-weight: 700 ">Level {{ $course->courseLevel }}</p>
                        </div>

                    </div>
                </div>
            @endforeach
                
        </div>
        @endif
    </div>

    <div class="container-fluid px-5 pb-4" style="margin-top: 80px;">
        <p class="title-menengah text-start fw-bold mb-3">Level Menengah</p>
        <p class="text-start" style="font-size: var(--font-size-normal)">Udah ngerti dasar-dasarnya? Saatnya upgrade skill, eksplor teknik baru, dan asah gaya unikmu</p>
    </div>

        <div class="container-fluid d-flex flex-column px-5 align-items-center">
        @if ($menengahCourses->isEmpty())
            <p class="text-center text-muted" style="font-size: var(--font-size-normal)">
                Belum ada kursus untuk level menengah saat ini.
            </p>
        @else
        <div class="d-flex flex-wrap justify-content-center" style="gap: 36px">
                <!-- Course Card -->
            @foreach ($menengahCourses as $course)
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

            @endphp
                <div class="course-card card article-card" height="100%">
                    <div class="course-card-header d-flex flex-column justify-content-between" style="background: {{ $backgroundColor }}">
                        <div class="course-type-text-container mb-2" style="background: {{ $backgroundCourseTypeText }}">
                            <p style="margin: 0; color: white; font-size: var(--font-size-mini)" >{{ $course->courseType }}</p>
                        </div>
                        <p style="margin: 0; color: black; font-size: var(--font-size-tiny); font-weight: 700">{{ $course->courseName }}</p>
                        <div class="d-flex flex-row justify-content-center align-items-center gap-3" >
                            <div class="course-time-container d-flex flex-row gap-1 mb-2">
                                <img src="{{ asset('assets/icons/icon_clock.svg') }}" alt="Clock" height="18" width="18">
                                <p style="margin:0; color: black; font-size: var(--font-size-mini)">{{$jam}} Jam {{$menit}} Menit</p>
                            </div>
                            <img src="{{ asset($course->coursePicture ) }}" alt="Course Picture" width="110" height="80" style="">
                        </div>
                    </div>
                    <div class="course-card-bottom d-flex flex-column align-items-start">
                        <div class="d-flex flex-row justify-content-space-between gap-2">
                            <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700">{{ $course->courseName }}</p>
                            <img src="{{ asset('assets/icons/icon_bookmark.svg') }}" alt="Bookmark" style="height: 24px; width: 24px">
                        </div>
                        <div class="d-flex flex-row align-items-center gap-2">
                             <div class="position-relative" style="width: 90px; height: 37px;">
                                @foreach ($course->courseLecturers->take(3) as $loopIndex => $courseLecturer )
                                    <img src="{{ asset($courseLecturer->lecturer->user->profilePicture ?? 'assets/default-profile.jpg') }}" 
                                    class="rounded-circle position-absolute tutor-image" 
                                    width="37" 
                                    height="37" 
                                    style="left: {{ 25 * $loopIndex }}px; z-index: {{ $loopIndex + 1 }};">
                                @endforeach
                            </div>
                            <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">
                                Tutor: {{ $course->courseLecturers->take(3)->pluck('lecturer.user.name')->filter()->implode(', ') }}</p>
                        </div>
                        <div class="d-flex flex-row align-items-center" style="gap:5px">
                            <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700; color: var(--dark-gray-color) ">{{ $course->courseReview }}</p>
                            <div class="d-flex flex-row" style="gap: 5px">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                            </div>
                            <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">(300+ reviews)</p>
                        </div>
                        <div class="course-level-text-container" style="background: {{ $backgroundCourseLevel }}">
                            <p class="course-level-text" style="background: {{ $backgroundCourseLevelText }}; margin: 0; background-clip: text; font-weight: 700 ">Level {{ $course->courseLevel }}</p>
                        </div>

                    </div>
                </div>
            @endforeach
                
        </div>
        @endif
    </div>

    <div class="container-fluid px-5 pb-4" style="margin-top: 80px;">
        <p class="title-lanjutan text-start fw-bold mb-3">Level Lanjutan</p>
        <p class="text-start" style="font-size: var(--font-size-normal)">Siap naik ke level pro? Tantang dirimu, perdalam skill, dan siapin karya buat dunia lihat</p>
    </div>

        <div class="container-fluid d-flex flex-column px-5 align-items-center">
        @if ($lanjutanCourses->isEmpty())
            <p class="text-center text-muted" style="font-size: var(--font-size-normal)">
                Belum ada kursus untuk level lanjutan saat ini.
            </p>
        @else
        <div class="d-flex flex-wrap justify-content-center" style="gap: 36px">
                <!-- Course Card -->
            @foreach ($lanjutanCourses as $course)
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

            @endphp
                <div class="course-card card article-card" height="100%">
                    <div class="course-card-header d-flex flex-column justify-content-between" style="background: {{ $backgroundColor }}">
                        <div class="course-type-text-container mb-2" style="background: {{ $backgroundCourseTypeText }}">
                            <p style="margin: 0; color: white; font-size: var(--font-size-mini)" >{{ $course->courseType }}</p>
                        </div>
                        <p style="margin: 0; color: black; font-size: var(--font-size-tiny); font-weight: 700">{{ $course->courseName }}</p>
                        <div class="d-flex flex-row justify-content-center align-items-center gap-3" >
                            <div class="course-time-container d-flex flex-row gap-1 mb-2">
                                <img src="{{ asset('assets/icons/icon_clock.svg') }}" alt="Clock" height="18" width="18">
                                <p style="margin:0; color: black; font-size: var(--font-size-mini)">{{$jam}} Jam {{$menit}} Menit</p>
                            </div>
                            <img src="{{ asset($course->coursePicture ) }}" alt="Course Picture" width="110" height="80" style="">
                        </div>
                    </div>
                    <div class="course-card-bottom d-flex flex-column align-items-start">
                        <div class="d-flex flex-row justify-content-space-between gap-2">
                            <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700">{{ $course->courseName }}</p>
                            <img src="{{ asset('assets/icons/icon_bookmark.svg') }}" alt="Bookmark" style="height: 24px; width: 24px">
                        </div>
                        <div class="d-flex flex-row align-items-center gap-2">
                             <div class="position-relative" style="width: 90px; height: 37px;">
                                @foreach ($course->courseLecturers->take(3) as $loopIndex => $courseLecturer )
                                    <img src="{{ asset($courseLecturer->lecturer->user->profilePicture ?? 'assets/default-profile.jpg') }}" 
                                    class="rounded-circle position-absolute tutor-image" 
                                    width="37" 
                                    height="37" 
                                    style="left: {{ 25 * $loopIndex }}px; z-index: {{ $loopIndex + 1 }};">
                                @endforeach
                            </div>
                            <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">
                                Tutor: {{ $course->courseLecturers->take(3)->pluck('lecturer.user.name')->filter()->implode(', ') }}</p>
                        </div>
                        <div class="d-flex flex-row align-items-center" style="gap:5px">
                            <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700; color: var(--dark-gray-color) ">{{ $course->courseReview }}</p>
                            <div class="d-flex flex-row" style="gap: 5px">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                            </div>
                            <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">(300+ reviews)</p>
                        </div>
                        <div class="course-level-text-container" style="background: {{ $backgroundCourseLevel }}">
                            <p class="course-level-text" style="background: {{ $backgroundCourseLevelText }}; margin: 0; background-clip: text; font-weight: 700 ">Level {{ $course->courseLevel }}</p>
                        </div>

                    </div>
                </div>
            @endforeach
                
        </div>
        @endif
    </div>

    @if(is_null($type))
    <div class="container-fluid px-5 pb-4" style="margin-top: 80px;">
        <p class="title-lanjutan text-start fw-bold mb-3">Semua Kursus</p>
        <p class="text-start" style="font-size: var(--font-size-normal)">Asah skill mu dan jelajahi berbagai kursus yang sesuai dengan bidangmu</p>
    </div>

    <div class="container-fluid d-flex flex-column px-5 align-items-center">
        <div class="d-flex flex-wrap justify-content-center" style="gap: 36px">
            @foreach ($courses as $course)
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

            @endphp
                <div class="course-card card article-card" height="100%">
                    <div class="course-card-header d-flex flex-column justify-content-between" style="background: {{ $backgroundColor }}">
                        <div class="course-type-text-container mb-2" style="background: {{ $backgroundCourseTypeText }}">
                            <p style="margin: 0; color: white; font-size: var(--font-size-mini)" >{{ $course->courseType }}</p>
                        </div>
                        <p style="margin: 0; color: black; font-size: var(--font-size-tiny); font-weight: 700">{{ $course->courseName }}</p>
                        <div class="d-flex flex-row justify-content-center align-items-center gap-3" >
                            <div class="course-time-container d-flex flex-row gap-1 mb-2">
                                <img src="{{ asset('assets/icons/icon_clock.svg') }}" alt="Clock" height="18" width="18">
                                <p style="margin:0; color: black; font-size: var(--font-size-mini)">{{$jam}} Jam {{$menit}} Menit</p>
                            </div>
                            <img src="{{ asset($course->coursePicture ) }}" alt="Course Picture" width="110" height="80" style="">
                        </div>
                    </div>
                    <div class="course-card-bottom d-flex flex-column align-items-start">
                        <div class="d-flex flex-row justify-content-space-between gap-2">
                            <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700">{{ $course->courseName }}</p>
                            <img src="{{ asset('assets/icons/icon_bookmark.svg') }}" alt="Bookmark" style="height: 24px; width: 24px">
                        </div>
                        <div class="d-flex flex-row align-items-center gap-2">
                             <div class="position-relative" style="width: 90px; height: 37px;">
                                @foreach ($course->courseLecturers->take(3) as $loopIndex => $courseLecturer )
                                    <img src="{{ asset($courseLecturer->lecturer->user->profilePicture ?? 'assets/default-profile.jpg') }}" 
                                    class="rounded-circle position-absolute tutor-image" 
                                    width="37" 
                                    height="37" 
                                    style="left: {{ 25 * $loopIndex }}px; z-index: {{ $loopIndex + 1 }};">
                                @endforeach
                            </div>
                            <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">
                                Tutor: {{ $course->courseLecturers->take(3)->pluck('lecturer.user.name')->filter()->implode(', ') }}</p>
                        </div>
                        <div class="d-flex flex-row align-items-center" style="gap:5px">
                            <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700; color: var(--dark-gray-color) ">{{ $course->courseReview }}</p>
                            <div class="d-flex flex-row" style="gap: 5px">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                                <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                            </div>
                            <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">(300+ reviews)</p>
                        </div>
                        <div class="course-level-text-container" style="background: {{ $backgroundCourseLevel }}">
                            <p class="course-level-text" style="background: {{ $backgroundCourseLevelText }}; margin: 0; background-clip: text; font-weight: 700 ">Level {{ $course->courseLevel }}</p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

     <div class="d-flex justify-content-center mt-4 ">
        {{ $courses->links('pagination::bootstrap-5') }}
    </div>

    @endif

</div>

<style>
    .form-control{
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        border-radius: 1000px ;
        background-color: white;
        height: 56px;
        padding-left: 30px;
        padding-right: 30px;

    }

    .icon-btn{
        margin-inline-end: 30px;
    }

    .title-dasar{
        font-size: var(--font-size-title); 
        background:var(--orange-gradient-color); 
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .title-menengah{
        font-size: var(--font-size-title); 
        background: var(--blue-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .title-lanjutan{
        font-size: var(--font-size-title); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .pagination {
        margin-top: 58px;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .pagination .page-item .page-link {
        border: none;
        color: var(----dark-gray-color);
        font-size: var(--font-size-normal);
        background-color: transparent;
    }

    .pagination .page-item.active .page-link {
        text-decoration: underline;
        background-color: transparent;
        font-weight: 700;
    }

    .pagination .page-item.next .page-link,
    .pagination .page-item.prev .page-link{
        background: var(--yellow-gradient-color);
        border-radius: 50%;
        color: black;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: box-shadow: 0px 7.571px 15.143px 0px rgba(67, 39, 0, 0.20);
    }
</style>
@endsection