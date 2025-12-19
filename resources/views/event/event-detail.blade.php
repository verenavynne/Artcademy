@extends($layout)

@section('content')
@php
    use Carbon\Carbon;

    $startTime = Carbon::parse($event->start_time);
    $endTime = $startTime->copy()->addMinutes((int) $event->eventDuration);

    $banner = $event->eventBanner;

    $isPublicAsset = str_starts_with($banner, 'assets/');

    $bannerUrl = $isPublicAsset
        ? asset($banner)
        : asset('storage/' . $banner);

    $eventPrice = $event->eventPrice == 0 
    ? 'Gratis' 
    : 'Rp' . number_format($event->eventPrice, 0, ',', '.');

@endphp

@if (session('info'))
    <div class="alert alert-warning mt-3">{{ session('info') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5 {{ Auth::user()->role === 'student' ? '' : 'w-75' }}" style="margin-bottom: 75px;">
    <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
        <div class="navigation-prev d-flex flex-start">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </div>
    </a>
    <div class="d-flex flex-row justify-content-center gap-5">
        <div class="d-flex flex-column" style="width: {{ Auth::user()->role === 'student' ? '60%' : '100%' }}">
            <img src="{{ $bannerUrl }}" class="event-banner" alt="" height="473">

            <div class="event-description-section d-flex flex-column" style="gap: 22px; margin-block-start: 22px">
                <p class="event-name">{{ $event->eventName }}</p>
                <div class="d-flex flex-row align-items-center" style="gap: 12px">
                    <div class="progress" style="height: 6px; flex:1; background-color: #E5E5E5;">
                        <div class="progress-bar" role="progressbar" 
                        style="width: {{ $progressPeserta }}%; background-color: #E92D62;"
                        aria-valuenow=" {{ $progressPeserta }}" 
                        aria-valuemin="0" 
                        aria-valuemax="100">
                        </div>
                    </div>
                    <p class="event-peserta-progress">{{ $totalPeserta }} / {{ $quota }} peserta</p>
                </div>

                <p class="event-desc">{!! $event->eventDesc !!}</p>
            </div>

            <hr class="divider">

            <div class="jadwal-event-section">
                <p class="title text-start fw-bold">Jadwal</p>
                <div class="jadwal-list d-flex flex-row justify-content-between align-items-center">
                    <div class="jadwal d-flex flex-row align-items-center gap-2">
                        <img src="{{ asset('assets/icons/icon_calendar_gradient.svg') }}" alt="Calendar icon" height="24" width="24">
                        <p>{{ Carbon::parse($event->eventDate)->translatedFormat('d F Y') }}</p>

                    </div>
                    <div class="jadwal d-flex flex-row align-items-center gap-2">
                        <img src="{{ asset('assets/icons/icon_clock_gradient.svg') }}" alt="Clock icon" height="24" width="24">
                        <p>{{ $startTime->format('H:i') }} - {{ $endTime->format('H:i') }} WIB</p>

                    </div>
                    <div class="jadwal d-flex flex-row align-items-center gap-2">
                        <img src="{{ asset('assets/icons/icon_map_gradient.svg') }}" alt="Calendar icon" height="24" width="24">
                        <p>Zoom Meeting</p>

                    </div>

                </div>
            </div>


            <hr class="divider">

            @include('components.other-event-carousel')
        </div>

        @if(Auth::user()->role === 'student')
            <div class="d-flex justify-content-center" style="width: 40%">
                @if($isRegistered)
                    <div class="event-daftar-card d-flex flex-column">
                        <p class="event-daftar-title text-start fw-bold">Event</p>
                        <hr class="event-daftar-divider">
                        <div class="jadwal-list d-flex flex-row align-items-center justify-content-between" style="margin-block-end: 28px;">
                            <div class="jadwal d-flex flex-row align-items-center gap-2">
                                <img src="{{ asset('assets/icons/icon_calendar_gradient.svg') }}" alt="Calendar icon" height="24" width="24">
                                <p>{{Carbon::parse($event->eventDate)->translatedFormat('d F Y')}}</p>

                            </div>
                            <div class="jadwal d-flex flex-row align-items-center gap-2">
                                <img src="{{ asset('assets/icons/icon_clock_gradient.svg') }}" alt="Clock icon" height="24" width="24">
                                <p>{{ $startTime->format('H:i') }} - {{ $endTime->format('H:i') }} WIB</p>

                            </div>

                        </div>
                        <div class="link-event d-flex flex-row gap-2 align-items-center">
                            <img src="{{ asset('assets/icons/icon_link_gradient.svg') }}" alt="Link icon" height="24" width="24">
                            <a href="{{$event->eventPlace}}">Link Zoom</a>

                        </div>
                        
                    <a href="{{$event->eventPlace}}" class="btn w-100 text-dark yellow-gradient-btn">
                            Join Sekarang
                        </a>

                    </div>
                @else
                    @include('components.event-rincian-card', ['isCheckoutPage' => false])
                @endif
            </div>
        @endif

    </div>
</div>

<style>

    .event-banner{
        border-radius: 62px;
    }

    .event-card-detail{
        padding-inline: 40px;
        border-radius: 40px;
        margin-block-end: 22px;
    }

    .event-card-detail-header{
        display: flex;
        height: 31px;
        padding: 10px;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        width: max-content;
    }

    .event-card-detail-header{
        margin-block-start: 30px;
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

    .event-peserta-progress{
        margin: 0;
        color: var(--black-color);
        font-size: var(--font-size-primary);
    }

    .event-name{
        margin:0; 
        font-size: var(--font-size-big); 
        font-weight: 700;
        color: var(--dark-gray-color);
    }

    .jadwal p,
    .event-desc{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);

    }

    .event-daftar-card{
        padding-inline: 26px;
        padding-block: 32px;
        height: max-content;
        width: 439px;
        border-radius: 44px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);

        position: sticky !important;
        top: 108px !important;
        z-index: 10 !important;   
        align-self: flex-start;
        height: auto !important;

    }
    .event-daftar-title{
        margin: 0;
        font-size: var(--font-size-title); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .event-daftar-divider{
        border: none;
        height: 3px;
        background-color: var(--orange-color);
        border-radius: 2px;
        margin-block: 28px;
    }

    .link-event{
        margin-block-end: 28px;

        a{
            font-weight: 700;
            color: var(--dark-gray-color);
            font-size: var(--font-size-primary);
        }

    }
</style>

@endsection