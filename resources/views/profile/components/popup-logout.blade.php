<div class="modal fade" id="logoutConfirmationModal" tabindex="-1" aria-labelledby="logoutConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center flex-column text-center p-4" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
        
            <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
        
            <img src="{{ asset('assets/auth/popup-keluar-akun.png') }}" alt="Konfirmasi Hapus" class="mb-3" width="80" style="align-self: center">
        
            <h5 class="fw-bold mb-2" style="font-size: var(--font-size-title)">Keluar dari Akun?</h5>
            <p class="mb-4" style="margin: 0; font-size: var(--font-size-primary); color: var(--dark-gray-color)">
                Keluar sekarang? Kamu bisa masuk kembali kapan saja dengan akun yang sama
            </p>

            <div class="d-flex justify-content-center gap-3" style="width: 100%">
                <button type="button" style ="width: 50%; align-self: center" class="btn rounded-pill pink-cream-btn px-4" data-bs-dismiss="modal">
                    <p class="text-pink-gradient" style="margin: 0">Kembali</p>
                </button>
                
                <form action="{{ route('logout') }}" class="keluar-btn d-flex justify-content-center align-items-center" method="POST" style="width: 50%; display:inline;">
                    @csrf
                    <button type="submit" class="btn w-100 rounded-pill text-white red-btn px-4" style="font-size: 18px;" style=>Keluar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .keluar-btn {
        margin: 0;
    }

        .modal-backdrop {
        z-index: 2000  !important;
    }
        .modal.show {
        z-index: 2100 !important;
    }
</style>