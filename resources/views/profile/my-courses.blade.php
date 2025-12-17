@extends('layouts.master')

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <a class="page-link" href="{{ route('home') }}" onclick="window.history.back()">
        <div class="navigation-prev d-flex flex-start sticky-top">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </div>
    </a>

    <div class="d-flex flex-row justify-content-evenly" style="width: 100%; align-items: flex-start; align-self: stretch; gap: 24px;">
        <!-- <div style="width: 20%"> -->
            @include('profile.components.sidebar-profile')
        <!-- </div> -->

        <div class="d-flex flex-column" style="width: 75%; gap: 32px">
            @include('profile.components.tab', ['firstTab' => 'dalam-proses', 'secondTab' => 'selesai', 'activeTab' => $activeTab])
            <div class="tab-content-container">
                <div class="tab-content active" data-tab-content="dalam-proses">
                   <p class="title text-start fw-bold">Yuk, Lanjutkan Kursusmu!</p>
                   <p style="font-size: 18px">Masih banyak ilmu keren dan materi seru yang nunggu kamu di dalam!</p>

                   <div class="courses-section pt-3">
                       @foreach ($ongoingCoursesEnrollment as $ongoingEnrollment )
                            @include('components.course-ongoing-card', ['enrollment' => $ongoingEnrollment])
                       
                       @endforeach

                      

                   </div>
                    @if($ongoingCoursesEnrollment->isEmpty())
                        <div class="d-flex flex-column align-items-center gap-3">
                            <p class="text-muted text-center">Belum ada kursus yang sudah dimulai</p>
                        </div>
                    @endif

    
                </div>
                <div class="tab-content" data-tab-content="selesai">
                    <p class="title text-start fw-bold">Yey, kamu berhasil menyelesaikan Kursus!</p>
                    <p style="font-size: 18px">Yuk, lihat hasil perolehan nilai projek akhirmu dan terus pertahankan semangat belajarmu</p>

                    <div class="courses-section pt-3">
                        @foreach ($finishedCoursesEnrollment as $finishedEnrollment )
                                @include('components.course-ongoing-card', ['enrollment' => $finishedEnrollment])
                        @endforeach
                    </div>
                    
                    @if($finishedCoursesEnrollment->isEmpty())
                        <div class="d-flex flex-column align-items-center gap-3">
                            <p class="text-muted text-center" style="font-size: 18px">Belum ada kursus yang sudah selesai</p>
                        </div>
                    @endif
    
                </div>
            </div>
            
        </div>

    </div>
</div>

<style>
    .no-sticky {
        position: static !important;
    }

    .title{
        margin-block-end: 0
    }
    .courses-section{
        display: grid;
        grid-template-columns: repeat(3, 1fr) ;
        gap: 20px;
    }
   
</style>

@endsection
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