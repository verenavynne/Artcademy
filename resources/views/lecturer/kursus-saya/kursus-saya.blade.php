@extends('layouts.master-tutor')

@section('content')
<div class="container-content">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-semibold" style="font-size: 32px">Kursus Saya</h4>
    </div>

    @include('profile.components.tab', ['firstTab' => 'dipublikasikan', 'secondTab' => 'diarsipkan', 'activeTab' => $status])

    <div class="tab-content-container">
        <div class="tab-content active" data-tab-content="dipublikasikan">
            <div class="d-flex flex-row flex-wrap gap-4 p-3">
                @forelse ($publikasiCourses as $course)
                    @include('components.course-card')
                @empty
                    <div class="d-flex flex-column align-items-center w-100 gap-4" style="margin-top: 70px;">
                        <img src="{{ asset('assets/course/empty.png') }}" alt="" style="width: 100px">
                        <div>
                            <h3 class="text-center fw-semibold" style="font-size: 20px; color: var(--black-color)">Oops, Kursus kamu masih kosong!</h3>
                            <p class="text-center" style="font-size: 18px; color: var(--dark-gray-color)">Belum ada kursus yang dipublikasikan.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="tab-content" data-tab-content="diarsipkan">
            <div class="d-flex flex-row flex-wrap gap-4 p-3">
                @forelse ($diarsipkanCourses as $course)
                    @include('components.course-card')
                @empty
                    <div class="d-flex flex-column align-items-center w-100 gap-4" style="margin-top: 70px;">
                        <img src="{{ asset('assets/course/empty.png') }}" alt="" style="width: 100px">
                        <div>
                            <h3 class="text-center fw-semibold" style="font-size: 20px; color: var(--black-color)">Oops, Kursus kamu masih kosong!</h3>
                            <p class="text-center" style="font-size: 18px; color: var(--dark-gray-color)">Belum ada kursus yang diarsipkan.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    
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