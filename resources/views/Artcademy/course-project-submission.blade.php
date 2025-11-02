@extends('layouts.master')

@section('content')

@if (session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif

@if (session('info'))
    <div class="alert alert-warning mt-3">{{ session('info') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">

    <div class="d-flex flex-row align-items-center gap-4">
        <div class="navigation-prev d-flex flex-start pb-4">
            <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </a>
        </div>
        <div class="d-flex flex-column pb-4">
            <p class="title text-start fw-bold">Projek Akhir</p>
            <p class="projek-title-desc">Tunjukkan skill yang sudah kamu pelajari</p>
        </div>

    </div>

    <div class="d-flex flex-row justify-content-center gap-5">
        <div class="d-flex flex-column" style="width: 60%; gap: 16px">
                @include('components.course-project-card',[
                        'project' => $project,
                        'projectTools'=>$projectTools,
                        'projectCriterias' => $projectCriterias
                        ])
            
            <form action="{{ route('projectSubmission.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="projectId" value="{{ $project->id ?? '' }}">

                <div class="projek-submission-card d-flex flex-column">
                    <p class="projek-submission-name">Upload & Kumpul Projekmu</p>
                    <p class="projek-submission-desc">Pastikan sudah sesuai dengan semua requirement yang diperlukan ya!</p>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="projek-form-label">Judul Projek</label>
                                <input type="text" id="projectTitle" name="title" 
                                        class="form-control rounded-pill @error('title') is-invalid @enderror" 
                                        placeholder="Masukkan Judul Projek Disini"
                                        value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="projek-form-label fw-semibold">Link Projek</label>
                                <div class="position-relative d-flex">
                                    <iconify-icon icon="material-symbols:link-rounded" class="input-icon"></iconify-icon>
                                    <input type="text" id="projectLink" name="link" 
                                            class="form-control rounded-pill form-link-input @error('link') is-invalid @enderror" 
                                            placeholder="Link Google Drive / Link Youtube"
                                            value="{{ old('link') }}">
                                    @error('link')
                                        <div class="invalid-feedback position-absolute" style="bottom:-22px; left:0;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="projek-form-label">Foto Thumbnail Projek</label>
                            <div class="form-upload-file d-flex align-items-center rounded-pill gap-3">
                                <label for="projectThumbnail" 
                                    class="btn upload-btn rounded-pill @error('thumbnail') is-invalid @enderror">
                                    Pilih File
                                </label>
                                <input type="file" id="projectThumbnail" name="thumbnail" class="d-none" onchange="updateFileName(this)" value="{{ old('thumbnail') }}">
                                <span id="file-name" class="placeholder-file">Tidak ada file yang dipilih</span>
                            </div>
                            @error('thumbnail')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="projek-form-label">Deskripsi Projek</label>
                            <textarea id="projectDesc" name="description" rows="4" 
                                    class="form-control description rounded-4 @error('description') is-invalid @enderror" 
                                    placeholder="Projek ini adalah...">{{ old('description') }}</textarea>
                            @error('description') 
                                <div class="invalid-feedback d-block">{{ $message }}</div> 
                            @enderror
                        </div>
                </div>
            </div>

            <div class="d-flex justify-content-center" style="width: 40%;">
                <div class="projek-progress-card d-flex flex-column">
                    <p class="projek-title">Projek Akhir</p>
                    <div class="d-flex flex-row align-items-center" style="gap: 12px">
                        <div class="progress w-100" style="height: 6px; background-color: #E5E5E5;">
                            <div class="progress-bar" role="progressbar" 
                            style="width: {{ 0 }}%; background-color: #E92D62;">
                            </div>
                        </div>
                        <p class="progress-percentage">{{ 0 }}%</p>
                    </div>

                    <div class="projek-list-content d-flex flex-row justify-content-between align-items-center">
                        <div class="projek-number-name d-flex flex-row align-items-center">
                            <div class="projek-number">
                                <p>1</p>
                            </div>

                            <div class="projek-name-title d-flex flex-column">
                                <p class="projek-name">Kumpul Projek Akhir</p>
                                <div class="d-flex flex-row align-items-center" style="gap: 4px">
                                    <iconify-icon class="projek-calender-icon" icon="tabler:calendar-week-filled"></iconify-icon>
                                    <p class="projek-date">{{ \Carbon\Carbon::now()->addWeek()->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>

                        </div>

                        <input id="projekCheckbox" 
                            class="projek-checkbox form-check-input" 
                            type="checkbox" 
                            style="pointer-events: none;" 
                            >

                    </div>

                    <button type="submit"
                        id="kumpulBtn"
                        class="btn w-100 text-dark yellow-gradient-btn  {{ $isDisabled ? 'disabled' : '' }}"
                        aria-disabled="{{ $isDisabled ? 'true' : 'false' }}"
                        >Kumpul Sekarang
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>

<style>

    .title{
        margin: 0;
        font-size: var(--font-size-title); 
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .projek-submission-card{
        background: white;
        border-radius: 40px;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        gap: 16px;
        padding-block: 40px;
        padding-inline: 38px;
    }
    
    .projek-title-desc{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);
    }

    .projek-submission-name{
        margin: 0;
        font-size: var(--font-size-big);
        color: var(--black-color);
        font-weight: 700;
    }
   
    .projek-submission-desc{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);

    }

    .projek-form-label{
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

    .upload-btn{
        background-color: #F9EEDB !important;
        border: none;
        border-radius: 50rem;
        box-shadow: 0px 4px 8px 0px var(--brown-shadow-color);
        transition: all 0.3s ease;
        align-content: center;
        position: relative;
        font-size: var(--font-size-primary);

        background-image: linear-gradient(0deg, #E92D62 25%, #FF6E97 70%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
        
        height: 100%;
        padding-inline: 30px;
        justify-content: center;
    }

    .upload-btn::before{
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 100px;
        padding: 2px;
        background: var(--pink-gradient-color);
        -webkit-mask:
            linear-gradient(#fff 0 0) content-box,
            linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
                mask-composite: exclude;
    }

    /* Progress Card */

    .projek-progress-card{
        display: flex;
        width: 439px;
        height: max-content;
        padding: 32px 30px;
        justify-content: center;
        border-radius: 44px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        gap: 28px;
    }

    .projek-title{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--black-color);
        font-weight: 700;
    }

    .projek-list-content{
        padding-inline: 5px;
        gap: 25px;
    }

    .progress-percentage{
        margin: 0;
        color: var(--black-color);
        font-size: var(--font-size-primary);
    }

    .projek-number-name{
        gap: 20px;
    }

    .projek-number p{
        margin: 0;
    }

    .projek-number{
        display: flex; 
        align-items: center; 
        justify-content: center;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        background: var(--yellow-gradient-color);
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        font-weight: 700;
        align-items: center;
        justify-content: center; 
    }

    .projek-name-title{
        gap: 4px;
    }

    .projek-name{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);
    }

    .projek-date{
        margin: 0;
        font-size: var(--font-size-tiny);
        color: var(--dark-gray-color);
    }


    .projek-calender-icon{
        font-size: 16px
    }

    .form-check-input{
        width: 24px;
        height: 24px;
        border-radius: 10px;
        border-color: 1px var(--dark-gray-color)
    }

    .form-check-input:checked {
        background: var(--orange-gradient-color);
        border-color: var(--orange-gradient-color);
        position: relative;
    }

    .form-check-input:checked::after {
        content: "";
        position: absolute;
        top: 3px;
        left: 9px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .yellow-gradient-btn.disabled{
        background: #D0D0D0;
    }
</style>
@endsection

<script>
    function updateFileName(input) {
        const fileName = input.files.length > 0 ? input.files[0].name : "Tidak ada file yang dipilih";
        document.getElementById("file-name").innerText = fileName;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('projectTitle');
        const linkInput = document.getElementById('projectLink');
        const thumbnailInput = document.getElementById('projectThumbnail');
        const descInput = document.getElementById('projectDesc');
        const kumpulBtn = document.getElementById('kumpulBtn');
        const projekCheckbox = document.getElementById('projekCheckbox');
        const progressBar = document.querySelector('.progress-bar');
        const progressPercentage = document.querySelector('.progress-percentage');

        function checkFormFilled() {
            const isFilled =
                titleInput.value.trim() !== '' &&
                linkInput.value.trim() !== '' &&
                thumbnailInput.files.length > 0 &&
                descInput.value.trim() !== '';

            projekCheckbox.checked = isFilled;

            kumpulBtn.disabled = !isFilled;
            kumpulBtn.setAttribute('aria-disabled', !isFilled ? 'true' : 'false');
            kumpulBtn.classList.toggle('disabled', !isFilled);

            if (isFilled) {
                progressBar.style.width = '100%';
                progressPercentage.textContent = '100%';
            } else {
                progressBar.style.width = '0%';
                progressPercentage.textContent = '0%';
            }

            return isFilled;
        }

        [titleInput, linkInput, thumbnailInput, descInput].forEach(input => {
            input.addEventListener('input', checkFormFilled);
            input.addEventListener('change', checkFormFilled);
        });


        projekCheckbox.addEventListener('change', function() {
            kumpulBtn.disabled = !this.checked;
            kumpulBtn.classList.toggle('disabled', !this.checked);
        });

        kumpulBtn.addEventListener('click', function(event) {
            if (!checkFormFilled()) {
                event.preventDefault();
                alert('Lengkapi semua field sebelum mengumpulkan projek!');
                return;
            }
            projekCheckbox.checked = true;
        });

        checkFormFilled();
    });
</script>
