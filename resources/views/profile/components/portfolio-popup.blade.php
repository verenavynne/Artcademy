@foreach($portfolios as $portfolio)
<div class="modal fade bd-example-modal-lg" id="portoModal{{ $portfolio->id }}" tabindex="-1" aria-labelledby="portoModalLabel{{ $portfolio->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-5" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
    
            <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row {{ $portfolio->mockupType === 'mobile' ? 'flex-row' : 'flex-column' }} align-items-center justify-content-center g-4">
                    <div class="{{ $portfolio->mockupType === 'mobile' ? 'col-md-5' : 'col-12 text-center' }}">
                        @if(Str::endsWith($portfolio->portfolioPath, '.mp4'))
                            <video id="player-{{ $portfolio->id }}" playsinline controls class="w-100" 
                                style="{{ $portfolio->mockupType === 'laptop' ? 'max-height: 300px' : 'max-height: 100%' }}; object-fit: cover">
                                <source src="{{ Storage::disk('s3')->temporaryUrl($portfolio->portfolioPath, now()->addDay()) }}" type="video/mp4">
                                Browser kamu tidak mendukung video HTML5.
                            </video>
                        @else
                            <img class="portfolio-thumbnail img-fluid"
                                style="{{ $portfolio->mockupType === 'laptop' ? 'max-height: 300px' : 'max-height: auto' }}"
                                src="{{ Storage::disk('s3')->temporaryUrl($portfolio->portfolioPath, now()->addDay()) }}"
                                alt="Portofolio">
                        @endif
                    </div>
                    
                    <div class="{{ $portfolio->mockupType === 'mobile' ? 'col' : 'col-12' }} justify-content-center align-items-center">
                        <div class="col mb-3">
                            <label for="" class="portfolio-form-label">Judul Portofolio</label>
                            <input type="text" id="portfolioName" name="name" 
                                    class="form-control rounded-pill" 
                                    value="{{ $portfolio->portfolioName }}" 
                                    disabled>
                        </div>

                        <div class="col mb-3">
                            <label class="portfolio-form-label fw-semibold">Link Portofolio</label>
                            <div class="position-relative d-flex">
                                <iconify-icon icon="material-symbols:link-rounded" class="input-icon"></iconify-icon>
                                <input type="text" id="portfolioLink" name="link" 
                                        class="form-control rounded-pill form-link-input" 
                                        value="{{ $portfolio->portfolioLink }}"
                                        disabled>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label class="portfolio-form-label">Deskripsi Portofolio</label>
                            <textarea id="portfolioDesc" name="description" rows="4" 
                                    class="form-control description rounded-4" disabled
                                    >{{ $portfolio->portfolioDesc }}</textarea>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endforeach

<style>
    .modal-backdrop {
        z-index: 2000  !important;
    }

    .modal.show {
        z-index: 2100 !important;
    }

    .form-control:disabled{
        background-color: #FAFAFA;
    }

    .portfolio-title-desc{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);
    }

    .portfolio-thumbnail{
        border-radius: 40px;
        object-fit: cover;
        border: 2px dashed var(--orange-gradient-color);
    }

    .portfolio-form-label{
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);
        font-weight: 700;
        margin-block-end: 10px;

    }

    .form-link-input,
    .form-control{
        min-height: 56px;
        padding: 10px 30px;
        align-items: center;
        background: #FAFAFA;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        border: none
    }

    .form-link-input{
        padding: 10px 30px 10px 50px; 
    }

    .form-upload-file{
        height: 56px;
        background: #FAFAFA;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        color: #D0C4AF
    }

    .input-icon {
        position: absolute;
        left: 20px; 
        top: 50%;
        transform: translateY(-50%);
        color: #5a5a5a;
        font-size: 20px;
        pointer-events: none; 
    }
    

    .placeholder-file,
    .form-control::placeholder,
    .form-link-input::placeholder {
        color: #D0C4AF;
    }

    .form-control:focus,
    .form-link-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(233, 45, 98, 0.25);
        outline: none;
    }

</style>

<script>
    document.querySelectorAll("video[id^='player-']").forEach(video => {
        new Plyr(video, {
            clickToSeek: true,
            controls: [
                'play-large', 'play', 'progress', 'current-time',
                'mute', 'volume', 'settings', 'fullscreen'
            ],
        });
    });
</script>