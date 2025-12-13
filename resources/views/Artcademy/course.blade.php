@extends('layouts.master')

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <div class="d-flex align-items-center gap-4 pt-1 w-100">
        <div class="position-relative flex-grow-1">
            <form class="d-flex w-100" method="GET" action="{{route('course')}}">
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

    <div class="d-flex flex-row justify-content-center align-items-center category-btn-group gap-4">
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

    <div class="container-fluid pb-4">
        <p class="title-dasar text-start fw-bold mb-3">Level Dasar</p>
        <p class="text-start" style="font-size: var(--font-size-primary)">Baru mulai? No worries! Di sini tempat paling pas buat kamu yang lagi cari pondasi kuat di dunia seni</p>
    </div>


    <div class="container-fluid d-flex flex-column align-items-center">
        @if ($dasarCourses->isEmpty())
            <p class="text-center text-muted" style="font-size: var(--font-size-primary)">
                Belum ada kursus untuk level dasar saat ini.
            </p>
        @else
        <div class="d-flex flex-wrap justify-content-center" style="gap: 35px">
                <!-- Course Card -->
            @foreach ($dasarCourses as $course)
                @if($course->isEnrolled)
                    @include('components.course-ongoing-card', [
                        'enrollment' => $course->enrollment,
                        'course' => $course
                    ])
                @else
                    @include('components.course-card', ['course' => $course])
                @endif
            @endforeach
                
        </div>
        @endif
    </div>

    <div class="container-fluid pb-4" style="margin-top: 80px;">
        <p class="title-menengah text-start fw-bold mb-3">Level Menengah</p>
        <p class="text-start" style="font-size: var(--font-size-primary)">Udah ngerti dasar-dasarnya? Saatnya upgrade skill, eksplor teknik baru, dan asah gaya unikmu</p>
    </div>

    <div class="container-fluid d-flex flex-column align-items-center">
        @if ($menengahCourses->isEmpty())
            <p class="text-center text-muted" style="font-size: var(--font-size-primary)">
                Belum ada kursus untuk level menengah saat ini.
            </p>
        @else
        <div class="d-flex flex-wrap justify-content-center" style="gap: 35px">
                <!-- Course Card -->
            @foreach ($menengahCourses as $course)
               @if($course->isEnrolled)
                    @include('components.course-ongoing-card', [
                        'enrollment' => $course->enrollment,
                        'course' => $course
                    ])
                @else
                    @include('components.course-card', ['course' => $course])
                @endif
            @endforeach
                
        </div>
        @endif
    </div>

    <div class="container-fluid pb-4" style="margin-top: 80px;">
        <p class="title-lanjutan text-start fw-bold mb-3">Level Lanjutan</p>
        <p class="text-start" style="font-size: var(--font-size-primary)">Siap naik ke level pro? Tantang dirimu, perdalam skill, dan siapin karya buat dunia lihat</p>
    </div>

    <div class="container-fluid d-flex flex-column  align-items-center">
        @if ($lanjutanCourses->isEmpty())
            <p class="text-center text-muted" style="font-size: var(--font-size-primary)">
                Belum ada kursus untuk level lanjutan saat ini.
            </p>
        @else
        <div class="d-flex flex-wrap justify-content-center" style="gap: 35px">
                <!-- Course Card -->
            @foreach ($lanjutanCourses as $course)
                @if($course->isEnrolled)
                    @include('components.course-ongoing-card', [
                        'enrollment' => $course->enrollment,
                        'course' => $course
                    ])
                @else
                    @include('components.course-card', ['course' => $course])
                @endif
            @endforeach
                
        </div>
        @endif
    </div>

    @if(is_null($type))
    <div class="container-fluid pb-4" style="margin-top: 80px;">
        <p class="title-lanjutan text-start fw-bold mb-3">Semua Kursus</p>
        <p class="text-start" style="font-size: var(--font-size-primary)">Asah skill mu dan jelajahi berbagai kursus yang sesuai dengan bidangmu</p>
    </div>

    <div class="container-fluid d-flex flex-column align-items-center">
        @if ($courses->isEmpty())
            <p class="text-center text-muted" style="font-size: var(--font-size-primary)">
                Belum ada kursus saat ini.
            </p>
        @else
        <div class="d-flex flex-wrap justify-content-center" style="gap: 35px">
            @foreach ($courses as $course)
                @if($course->isEnrolled)
                    @include('components.course-ongoing-card', [
                        'enrollment' => $course->enrollment,
                        'course' => $course
                    ])
                @else
                    @include('components.course-card', ['course' => $course])
                @endif
            @endforeach
        </div>
        @endif
    </div>

     <div class="d-flex justify-content-center mt-4 ">
        {{ $courses->links('pagination::bootstrap-5') }}
    </div>

    @endif

</div>

<style>
    .form-search{
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        border-radius: 1000px ;
        background-color: white;
        height: 56px;
        padding-left: 30px;
        padding-right: 30px;

    }

    .icon-search{
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
</style>

@endsection