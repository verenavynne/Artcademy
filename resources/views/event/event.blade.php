@extends('layouts.master')

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <div class="d-flex align-items-center gap-4 pt-1 w-100 pb-4">
        <div class="position-relative flex-grow-1">
            <form class="d-flex w-100" method="GET" action="{{ route('event') }}">
                <input 
                    type="text" 
                    class="custom-input-2 form-control rounded-pill" 
                    placeholder="Cari event apa hari ini?"
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

    <div class="container-fluid pb-4">
        <p class="title text-start fw-bold mb-3">Webinar</p>
        <p class="text-start" style="font-size: var(--font-size-normal)">Dengerin langsung cerita dan insight dari seniman & kreator keren. Siap-siap dapet insight baru di tiap sesi!</p>

        <div class="d-flex flex-wrap justify-content-center" style="gap: 36px">
            @foreach ($webinars as $event )
                @include('components.event-card' ,['event' => $event])
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4 ">
            {{ $webinars->links('pagination::bootstrap-5') }}
        </div>
    </div>

  

    <div class="container-fluid pb-4">
        <p class="title text-start fw-bold mb-3">Workshop</p>
        <p class="text-start" style="font-size: var(--font-size-normal)">Workshop seru buat kamu yang siap eksplor, eksperimen, dan bikin karya nyata bareng tutor</p>

        <div class="d-flex flex-wrap justify-content-center" style="gap: 36px">
            @foreach ($workshops as $event )
                @include('components.event-card' ,['event' => $event])
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4 ">
            {{ $workshops->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection