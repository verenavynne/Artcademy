<div class="zoom-card card article-card" height="100%" onclick="window.location.href='{{ route('zoom.showDetail', $zoom->id) }}'" style="cursor: pointer;">
    <div class="zoom-card-header d-flex flex-column justify-content-between" style="background: var(--orange-gradient-color)">
        <div class="zoom-text-container d-flex flex-row mb-2 gap-2" style="background: #D99F18">
            <div class="zoom-record-icon"></div>
            <p style="margin: 0; color: white; font-size: var(--font-size-mini)" >Kelas Zoom</p>
        </div>
        <p style="margin: 0; color: black; font-size: var(--font-size-tiny); font-weight: 700">{{ $zoom->zoomName }}</p>
        <div class="d-flex flex-row justify-content-center align-items-center gap-3" >
            <div class="zoom-date-container d-flex flex-row gap-1 mb-2">
                <img src="{{ asset('assets/icons/icon_calendar.svg') }}" alt="Tutor Profile" width="16" height="16">
                <p style="margin:0; color: black; font-size: var(--font-size-mini)"> {{ \Carbon\Carbon::parse($zoom->zoomDate)->translatedFormat('d F Y') }}</p>
            </div>
            <img class="zoom-tutor-profile" src="{{ asset('assets/course/default_tutor_profile_zoom.png') }}" alt="zoom Picture">
        </div>
    </div>
    <div class="zoom-card-bottom d-flex flex-column align-items-start">
    
        <p class="zoom-title" >{{ $zoom->zoomName }}</p>
            
        <div class="d-flex flex-row align-items-center gap-2">
                
            <img src="{{ asset('assets/course/default_tutor_profile_zoom.png') }}" 
            class="rounded-circle zoom-tutor-image" 
            width="37" 
            height="37" 
            >
            <div class="d-flex flex-column">
                <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color); font-weight: 700">
                    Tutor: {{ $zoom->tutor->lecturer->user->name }}</p>
                        <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">
                    {{ $zoom->tutor->lecturer->specialization }}</p>

            </div>
        </div>
        <div class="d-flex flex-row align-items-center" style="gap:5px">
            <div class="d-flex flex-row">
                <img src="{{ asset('assets/icons/icon_calendar.svg') }}" alt="Star" height="16" width="16">
                
            </div>
            <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">{{ \Carbon\Carbon::parse($zoom->zoomDate)->translatedFormat('d F Y') }}</p>
        </div>

        @if (Auth::check())
            <a href="{{ route('zoom.showDetail', $zoom->id) }}" class="btn w-100 text-dark yellow-gradient-btn">
                Daftar Sekarang
            </a>
            
        @else
            <a href="{{ route('login') }}" class="btn w-100 text-dark yellow-gradient-btn">
                Daftar Sekarang
            </a>
        @endif

    </div>
</div>
