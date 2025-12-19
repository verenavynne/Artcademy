@extends('layouts.master-tutor')

@section('content')
<div class="container-content">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-semibold" style="font-size: 32px">Jadwal Saya</h4>
    </div>

    @include('profile.components.tab', ['firstTab' => 'jadwal-zoom-mendatang', 'secondTab' => 'jadwal-selesai', 'activeTab' => 'jadwal-zoom-mendatang'])

    <div class="tab-content-container">
        <div class="tab-content active" data-tab-content="jadwal-zoom-mendatang">
            <div class="d-flex flex-row flex-wrap gap-4 p-3">
                @forelse ($zoomMendatang as $zoom)
                    @include('components.zoom-card')
                @empty
                    <div class="d-flex flex-column align-items-center w-100 gap-4" style="margin-top: 70px;">
                        <img src="{{ asset('assets/course/empty.svg') }}" alt="" style="width: 100px">
                        <div>
                            <h3 class="text-center fw-semibold" style="font-size: 20px; color: var(--black-color)">Belum ada Zoom mendatang</h3>
                            <p class="text-center" style="font-size: 18px; color: var(--dark-gray-color)">Belum ada jadwal Zoom yang akan datang. Pantau terus untuk update berikutnya.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="tab-content" data-tab-content="jadwal-selesai">
            <div class="d-flex flex-row flex-wrap gap-4 p-3">
                @forelse ($zoomSelesai as $zoom)
                    @include('components.zoom-card')
                @empty
                    <div class="d-flex flex-column align-items-center w-100 gap-4" style="margin-top: 70px;">
                        <img src="{{ asset('assets/course/empty.svg') }}" alt="" style="width: 100px">
                        <div>
                            <h3 class="text-center fw-semibold" style="font-size: 20px; color: var(--black-color)">Belum ada Zoom yang selesai</h3>
                            <p class="text-center" style="font-size: 18px; color: var(--dark-gray-color)">Riwayat Zoom akan muncul di sini setelah sesi selesai.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @if($zoomMendatang->isNotEmpty())
        @include('lecturer.jadwal-saya.detail-zoom-popup')
    @elseif($zoomSelesai->isNotEmpty())
        @include('lecturer.jadwal-saya.detail-zoom-popup')
    @endif
</div>

<style>    
    .text-custom {
        color: #D0C4AF !important;
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