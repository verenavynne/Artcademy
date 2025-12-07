@extends('layouts.master')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <div class="d-flex flex-row align-items-center gap-4">
        <div class="navigation-prev d-flex flex-start">
            <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </a>
        </div>
        <div class="d-flex flex-column pb-4">
            <p class="title text-start fw-bold">Edit Portofoliomu</p>
            <p class="projek-title-desc">Tambahkan Hasil Karyamu ke mockup 3D yang super keren!</p>
        </div>

    </div>
    
    <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-flex flex-row justify-content-center gap-5">
        <div class="d-flex flex-column" style="width: 60%;">
            <div class="mockup-view-card  d-flex flex-row gap-5">
                <div class="d-flex flex-column gap-2 align-items-center">
                    <div class="d-flex align-items-center flex-column gap-4 position-relative" style="height:max-content">
                        <img id="portfolioPreview" class="portfolio-image-view" 
                        src="{{ Str::endsWith($portfolio->portfolioPath, '.mp4') ? '' : asset('storage/'. $portfolio->portfolioPath) }}"
                        alt="Portfolio File">
                       
                        <div class="upload-plus-wrapper position-absolute top-50 start-50 translate-middle">
                            <label for="portfolioUpload" class="btn upload-plus-btn yellow-gradient-btn d-flex flex-row align-items-center gap-2">
                                <iconify-icon icon="ic:round-plus" class="plus-icon" style= "font-size: 18px"></iconify-icon>
                                
                            </label>
                            <input type="file" id="portfolioUpload" name="file" class="d-none" >
                            
                        </div>
    
                    </div>
                    @error('file')
                        <div class="invalid-feedback d-block" style="width:max-content">{{ $message }}</div>
                    @enderror
                    

                </div>
               
                <div class="mockup-3d-view">
                    <div id="mockup-mobile" style="{{ $portfolio->mockupType === 'mobile' ? '' : 'display: none;' }}">
                        @include('profile.components.portfolio-mockup', [
                            'mockupType' => 'mobile',
                            'portoType' => Str::endsWith($portfolio->portfolioPath, '.mp4') ? 'video' : 'image' ,
                            'mediaPath' =>  asset('storage/'. $portfolio->portfolioPath),
                            'portfolioId' => '1',
                            'mockupSize' => 500,
                            'animation' => false
                        ])
                    </div>

                    <div id="mockup-laptop" style="{{ $portfolio->mockupType === 'laptop' ? '' : 'display: none;' }}">
                        @include('profile.components.portfolio-mockup', [
                            'mockupType' => 'laptop',
                            'portoType' => Str::endsWith($portfolio->portfolioPath, '.mp4') ? 'video' : 'image' ,
                            'mediaPath' => asset('storage/'. $portfolio->portfolioPath),
                            'portfolioId' => '2',
                            'mockupSize' => 450,
                            'animation' => false
                        ])
                    </div>
                </div>

            </div>
        </div>
        
        <div class="d-flex justify-content-center" style="width: 40%;">
            <div class="add-portfolio-card d-flex flex-column">
                
                <input type="hidden" name="mockupType" id="mockupTypeInput" value={{ $portfolio->mockupType }}>
            
                <div class="pilih-device-section d-flex flex-column">
                    <p>Pilih device</p>
                    <div class="pilih-device-buttons d-flex flex-row justify-content-around">
                        <button type="button" class="btn device-btn {{ $portfolio->mockupType === 'mobile' ? 'active' : '' }}" data-type="mobile">
                            Mobile
                        </button>
                        <button type="button" class="btn device-btn {{ $portfolio->mockupType === 'laptop' ? 'active' : '' }}" data-type="laptop">
                            Laptop
                        </button>

                    </div>

                    
                </div>
                <hr class="divider">
                <div class="form-portofolio-section d-flex flex-column">
                    <div class="col">
                        <div class="col mb-4">
                            <label for="" class="portfolio-form-label">Judul Portofolio</label>
                            <input type="text" id="portfolioName" name="name" 
                                    class="form-control rounded-pill @error('name') is-invalid @enderror" 
                                    placeholder="Masukkan Judul portfolio Disini"
                                     value="{{ $portfolio->portfolioName }}">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                           
                        </div>
                        <div class="col mb-4">
                            <label class="portfolio-form-label fw-semibold">Link Portofolio</label>
                            <div class="position-relative d-flex">
                                <iconify-icon icon="material-symbols:link-rounded" class="input-icon"></iconify-icon>
                                <input type="text" id="portfolioLink" name="link" 
                                        class="form-control rounded-pill form-link-input @error('link') is-invalid @enderror " 
                                        placeholder="Link Google Drive / Link Youtube"
                                         value="{{ $portfolio->portfolioLink }}">
                                @error('link')
                                    <div class="invalid-feedback position-absolute" style="bottom:-22px; left:0;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="portfolio-form-label">Deskripsi Portofolio</label>
                            <textarea id="portfolioDesc" name="description" rows="4" 
                                    class="form-control description rounded-4 @error('description') is-invalid @enderror" 
                                    placeholder="Portofolio ini adalah...">{{ $portfolio->portfolioDesc }}</textarea>
                            @error('description') 
                                <div class="invalid-feedback d-block">{{ $message }}</div> 
                            @enderror
                        </div>
                        <button class="btn w-100 text-dark yellow-gradient-btn">
                            Simpan
                        </button>
                    </div>
                </div>
               

            </div>
        </div>
    </div>
    </form>

</div>

<style>

    .title{
        margin-block-end: 0
    }
    .portfolio-image-view{
        object-fit: cover;
        width: 174px;
        height: 176px;
        align-items: start;
        border-radius: 20px;
        border: 2px dashed #F69000;
    }

    .mockup-view-card{
        padding: 34px;
        border-radius: 40px;
        background: var(--cream2-color);
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        height: max-content;
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

    .add-portfolio-card{
        min-width: 393px;
        height: max-content;
        border-radius: 20px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        padding: 25px;
        gap: 22px;
    }

    .device-btn{
        border-radius: 1000px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        padding: 10px 30px;
        border: none
    }

    .device-btn.active{
        background: var(--pink-medium-gradient-color)
    }

    .plus-upload-btn p{
        margin: 0;
        font-size: var(--font-size-primary);
    }

    .plus-upload-btn{
        border-radius: 1000px;
        background: var(--pink-medium-gradient-color);
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        padding: 10px 30px;
        border: none
    }

    .divider{
        margin-block: unset;
    }

    .pilih-device-section{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--black-color);
        font-weight: 700;
    }

    .upload-plus-btn{
        padding: 12px;
    }

    
</style>
@endsection

<script type="module">
document.addEventListener('DOMContentLoaded', function() {
    const deviceButton = document.querySelectorAll('.device-btn');
    const mockupMobile = document.getElementById('mockup-mobile');
    const mockupLaptop = document.getElementById('mockup-laptop');
    const uploadInput = document.getElementById('portfolioUpload');
    const preview = document.getElementById('portfolioPreview');

    let lastUploadedFile = null;

    function generateVideoThumbnail(videoSrc, callback) {
        const video = document.createElement('video');
        video.src = videoSrc;
        video.crossOrigin = "anonymous"; 
        video.currentTime = 1; 

        video.addEventListener('loadeddata', () => {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/png');
            callback(imageData);
        });
    }

    const isVideo = "{{ Str::endsWith($portfolio->portfolioPath, '.mp4') ? 'true' : 'false' }}";
    if (isVideo === 'true') {
        const storedVideoPath = "{{ asset('storage/' . $portfolio->portfolioPath) }}";
        generateVideoThumbnail(storedVideoPath, (thumbnail) => {
            preview.src = thumbnail;
        });
    }

    function updateMockup(device, file) {
        const portfolioId = device === 'mobile' ? '1' : '2';
        const updateFn = window[`updateScreenTexture_mockup-container-${portfolioId}`];
        if (typeof updateFn === 'function') {
            updateFn(file);
        } else {
            console.error('updateScreenTexture tidak ditemukan:', portfolioId);
        }
    }

    deviceButton.forEach(button => {
        button.addEventListener('click', () => {
            deviceButton.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const selectedType = button.getAttribute('data-type');
            mockupTypeInput.value = selectedType;

            const selectedDevice = button.getAttribute('data-type');
            if (selectedDevice === 'mobile') {
                mockupMobile.style.display = 'block';
                mockupLaptop.style.display = 'none';

                if (lastUploadedFile) {
                    updateMockup('mobile', lastUploadedFile);
                }

                
            } else {
                mockupMobile.style.display = 'none';
                mockupLaptop.style.display = 'block';

                if (lastUploadedFile) {
                    updateMockup('laptop', lastUploadedFile);
                }
            }
        });
    });

    uploadInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        lastUploadedFile = file; 
        const activeDevice = document.querySelector('.device-btn.active').getAttribute('data-type');

        const fileURL = URL.createObjectURL(file);

        if (file.type.startsWith('image/')) {

            preview.src = fileURL;
        } else if (file.type.startsWith('video/')) {
            generateVideoThumbnail(fileURL, (thumbnail) => {
                preview.src = thumbnail;
            });
        }

        
        updateMockup(activeDevice, file);
    });

    
});
</script>