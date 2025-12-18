@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content-admin">
    <!-- Header -->
    <div class="page-header d-flex gap-3">
        <a class="page-link" href="{{ route('admin.courses.index') }}" onclick="window.history.back()">
            <div class="navigation-prev">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </div>
        </a>

        <div class="d-flex flex-column">
            <h3 class="fw-bold">Edit Kursus</h3>
            <p class="text-muted">Lengkapi formulir berikut untuk mengedit kursus</p>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="d-flex align-items-center justify-content-between mb-3" style="font-size: 14px;">
        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex justify-content-center align-items-center fw-bold me-2"
                style="width:24px;height:24px; background: var(--orange-gradient-color);">1</div>
            <span class="fw-bold">Informasi Kursus</span>
        </div>

        <div class="flex-grow-1 mx-2" style="border-top:3px dashed #ccc;"></div>

        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex justify-content-center align-items-center text-dark fw-bold me-2"
                style="width:24px;height:24px; background-color:#E0E0E0;">2</div>
            <span class="fw-bold text-muted">Silabus Kursus</span>
        </div>

        <div class="flex-grow-1 mx-2" style="border-top:3px dashed #ccc;"></div>

        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex justify-content-center align-items-center text-dark fw-bold me-2"
                style="width:24px;height:24px; background-color:#E0E0E0;">3</div>
            <span class="fw-bold text-muted">Projek Akhir</span>
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

    <!-- Form Card -->
    <div class="form-container border-0 shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Informasi Kursus</h5>

            <form id="courseForm" action="{{ route('admin.courses.updateDraftCourseInformation', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Jenis Kursus -->
                <div class="row mb-3">
                    <div class="col-md mb-3">
                        <label class="form-label fw-semibold">Kategori Kursus</label>
                        <select name="courseType" class="form-select rounded-pill custom-input select-with-icon" required>
                            <option disabled {{ !$course ? 'selected' : '' }}>Pilih Kategori Kursus</option>
                            <option value="Seni Tari" {{ old('courseType', $course->courseType ?? '') == 'Seni Tari' ? 'selected' : '' }}>Seni Tari</option>
                            <option value="Seni Musik" {{ old('courseType', $course->courseType ?? '') == 'Seni Musik' ? 'selected' : '' }}>Seni Musik</option>
                            <option value="Seni Fotografi" {{ old('courseType', $course->courseType ?? '') == 'Seni Fotografi' ? 'selected' : '' }}>Seni Fotografi</option>
                            <option value="Seni Lukis & Digital Art" {{ old('courseType', $course->courseType ?? '') == 'Seni Lukis & Digital Art' ? 'selected' : '' }}>Seni Lukis & Digital Art</option>
                        </select>
                    </div>

                    <!-- Level -->
                    <div class="col-md mb-3">
                        <label class="form-label fw-semibold">Level Kursus</label>
                        <select name="courseLevel" class="form-select rounded-pill custom-input select-with-icon" required>
                            <option disabled {{ !$course ? 'selected' : '' }}>Pilih Level</option>
                            <option value="dasar" {{ old('courseLevel', $course->courseLevel ?? '') == 'dasar' ? 'selected' : '' }}>Level Dasar</option>
                            <option value="menengah" {{ old('courseLevel', $course->courseLevel ?? '') == 'menengah' ? 'selected' : '' }}>Level Menengah</option>
                            <option value="lanjutan" {{ old('courseLevel', $course->courseLevel ?? '') == 'lanjutan' ? 'selected' : '' }}>Level Lanjutan</option>
                        </select>
                    </div>
                </div>

                <!-- Nama Kursus -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kursus</label>
                    <input type="text" name="courseName" class="form-control rounded-pill custom-input" placeholder="Masukkan nama kursus" value="{{ old('courseName', $course->courseName ?? '') }}" required>
                </div>

                <!-- Ringkasan -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ringkasan Kursus</label>
                    <input type="text" name="courseSummary" class="form-control rounded-pill custom-input" placeholder="Masukkan ringkasan singkat kursus" value="{{ old('courseSummary', $course->courseSummary ?? '') }}" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi Kursus</label>
                    <textarea name="courseText" class="form-control rounded-4 custom-input" rows="4" placeholder="Deskripsikan isi kursus..." required>{{ old('courseText', $course->courseText ?? '') }}</textarea>
                </div>

                <div class="row mb-3">
                    <!-- Tipe Pembayaran -->
                    <div class="col-md mb-3">
                        <label class="form-label fw-semibold">Tipe Pembayaran</label>
                        <select name="coursePaymentType" class="form-select rounded-pill custom-input select-with-icon" required>
                            <option disabled {{ !$course ? 'selected' : '' }}>Pilih Tipe Pembayaran</option>
                            <option value="gratis" {{ old('coursePaymentType', $course->coursePaymentType ?? '') == 'gratis' ? 'selected' : '' }}>Gratis</option>
                            <option value="berbayar" {{ old('coursePaymentType', $course->coursePaymentType ?? '') == 'berbayar' ? 'selected' : '' }}>Berbayar</option>
                        </select>
                    </div>

                    <!-- Tutor  -->
                    <div class="col-md mb-4">
                        <label class="form-label fw-semibold">Pilih 3 Tutor</label>

                        <div id="lecturers-container" class="border rounded-4 p-3 custom-input">
                            @foreach($lecturers as $lecturer)
                                @php
                                    $isChecked = isset($course) && isset($courseLecturers) && in_array($lecturer->id, $courseLecturers);
                                @endphp
                                <div class="form-check mb-2">
                                    <input 
                                        type="checkbox" 
                                        name="lecturers[]" 
                                        value="{{ $lecturer->id }}" 
                                        class="form-check-input lecturer-checkbox"
                                        data-category="{{ $lecturer->specialization }}"
                                        id="lecturer-{{ $lecturer->id }}"
                                        {{ $isChecked ? 'checked' : '' }}                                    
                                    >
                                    <label class="form-check-label" for="lecturer-{{ $lecturer->id }}">
                                        {{ $lecturer->user->name }} 
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <small class="text-muted d-block mt-2">
                            Pilih <strong>3 tutor</strong> yang sesuai dengan kategori kursus.<br>
                        </small>
                    </div>
                </div>            

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-3">
                    <button type="submit" id="saveDraftBtn" class="btn pink-cream-btn px-4">
                        <span class="text-pink-gradient">Simpan Draft</span>
                    </button>
                    <button type="submit" id="nextBtn" class="btn yellow-gradient-btn px-4">
                        Lanjut
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const courseTypeSelect = document.querySelector('select[name="courseType"]');
    const lecturersContainer = document.getElementById('lecturers-container');

    // Menampilkan tutor yang sesuai kategori
    const showLecturers = (selectedCategory) => {
        lecturersContainer.querySelectorAll('.lecturer-checkbox').forEach(cb => {
            const isMatch = cb.dataset.category === selectedCategory;
            cb.closest('.form-check').style.display = isMatch ? '' : 'none';
        });
    };

    // Halaman pertama kali dimuat
    document.addEventListener('DOMContentLoaded', () => {
        const selectedCategory = courseTypeSelect.value;

        // Kalau sedang edit dan kategori kursus sudah ada
        if (selectedCategory) {
            showLecturers(selectedCategory);
        } else {
            // Kalau belum ada kategori, sembunyikan semua dulu
            lecturersContainer.querySelectorAll('.form-check').forEach(fc => {
                fc.style.display = 'none';
            });
        }
    });

    // Saat kategori diubah
    courseTypeSelect.addEventListener('change', () => {
        const selectedCategory = courseTypeSelect.value;
        showLecturers(selectedCategory);
    });

    const form = document.getElementById('courseForm');
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const nextBtn = document.getElementById('nextBtn');

    nextBtn.addEventListener('click', () => {
        form.action = "{{ route('admin.courses.tempUpdateStore', $course->id) }}";
    });

    saveDraftBtn.addEventListener('click', (e) => {
        e.preventDefault();
        form.action = "{{ route('admin.courses.updateDraftCourseInformation', $course->id) }}";
        form.submit();
    });
</script>
@endsection
