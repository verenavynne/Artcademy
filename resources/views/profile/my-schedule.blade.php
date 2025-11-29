@extends('layouts.master')

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-evenly" style="width: 100%; align-items: flex-start; align-self: stretch; gap: 24px;">
        <!-- <div style="width: 20%"> -->
            @include('profile.components.sidebar-profile')
        <!-- </div> -->

        <div class="d-flex flex-column" style="width: 75%; gap: 32px">
            @include('profile.components.tab', ['firstTab' => 'kelas-zoom', 'secondTab' => 'event', 'activeTab' => $activeTab])

            <div class="tab-content-container">
                <div class="tab-content active" data-tab-content="kelas-zoom">
                   <p class="title text-start fw-bold">Ikuti Kelas Zoom Sekarang!</p>
                   <p style="font-size: 18px">Interaktif, seru, dan penuh insight. Jangan sampai ketinggalan momennya!</p>

                    <div class="zooms-section pt-3">
                        @foreach($zooms as $zoom)
                            @include('components.zoom-card',['zoom' => $zoom->zoom])
                        @endforeach

                   </div>

    
                </div>
                <div class="tab-content" data-tab-content="event">
                    <p class="title text-start fw-bold">Ikuti Event Seru Artcademy!</p>
                    <p style="font-size: 18px">Event seru siap bikin kamu makin jago dan makin terinspirasi. Yuk join sekarang!</p>

                    <div class="events-section pt-3">
                       @foreach($events as $event)
                            @include('components.event-card', ['event'=> $event->event])
                       @endforeach

                    </div>
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>

    .navigation-prev {
        position: sticky;
        top: 94px;
        z-index: 1020;
        padding-left: 8px;
    }

    .title{
        margin-block-end: 0
    }

    .events-section,
    .zooms-section{
        display: grid;
        grid-template-columns: repeat(3, 1fr) ;
        gap: 20px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const tabLinks = document.querySelectorAll(".tab-link");
    const tabContents = document.querySelectorAll(".tab-content");

    tabLinks.forEach(btn => {
        btn.addEventListener("click", () => {
            const target = btn.getAttribute("data-tab");

            tabLinks.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            tabContents.forEach(content => {
                if (content.getAttribute("data-tab-content") === target) {
                    content.classList.add("active");
                } else {
                    content.classList.remove("active");
                }
            });
        });
    });
})

</script>
