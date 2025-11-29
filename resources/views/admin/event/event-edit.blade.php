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
            <h3 class="fw-bold">Edit Event</h3>
            <p class="text-muted">Lengkapi formulir berikut untuk mengedit event</p>
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

    <form action="{{ route('admin.event.updateEvent', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-container scroll-card-wrapper border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">

                <h5 class="fw-bold mb-3">Informasi Event</h5>
                
                <div class="row mb-3">
                    <!-- Kategori -->
                    <div class="col-md">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="eventCategory" class="form-select rounded-pill custom-input">
                            <option selected disabled>Pilih kategori</option>
                            <option value="Webinar" {{ $event->eventCategory == 'Webinar' ? 'selected' : '' }}>Webinar</option>
                            <option value="Workshop" {{ $event->eventCategory == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                        </select>
                    </div>

                    <!-- Maksimal peserta -->
                    <div class="col-md">
                        <label class="form-label fw-semibold">Maksimal Peserta</label>
                        <select name="eventSlot" class="form-select rounded-pill custom-input" required>
                            <option selected disabled>Pilih Jumlah Maksimal Peserta</option>
                            @for ($i = 10; $i <= 100; $i += 10)
                                <option value="{{ $i }}" {{ $i == $event->eventSlot ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Topik -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Topik Event</label>
                        <input type="text" name="eventName" class="form-control rounded-pill custom-input" placeholder="Apa topik event kali ini?" 
                            value="{{ old('eventName', $event->eventName) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Banner -->
                    <div class="col-md">
                        <label class="form-label fw-semibold">Banner Event</label>
                        <div class="upload-banner-wrapper" onclick="document.getElementById('bannerInput').click()">
                            <div id="previewContainer" class="preview-container {{ $event->eventBanner ? '' : 'd-none' }}">
                                <img 
                                    id="bannerPreview" 
                                    class="preview-image"
                                    src="{{ $event->eventBanner ? asset('storage/' . $event->eventBanner) : '' }}"
                                >
                            </div>
                        </div>

                        <input type="file" name="eventBanner" id="bannerInput" class="d-none" 
                            accept="image/png, image/jpeg">
                    </div>

                    <div class="col-md">
                        <label class="form-label fw-semibold">Deskripsi Event</label>
                        <div class="tinymce-wrapper">
                            <textarea name="eventDesc"
                                class="form-control rounded-4 custom-input tinymce-editor"
                                placeholder="Event ini adalah..." required>
                                {{ old('eventDesc', $event->eventDesc ?? '') }}
                            </textarea>
                        </div>
                    </div>
                </div>
                    
                <div class="row mb-4">
                    <!-- Link Event -->
                    <div class="col-md">
                        <label class="form-label fw-semibold">Lokasi Event</label>
                        <input type="text" name="eventPlace" class="form-control rounded-pill custom-input" placeholder="Masukkan Lokasi Event"
                            value="{{ old('eventPlace', $event->eventPlace) }}" required>
                    </div>

                    <!-- Harga -->
                    <div class="col-md">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-semibold">Harga Event</label>
                            
                        </div>
                        <input type="number" name="eventPrice" class="form-control rounded-pill custom-input" placeholder="50000"
                            value="{{ old('eventPrice', $event->eventPrice) }}"required>
                    </div>
                </div>

                <hr class="title-divider">

                <h5 class="fw-bold mb-3 mt-4">Jadwal Event</h5>
                
                <div class="row mb-3">
                    <!-- Tanggal -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="eventDate" class="form-control rounded-pill custom-input" placeholder="DD/MM/YYYY"
                            value="{{ old('eventDate', $event->eventDate) }}"required>
                    </div>
                </div>

                <div class="row">
                    <!-- Durasi -->
                    <div class="col-md">
                        <label class="form-label fw-semibold">Durasi (menit)</label>
                        <input type="text" name="eventDuration" class="form-control rounded-pill custom-input" placeholder="90"
                            value="{{ old('eventDuration', $event->eventDuration) }}" required>
                    </div>

                    <!-- Waktu -->
                    <div class="col-md">
                        <label class="form-label fw-semibold">Waktu</label>
                        <input type="time" name="eventStartTime" class="form-control rounded-pill custom-input"
                            value="{{ old('eventStartTime', $event->start_time) }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" name="action" value="publish" class="btn yellow-gradient-btn px-4">Simpan Perubahan</button>
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

        document.getElementById('previewContainer').classList.remove('d-none');

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('bannerPreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    });
</script>

<style>
    .upload-banner-wrapper {
        border: 2px dashed var(--orange-color);
        border-radius: 20px;
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
        height: calc(100% - 40px) !important;
    }
</style>
@endsection