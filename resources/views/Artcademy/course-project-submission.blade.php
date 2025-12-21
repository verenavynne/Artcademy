@extends('layouts.master')

@section('content')

@if (session('info'))
    <div class="alert alert-warning mt-3">{{ session('info') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">

    <div class="d-flex flex-row align-items-center gap-4">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <div class="navigation-prev d-flex flex-start">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </div>
        </a>
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
            
            <form action="{{ route('projectSubmission.submit') }}" id="submitProjectForm" method="POST" enctype="multipart/form-data">
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
                                <button type="button" id="projectThumbnail" class="btn pink-cream-btn px-4 @error('thumbnail') is-invalid @enderror">Pilih File</button>
                                <span id="file-name" class="placeholder-file">Tidak ada file yang dipilih</span>
                                <input type="file" id="thumbnail" name="thumbnail" class="d-none" onchange="updateFileName(this)" value="{{ old('thumbnail') }}">
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
                @include('components.course-project-progress-card',['isSubmitted' => $isSubmitted, 'isDisabled' => $isDisabled, 'submission' => $submission])
            </div>
        </form>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex justify-content-center flex-column text-center p-4" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
            
            <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            
            <img src="{{ asset('assets/course/project_berhasil_dikumpulkan.png') }}" alt="Berhasil dikumpulkan" class="mb-3" width="80" style="align-self: center">
            
            <h5 class="fw-bold mb-2" style="font-size: var(--font-size-title)">Projek dikumpulkan!</h5>
            <p class="mb-4" style="margin: 0; font-size: var(--font-size-primary); color: var(--dark-gray-color)">
                Projekmu akan dinilai oleh tutor! Sambil menunggu, kamu bisa lihat kursus lainnya!
            </p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('course') }}" style ="width: 50%; align-self: center" class="btn rounded-pill pink-cream-btn px-4">
                    <p class="text-pink-gradient" style="margin: 0">Lihat Kursus Lain</p>
                </a>

                @if ($submission->projectSubmissionDate && $isSubmitted)
                    <a href="{{ route('projectSubmission.hasil', ['id'=> $submission->id]) }}"
                        class="btn text-dark yellow-gradient-btn" style="width: 50%">
                        Lihat Penilaian
                    </a>
                @else
                    <button class="btn w-100 text-dark yellow-gradient-btn" disabled>
                        Lihat Penilaian
                    </button>
                @endif
            </div>
            </div>
        </div>
    </div>

</div>

<style>

    .title{
       margin-block-end:0;
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

    .pink-cream-btn:hover {
        border: 2px solid var(--pink-color);
        background-color: var(--cream2-color);
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
        const thumbnailInput = document.getElementById('thumbnail');
        const descInput = document.getElementById('projectDesc');
        const kumpulBtn = document.getElementById('kumpulBtn');
        const projekCheckbox = document.getElementById('projekCheckbox');
        const progressBar = document.querySelector('.progress-bar');
        const progressPercentage = document.querySelector('.progress-percentage');

        document.getElementById('projectThumbnail').addEventListener('click', function() {
            document.getElementById('thumbnail').click();
        });

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

        const kumpulForm = document.getElementById('submitProjectForm');
        // const submitBtnProject = document.getElementById('kumpulBtn');
        const btnTextProject = document.getElementById('btnTextProject');
        const loadingSpinnerProject = document.getElementById('loadingSpinnerProject');

        kumpulForm.addEventListener('submit', function () {
            kumpulBtn.disabled = true;
            btnTextProject.textContent = 'Memproses...';
            loadingSpinnerProject.classList.remove('d-none');
        });
    });
</script>

@if (session('success') && isset($submission))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    });
</script>
@endif
