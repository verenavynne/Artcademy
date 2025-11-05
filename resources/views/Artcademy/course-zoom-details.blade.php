@extends('layouts.master')

@section('content')
@php
    $startTime =  \Carbon\Carbon::parse($zoom->start_time)->format('H.i');
    $endTime = \Carbon\Carbon::parse($zoom->end_time)->format('H.i');
    $date = \Carbon\Carbon::parse($zoom->zoomDate)->translatedFormat('d F Y');
@endphp

@if (session('info'))
    <div class="alert alert-warning mt-3">{{ session('info') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-center gap-5">
        <div class="d-flex flex-column" style="width: 60%;">
            <div class="zoom-card-detail card d-flex flex-row" style="background:var(--orange-gradient-color) ">
                <div class="zoom-card-detail-content d-flex flex-column justify-content-center" style="gap: 12px; padding-inline-end: 26px">
                    <p style="margin:0; font-size: var(--font-size-big); font-weight: 700">{{ $zoom->zoomName }}</p>
                    <div class="d-flex flex-row gap-5">
                        <div class="d-flex flex-column" style="gap:12px">
                           <p style="margin:0; font-size: var(--font-size-small);">Ikuti sesi Zoom interaktif ini dan pelajari langsung bersama tutor berpengalaman. Dapatkan wawasan, tips, dan praktik terbaik di bidang yang kamu minati!</p>
                           <div class="course-time-container d-flex flex-row gap-1 mb-2">
                                <img src="{{ asset('assets/icons/icon_calendar.svg') }}" alt="Calendar icon" height="24" width="24">
                                <p style="margin:0; color: black; font-size: var(--font-size-small)">{{ $date }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column" style="gap: 22px">
                    <div class="d-flex justify-content-end">
                        <div class="zoom-card-detail-header d-flex flex-row gap-2" style="background:#D99F18; ">
                            <div class="zoom-record-icon"></div>
                            <p style="margin: 0; color: white; font-size: var(--font-size-small)" >Kelas Zoom</p>
                        </div>

                    </div>
                    <div class="d-flex flex-start me-4">
                        <img class="tutor-picture" src="{{ asset('assets/course/default_tutor_profile_zoom.png') }}" alt="Course Picture" width="176" height="176" style="">

                    </div>
                </div>

            </div>

            <div class="zoom-description-section d-flex flex-column" style="gap: 22px">
                <p class="zoom-name">{{ $zoom->zoomName }}</p>
                <div class="d-flex flex-row align-items-center" style="gap: 12px">
                    <div class="progress" style="height: 6px; width: 680px; background-color: #E5E5E5;">
                        <div class="progress-bar" role="progressbar" 
                        style="width: {{ $progressPeserta }}%; background-color: #E92D62;"
                        aria-valuenow="{{ $progressPeserta }}" 
                        aria-valuemin="0" 
                        aria-valuemax="100">
                        </div>
                    </div>
                    <p class="zoom-peserta-progress">{{ $totalPeserta }} / {{ $quota }} peserta</p>
                </div>

                <p class="zoom-desc">{{ $zoom->zoomDesc }}</p>
            </div>

            <hr class="divider">

            <div class="jadwal-zoom-section">
                <p class="title text-start fw-bold">Jadwal</p>
                <div class="jadwal-list d-flex flex-row justify-content-between align-items-center">
                    <div class="jadwal d-flex flex-row align-items-center gap-2">
                        <img src="{{ asset('assets/icons/icon_calendar_gradient.svg') }}" alt="Calendar icon" height="24" width="24">
                        <p>{{ $date }}</p>

                    </div>
                    <div class="jadwal d-flex flex-row align-items-center gap-2">
                        <img src="{{ asset('assets/icons/icon_clock_gradient.svg') }}" alt="Clock icon" height="24" width="24">
                        <p>{{$startTime}} - {{$endTime}} WIB</p>

                    </div>
                    <div class="jadwal d-flex flex-row align-items-center gap-2">
                        <img src="{{ asset('assets/icons/icon_map_gradient.svg') }}" alt="Calendar icon" height="24" width="24">
                        <p>Zoom Meeting</p>

                    </div>

                </div>
            </div>

            <hr class="divider">

            <div class="pembicara-section d-flex flex-column">
                <p class="title text-start fw-bold">Pembicara</p>
                <div class="tutor-card-container d-flex flex-row">
                    @include('components.tutor-card', ['tutor' => $zoom->tutor])
                </div>

            </div>

            <hr class="divider">

            <div class="zoom-lainnya-section d-flex flex-column">
                <p class="title text-start fw-bold">Ikuti Kelas Zoom Lainnya</p>
                <div class="zoom-card-container">
                    @foreach($otherZoom as $zoomLain)
                        @include('components.zoom-card',['zoom' => $zoomLain])
                    @endforeach
                </div>

            </div>
        </div>

        <div class="d-flex justify-content-center" style="width: 40%;">
            <div class="zoom-daftar-card d-flex flex-column">
                <p class="zoom-daftar-title text-start fw-bold">Kelas Zoom</p>
                <hr class="zoom-daftar-divider">
                <div class="jadwal-list d-flex flex-row align-items-center" style="margin-block-end: 28px; gap: 70px">
                    <div class="jadwal d-flex flex-row align-items-center gap-2">
                        <img src="{{ asset('assets/icons/icon_calendar_gradient.svg') }}" alt="Calendar icon" height="24" width="24">
                        <p>{{ $date }}</p>

                    </div>
                    <div class="jadwal d-flex flex-row align-items-center gap-2">
                        <img src="{{ asset('assets/icons/icon_clock_gradient.svg') }}" alt="Clock icon" height="24" width="24">
                        <p>{{$startTime}} - {{$endTime}}</p>

                    </div>

                </div>
                @if ($isRegistered)
                    <div class="link-zoom d-flex flex-row gap-2 align-items-center">
                        <img src="{{ asset('assets/icons/icon_link_gradient.svg') }}" alt="Link icon" height="24" width="24">
                        <a href="{{$zoom->zoomLink}}">Link Zoom</a>

                    </div>
                
                @endif

                @if($isRegistered)
                    <a href="{{$zoom->zoomLink}}" class="btn w-100 text-dark yellow-gradient-btn">
                        Join Sekarang
                    </a>
                @else
                    <form action="{{ route('zoom.register', $zoom->id) }}" method="POST" class="w-100">
                        @csrf
                        <button type="submit" class="btn w-100 text-dark yellow-gradient-btn">
                            Daftar Sekarang
                        </button>
                    </form>
                @endif


            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex justify-content-center flex-column text-center p-4" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
            
            <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            
            <img src="{{ asset('assets/course/zoom_berhasil_daftar.png') }}" alt="Berhasil dikumpulkan" class="mb-3" width="80" style="align-self: center">
            
            <h5 class="fw-bold mb-2" style="font-size: var(--font-size-title)">Berhasil Terdaftar!</h5>
            <p class="mb-4" style="margin: 0; font-size: var(--font-size-primary); color: var(--dark-gray-color)">
                Yey, kamu sudah terdaftar di kelas zoom, Siapkan catatan dan semangat terbaikmu!
            </p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('course') }}" class="btn rounded-pill modal-left-btn px-4 py-2">Lihat Kursus Lain</a>

                <a href="{{ route('zoom.showDetail', $zoom->id) }}"
                    class="btn text-dark yellow-gradient-btn" style="width: 50%">
                    Lihat Detail Zoom
                </a>
            
            </div>
        </div>
    </div>

</div>

<style>
    .zoom-card-detail{
        padding-inline: 40px;
        border-radius: 40px;
        margin-block-end: 22px;
    }

    .zoom-card-detail-header{
        display: flex;
        height: 31px;
        padding: 10px;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        width: max-content;
    }

    .zoom-card-detail-header{
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

    .tutor-picture{
        display: flex;
        object-fit: cover;
        overflow: hidden;
        object-position: center 40%;
    }

    .zoom-peserta-progress{
        margin: 0;
        color: var(--black-color);
        font-size: var(--font-size-primary);
    }

    .zoom-name{
        margin:0; 
        font-size: var(--font-size-big); 
        font-weight: 700;
        color: var(--dark-gray-color);
    }

    .jadwal p,
    .zoom-desc{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);

    }

    .zoom-daftar-card{
        padding-inline: 26px;
        padding-block: 32px;
        height: max-content;
        width: 439px;
        border-radius: 44px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);

    }
    .zoom-daftar-title{
        margin: 0;
        font-size: var(--font-size-title); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .zoom-daftar-divider{
        border: none;
        height: 3px;
        background-color: var(--orange-color);
        border-radius: 2px;
        margin-block: 28px;
    }

    .link-zoom{
        margin-block-end: 28px;

        a{
            font-weight: 700;
            color: var(--dark-gray-color);
            font-size: var(--font-size-primary);
        }

    }

    .modal-left-btn{
        background-color: #F9EEDB !important;
        border: none;
        border-radius: 50rem;
        box-shadow: 0px 4px 8px 0px var(--brown-shadow-color);
        transition: all 0.3s ease;
        align-content: center;
        position: relative;
        font-size: var(--font-size-primary);

        background-image: linear-gradient(0deg, #E92D62 25%, #FF6E97 70%);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        
        height: 100%;
        padding-inline: 30px;
        justify-content: center;
    }

    .modal-left-btn::before{
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 100px;
        padding: 2px;
        background: var(--pink-gradient-color);
        -webkit-mask:
            linear-gradient(#fff 0 0) content-box,
            linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
                mask-composite: exclude;
    }


</style>
@endsection

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    });
</script>
@endif