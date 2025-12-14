<div class="related-courses-section d-flex flex-column">
    <p class="title text-start fw-bold">Lihat Juga Kelas Lainnya</p>
    <div class="position-relative">
        @if($otherCourses->count() > 2)
            <button id="scrollLeft" class="carousel-btn left-btn">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="Left Arrow">
            </button>
        @endif
        <div class="related-courses d-flex overflow-auto gap-4 pb-3" style="scroll-behavior: smooth;">
            @foreach ($otherCourses as $otherCourse)
                @include('components.course-card', ['course' => $otherCourse])
            @endforeach
        </div>
        @if($otherCourses->count() > 2)
            <button id="scrollRight" class="carousel-btn right-btn">
                <img src="{{ asset('assets/icons/icon_pagination_next.svg') }}" alt="Right Arrow">
            </button>
        @endif

    </div>
</div>


<style>
    .related-courses-section {
        background: #FFF9F0;
        padding: 30px;
        border-radius: 20px;
        position: relative;
    }

    .related-courses::-webkit-scrollbar {
        display: none;
    }

    .carousel-btn {
        background: var(--yellow-gradient-color);
        border-radius: 50%;
        color: black;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 7.571px 15.143px 0px rgba(67, 39, 0, 0.20);
        position: absolute;
        top: 40%;
        transform: translateY(-50%);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 5;
    }

    .left-btn {
        left: -20px;
    }

    .right-btn {
        right: -20px;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const scrollContainer = document.querySelector('.related-courses');
    const scrollLeftBtn = document.getElementById('scrollLeft');
    const scrollRightBtn = document.getElementById('scrollRight');

    scrollLeftBtn.addEventListener('click', () => {
        scrollContainer.scrollBy({ left: -400, behavior: 'smooth' });
    });

    scrollRightBtn.addEventListener('click', () => {
        scrollContainer.scrollBy({ left: 400, behavior: 'smooth' });
    });
});


</script>