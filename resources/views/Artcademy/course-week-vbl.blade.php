@extends('layouts.master')

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-center gap-5">
        <!-- Sisi Kiri -->
        <div class="d-flex flex-column" style="width: 60%">
            <!-- <div class="video-wrapper">
                <video id="player" playsinline controls preload="metadata">
                    <source src="{{ asset('assets/videos/course-default-video.mp4') }}" type="video/mp4" />
                </video>
            </div> -->

            <div class="video-wrapper">
                <div
                    id="player"
                    data-plyr-provider="youtube"
                    data-plyr-embed-id="SDQEaJY291A">
                </div>
            </div>
        </div>
    
        <!-- Sisi Kanan -->
        <div class="d-flex justify-content-center" style="width: 40%">
            @include('components.course-benefit-card')
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

</style>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const player = new Plyr('#player', {
            clickToSeek: true,
            controls: [
                'play-large', 'play', 'progress', 'current-time', 
                'mute', 'volume', 'settings', 'fullscreen'
            ],
        });

    });
</script>