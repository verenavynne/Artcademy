<div class="modal fade" id="membershipModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center align-items-center flex-column text-center p-4"
            style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">

            <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal"></button>

            <img src="{{ asset('assets/course/membership_invalid.svg') }}" class="mb-3" width="100">

            <h5 class="fw-bold mb-2" style="font-size: var(--font-size-title)">
                Upgrade Membership
            </h5>

            <p class="mb-4" style="font-size: var(--font-size-primary); color: var(--dark-gray-color)">
                {{ session('modal_message') }}
            </p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('membership') }}" class="btn w-100 text-dark yellow-gradient-btn">
                    Lihat Membership
                </a>
            </div>
        </div>
    </div>
</div>