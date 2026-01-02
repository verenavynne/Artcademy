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

    $isRegistered = \App\Models\EventTransaction::where('eventId', $event->id)->where('studentId', auth()->id())->exists();
    $isDisabled = $event->eventDate > Carbon::now();

@endphp
<div class="event-card card article-card" height="100%" 
    @if(Auth::check())
         onclick="window.location.href='{{ route('event.detail', $event->id) }}'"
    @endif
    style="cursor: pointer;">
    <img class="event-card-header" src="{{ $bannerUrl }}" alt="">
    <div class="event-card-bottom d-flex flex-column align-items-start">

        <div class="d-flex flex-column align-items-start {{ $isRegistered ? 'justify-content-around' : '' }}" style="gap: 12px; {{ $isRegistered ? 'min-height: 133px;' : '' }} ">

            <p class="event-title" >{{ $event->eventName }}</p>

            <div class="d-flex flex-column align-items-start " style="gap: 12px;">
                @if(!$isRegistered)
                    <p class="event-title" >{{ $eventPrice }}</p>
                @endif
            
                <div class="d-flex flex-column w-100" style="gap: 10px">
                    <div class="d-flex flex-row align-items-center justify-content-between gap-1" >
                        <div class="d-flex flex-row gap-1">
                            <img src="{{ asset('assets/icons/icon_calendar.svg') }}" alt="Calendar" height="16" width="16">
                            <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)"> {{ Carbon::parse($event->eventDate)->translatedFormat('d F Y') }}</p>
                            
                        </div>
                        <div class="d-flex flex-row gap-1">
                            <img src="{{ asset('assets/icons/icon_clock.svg') }}" alt="Clock" height="16" width="16">
                            <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">{{ $startTime->format('H:i') }} - {{ $endTime->format('H:i') }} WIB</p>
                            
                        </div>
                    </div>
                    <div class="d-flex flex-row gap-1">
                        <iconify-icon icon="fe:location" style="font-size: 16px"></iconify-icon>
                        <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">Zoom Meeting</p>
                        
                    </div>
                </div>
            </div>
        </div>
    
        
        @if (Auth::check())
            @if($isRegistered)
                <a href="#" class="btn w-100 text-dark yellow-gradient-btn {{ $isDisabled ? 'disabled' : '' }}" aria-disabled="{{  $isDisabled ? 'true' : 'false' }}">
                    Join Sekarang
                </a>
            @else
                <a href="#" class="btn w-100 text-dark yellow-gradient-btn">
                    Daftar Sekarang
                </a>
            @endif
            
        @else
            <a href="{{ route('login') }}" class="btn w-100 text-dark yellow-gradient-btn">
                Daftar Sekarang
            </a>
        @endif

    </div>
</div>

<style>

    .event-card{
        justify-content: space-around;
        background-color: white;
        width: 259px;
        min-height: 377px;
        border-radius: 40px;
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        border: none;
        padding:8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .event-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }

    .event-card-header{
        border-radius: 40px; 
        height: 165px;
    }

    .event-text-container{
        display: flex;
        height: 29px;
        padding: 10px;
        justify-content: start;
        align-items: center;
        border-radius: 10px;
        width: max-content;
    }

    .event-title{
        margin:0; 
        font-size: var(--font-size-tiny); 
        font-weight: 700
    }

    .event-card-bottom {
        min-height: 200px;
        padding-inline: 8px;
        padding-block-end: 8px;
        padding-block-start: 12px;
        gap: 12px
    }
</style>