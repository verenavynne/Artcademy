<div class="modal fade" id="deleteConfirmModal{{ $portfolio->id }}" tabindex="-1" aria-labelledby="deleteConfirmModalLabel{{ $portfolio->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center flex-column text-center p-4" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
        
            <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
        
            <img src="{{ asset('assets/portfolio/portfolio_hapus.png') }}" alt="Konfirmasi Hapus" class="mb-3" width="80" style="align-self: center">
        
            <h5 class="fw-bold mb-2" style="font-size: var(--font-size-title)">Hapus Portofolio ini?</h5>
            <p class="mb-4" style="margin: 0; font-size: var(--font-size-primary); color: var(--dark-gray-color)">
                Setelah dihapus, kamu tidak bisa memulihkannya lagi</span> ?
            </p>

            <div class="d-flex justify-content-center gap-3" style="width: 100%">
                <button type="button" style ="width: 50%; align-self: center" class="btn rounded-pill pink-cream-btn px-4" data-bs-dismiss="modal">
                    <p class="text-pink-gradient" style="margin: 0">Kembali</p>
                </button>
                
                <form action="{{ route('portfolio.destroy', $portfolio->id) }}" id="deletePortoForm" class="delete-porto-form" method="POST" style="width: 50%">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="submitBtnDelete" class="submit-btn-delete btn w-100 text-white red-btn px-4 d-flex align-items-center justify-content-center gap-2">
                        <div id="loadingSpinnerDelete" class="loading-spinner-delete spinner-border spinner-border-sm text-white d-none"></div>
                        <span id="btnTextDelete" class="btn-text-delete" style="font-size: 18px">Hapus</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('submit', function(e){
        if(e.target.classList.contains('delete-porto-form')){
            const form = e.target;
            const submitBtn = form.querySelector('.submit-btn-delete');
            const btnText = form.querySelector('.btn-text-delete');
            const spinner = form.querySelector('.loading-spinner-delete');

            submitBtn.disabled = true;
            btnText.textContent = 'Memproses...';
            spinner.classList.remove('d-none');
        }
    })
   
</script>
