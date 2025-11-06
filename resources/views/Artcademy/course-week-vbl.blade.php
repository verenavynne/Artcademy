@extends('layouts.master')

@section('content')

@php
    // regex untuk ambil YouTube video ID
    $youtubeId = null;
    if (preg_match('/(?:youtube\.com\/(?:.*v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $materi->vblUrl, $matches)) {
        $youtubeId = $matches[1];
    }
@endphp


<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-center gap-5">
        <!-- Sisi Kiri -->
        <div class="d-flex flex-column" style="width: 60%">
            
            <div class="video-wrapper">
                <div
                    id="player"
                    data-plyr-provider="youtube"
                    data-plyr-embed-id="{{ $youtubeId }}"
                    data-materi-id="{{ $materi->id }}">
                </div>
            </div>

            <div class="vbl-name-container d-flex flex-column">
                <p class="vbl-name">{{ $materi->vblName }}</p>
                <p class="vbl-description">{{ $materi->vblDesc }}</p>
            </div>

            <div class="tools-section d-flex flex-column">
                <p class="title text-start fw-bold">Tools</p>

                <div class="tools-list-container d-flex flex-row">
                    @foreach ($tools as $tool )
                        <div class="tools-container d-flex flex-row">
                            <img class="tool-icon" src="{{ asset($tool->toolsPicture) }}" alt="ToolIcon" height="35" width="35">
                            <p class="tool-name">{{ $tool->toolsName }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <hr class="divider">

            <div class="tutor-section d-flex flex-column">
                <p class="title text-start fw-bold">Tutor</p>
                <div class="tutor-card-container d-flex flex-row">
                    @if ($tutor)
                        @include('components.tutor-card',['tutor' => $tutor])
                    @endif
                </div>
            </div>

            <hr class="divider">

            <div class="zoom-section d-flex flex-column">
                <p class="title text-start fw-bold">Kelas Zoom</p>
                <div class="zoom-card-container">
                    @foreach ($zooms as $zoom)
                        @include('components.zoom-card',['zoom' => $zoom])
                    @endforeach
                </div>
            </div>

            <hr class="divider">

             <!-- Carousel course card -->
            @include('components.other-course-carousel')

        </div>
    
        <!-- Sisi Kanan -->
        <div class="d-flex justify-content-center" style="width: 40%">
            @include('components.course-week-progress-card', [
                'week' => $week,
                'weekProgress' => $weekProgress,
                'materiProgress' => $materiProgress,
                'isUnlocked' => $isUnlocked
            ])
        </div>

    </div>




</div>

<style>
    .plyr.plyr--full-ui.plyr--video{
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
        border-radius: 40px;
        width: 100%;
        min-height: 443px;
    }

    .plyr--full-ui.plyr--video .plyr__control--overlaid{
        border-radius: 50%;
        border: none;
        background: var(--yellow-gradient-color);
        cursor: pointer;
        color: var(--black-color);
        transition: transform 0.3s ease;
        box-shadow: 0 8.714px 17.429px 0 rgba(67, 39, 0, 0.20);

    }

    .plyr__controls__item.plyr__progress__container{
        .plyr__progress{
            --plyr-range-fill-background: var(--yellow-gradient-color);
        }
    }

    .plyr__controls__item.plyr__volume{
        > input[type=range]{
            --plyr-range-fill-background: var(--yellow-gradient-color);
        }
    }


    .plyr__controls__item.plyr__control:focus,
    .plyr__controls__item.plyr__control:active {
        background-color: none !important;
        box-shadow: none !important; 
        outline: none !important;
    }

    .plyr.plyr--menu-open .plyr__controls__item.plyr__control {
        background-color: transparent;
    
    }

    .vbl-name-container{
        gap: 12px;
        margin-block-start: 22px;
        margin-block-end: 34px;
    }

    .vbl-name{
        margin: 0;
        color: var(--black-color);
        font-weight: 700;
        font-size: var(--font-size-big);
    }

    .vbl-description{
        margin: 0;
        color: var(--dark-gray-color);
        font-size: var(--font-size-primary);
    }

    /* Tools Section */
    .tools-list-container{
        gap: 80px;

    }

    .tools-container{
        gap: 8px;
        justify-content: start;
        align-items: center;
    }

    .tool-icon{
        border-radius: 10px;
    }

    .tool-name{
        margin: 0;
        color: var(--dark-gray-color);
        font-size: var(--font-size-primary);
    }

</style>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const playerEl = document.getElementById('player');
    const materiId = playerEl.dataset.materiId; 

    const player = new Plyr(playerEl, {
        clickToSeek: true,
        controls: [
            'play-large', 'play', 'progress', 'current-time', 
            'mute', 'volume', 'settings', 'fullscreen'
        ],
    });

    const checkbox = document.querySelector(`.materi-checkbox[data-materi-id="${materiId}"]`);
    const lanjutkanBtn = document.getElementById('lanjutkanBtn');

    const progressCard = document.querySelector('.course-week-progress-card');
    const progressBar = progressCard.querySelector('.progress-bar');
    const progressPercentText = progressCard.querySelector('.progress-percentage');

    const totalMateri = parseInt(progressCard.dataset.total);
    let doneMateri = parseInt(progressCard.dataset.done);

    if (!checkbox) {
        console.warn(`checkbox not found for materiId ${materiId}`);
        return;
    }

    player.on('ended', function () {
        checkbox.checked = true; 
        toggleButton(true);
        updateProgressUI(); 
    });

    toggleButton(checkbox.checked);

    function toggleButton(isChecked) {
        if (isChecked) {
            lanjutkanBtn.classList.remove('disabled');
            lanjutkanBtn.setAttribute('aria-disabled', 'false');
            lanjutkanBtn.style.pointerEvents = 'auto';
            lanjutkanBtn.style.opacity = '1';
        } else {
            lanjutkanBtn.classList.add('disabled');
            lanjutkanBtn.setAttribute('aria-disabled', 'true');
            lanjutkanBtn.style.pointerEvents = 'none';
            lanjutkanBtn.style.opacity = '0.5';
        }
    }

    function updateProgressUI() {
        doneMateri++; 
        const newPercent = Math.min(Math.round((doneMateri / totalMateri) * 100), 100);

        progressBar.style.width = `${newPercent}%`;
        progressPercentText.textContent = `${newPercent}%`;
    }
});

</script>