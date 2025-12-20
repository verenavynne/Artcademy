<div class="modal fade" id="deletePostConfirmModal{{ $post->id }}" tabindex="-1" aria-labelledby="deletePostConfirmModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center flex-column text-center p-4" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
        
            <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
        
            <img src="{{ asset('assets/portfolio/portfolio_hapus.png') }}" alt="Konfirmasi Hapus" class="mb-3" width="80" style="align-self: center">
        
            <h5 class="fw-bold mb-2" style="font-size: var(--font-size-title)">Hapus Post ini?</h5>
            <p class="mb-4" style="margin: 0; font-size: var(--font-size-primary); color: var(--dark-gray-color)">
                Setelah dihapus, kamu tidak bisa memulihkannya lagi
            </p>

            <div class="d-flex justify-content-center align-items-center gap-3" style="width: 100%">
                <button type="button" style ="width: 50%; align-self: center" class="btn rounded-pill pink-cream-btn px-4" data-bs-dismiss="modal">
                    <p class="text-pink-gradient" style="margin: 0">Kembali</p>
                </button>
                
                <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="width: 50%; margin-block-end: 0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn w-100 text-white red-btn px-4" style="font-size: 18px;">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>