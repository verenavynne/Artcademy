<div class="related-events-section d-flex flex-column">
    <p class="title text-start fw-bold">Ikuti Event lainnya</p>
    <div class="position-relative">

        <button id="scrollLeft" class="carousel-btn left-btn">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="Left Arrow">
        </button>

        <div class="related-events-wrapper overflow-auto">
            <div class="related-events d-flex gap-4">
                @foreach ($otherEvents as $otherevent)
                    @include('components.event-card', ['event' => $otherevent])
                @endforeach
            </div>
        </div>

        <button id="scrollRight" class="carousel-btn right-btn">
            <img src="{{ asset('assets/icons/icon_pagination_next.svg') }}" alt="Right Arrow">
        </button>

    </div>
</div>


<style>
    .related-events-wrapper {
        overflow-x: auto;
        scroll-behavior: smooth;
        padding-bottom: 10px;
    }

    .related-events-wrapper::-webkit-scrollbar {
        display: none;
    }

    .related-events {
        display: inline-flex;
        width: max-content;
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
    const scrollContainer = document.querySelector('.related-events-wrapper');
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