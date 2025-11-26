@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content-admin">
    <div class="page-header d-flex gap-3">
        <div class="navigation-prev">
            <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </a>
        </div>

        <div class="d-flex flex-column">
            <h3 class="fw-bold">Tambah Event</h3>
            <p class="text-muted">Lengkapi formulir berikut untuk menambah event baru</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-warning">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.event.createEvent') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-container scroll-card-wrapper border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">

                <h5 class="fw-bold mb-3">Informasi Event</h5>
                
                <div class="row mb-3">
                    <!-- Kategori -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="eventCategory" class="form-select rounded-pill custom-input">
                            <option selected disabled>Pilih kategori</option>
                            <option value="Webinar">Webinar</option>
                            <option value="Workshop">Workshop</option>
                        </select>
                    </div>

                    <!-- Maksimal peserta -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Maksimal Peserta</label>
                        <select name="eventSlot" class="form-select rounded-pill custom-input" required>
                            <option selected disabled>Pilih Jumlah Maksimal Peserta</option>
                            @for ($i = 10; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Topik -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Topik Event</label>
                        <input type="text" name="eventName" class="form-control rounded-pill custom-input" placeholder="Apa topik event kali ini?" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Banner -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Banner Event</label>
                        <div class="upload-banner-wrapper" onclick="document.getElementById('bannerInput').click()">
                            <div id="previewContainer" class="preview-container d-none">
                                <img id="bannerPreview" class="preview-image">
                            </div>

                            <div id="uploadPlaceholder" class="upload-placeholder">
                                <iconify-icon icon="icon-park:upload-picture"></iconify-icon>
                                <p class="text-muted small m-0">Drag & Drop File atau Klik Disini</p>
                                <p class="text-muted small">(Format File: JPG, PNG)</p>
                            </div>
                        </div>

                        <input type="file" name="eventBanner" id="bannerInput" class="d-none" 
                            accept="image/png, image/jpeg" required>
                    </div>

                    <div class="col-md-6">
                        <!-- Deskripsi -->
                        <div>
                            <label class="form-label fw-semibold">Deskripsi Event</label>
                            <div class="tinymce-wrapper">
                                <textarea name="eventDesc" class="form-control rounded-4 custom-input tinymce-editor"
                                    placeholder="Event ini adalah..." required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div class="row mb-4">
                    <!-- Link Event -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Lokasi Event</label>
                        <input type="text" name="eventPlace" class="form-control rounded-pill custom-input" placeholder="Masukkan Lokasi Event" required>
                    </div>

                    <!-- Harga -->
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-semibold">Harga Event</label>
                            <div class="d-flex">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                        type="checkbox" 
                                        role="switch" 
                                        id="eventGratis">
                                </div>
                                <label class="fw-semibold">Gratis</label>
                            </div>
                            
                        </div>
                        <input type="number" name="eventPrice" class="form-control rounded-pill custom-input" placeholder="50000" required>
                    </div>
                </div>

                <hr class="title-divider">

                <h5 class="fw-bold mb-3 mt-4">Jadwal Event</h5>
                
                <div class="row mb-3">
                    <!-- Tanggal -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="eventDate" class="form-control rounded-pill custom-input" placeholder="DD/MM/YYYY" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Durasi -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Durasi (menit)</label>
                        <input type="text" name="eventDuration" class="form-control rounded-pill custom-input" placeholder="90" required>
                    </div>

                    <!-- Waktu -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Waktu</label>
                        <input type="time" name="eventStartTime" class="form-control rounded-pill custom-input" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" name="action" value="publish" class="btn yellow-gradient-btn px-4">Publikasikan</button>
        </div>
    </form>
</div>

<script src="https://cdn.tiny.cloud/1/2er11i2hdiuvi67l797urfnb807szvxxzzrsxu79b1qgecmu/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    // tinymce for event description
    tinymce.init({
        selector: '.tinymce-editor',
        menubar: false,
        plugins: 'lists link code',
        toolbar: 'undo redo | bold italic underline | bullist numlist | forecolor | code',
        height: '100%',
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave(); 
            });
        }
    });

    // upload banner
    document.getElementById('bannerInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        document.getElementById('uploadPlaceholder').classList.add('d-none');
        document.getElementById('previewContainer').classList.remove('d-none');

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('bannerPreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    });

    // event price
    const priceInput = document.querySelector('input[name="eventPrice"]');
    const freeSwitch = document.getElementById('eventGratis');

    freeSwitch.addEventListener('change', function () {
        if (this.checked) {
            priceInput.value = 0;
            priceInput.readOnly = true;
        } else {
            priceInput.readOnly = false;
            priceInput.value = '';
        }
    });
</script>

<style>
    .upload-banner-wrapper {
        border: 2px dashed var(--orange-color);
        border-radius: 20px;
        aspect-ratio: 405 / 235;
        width: 100%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        transition: 0.2s;
    }

    .upload-banner-wrapper:hover {
        background: #fff3e0;
    }

    .upload-placeholder p{
        color: var(--orange-color) !important;
    }

    .preview-container {
        width: 100%;
        height: 100%;
    }

    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 18px;
    }

    .tinymce-wrapper {
       aspect-ratio: 405/235;
    }
</style>
@endsection