<div class="testimoni-card d-flex flex-column">
    <div class="testimoni-header d-flex flex-row">
        <img src="{{ asset('assets/course/testimoni_default_profile.svg') }}"
            class="rounded-circle testimoni-profile" width="55" height="55">
        <div class="testimoni-name d-flex flex-column">
            <p class="fw-bold">{{ $testimoni->student->user->name }}</p>
            <div class="d-flex flex-row align-items-center" style="gap:5px">
                <div class="d-flex flex-row" style="gap: 5px">
                    @for ($i = 0; $i < round($testimoni->rating); $i++)
                        <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="16" width="16">
                    @endfor
                </div>
                <p style="margin:0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">
                    {{ $testimoni->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
    </div>
    <p class="testimoni-review">{{ $testimoni->testimoniContent }}</p>
    <!-- <div class="testimoni-footer d-flex flex-row justify-content-between">
        <div class="d-flex flex-row">
            <img src="{{ asset('assets/icons/icon_likes.svg') }}" alt="Like" height="16" width="16">
            <p class="membantu-text">Membantu</p>
        </div>
        <p class="lihat-testimoni-text">Lihat selengkapnya</p>
    </div> -->
</div>