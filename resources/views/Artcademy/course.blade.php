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
                @include('components.course-card', ['course' => $course])
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
                @include('components.course-card', ['course' => $course])
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
                @include('components.course-card', ['course' => $course])
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
                @include('components.course-card', ['course' => $course])
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
</style>
@endsection