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
            <h3 class="fw-bold">Tambah Kursus</h3>
            <p class="text-muted">Lengkapi formulir berikut untuk menambahkan kursus baru</p>
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

            <form id="courseForm" action="{{ route('admin.courses.draftCourseInformation') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Jenis Kursus -->
                <div class="row mb-3">
                    <div class="col-md mb-3">
                        <label class="form-label fw-semibold">Kategori Kursus</label>
                        <select name="courseType" class="form-select rounded-pill custom-input select-with-icon" required>
                            <option selected disabled>Pilih Kategori Kursus</option>
                            <option value="Seni Tari">Seni Tari</option>
                            <option value="Seni Musik">Seni Musik</option>
                            <option value="Seni Fotografi">Seni Fotografi</option>
                            <option value="Seni Lukis & Digital Art">Seni Lukis & Digital Art</option>
                        </select>
                    </div>

                    <!-- Level -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Level Kursus</label>
                        <select name="courseLevel" class="form-select rounded-pill custom-input select-with-icon" required>
                            <option selected disabled>Pilih Level</option>
                            <option value="dasar">Level Dasar</option>
                            <option value="menengah">Level Menengah</option>
                            <option value="lanjutan">Level Lanjutan</option>
                        </select>
                    </div>
                </div>

                <!-- Nama Kursus -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Kursus</label>
                    <input type="text" name="courseName" class="form-control rounded-pill custom-input" placeholder="Masukkan nama kursus" required>
                </div>

                <!-- Ringkasan -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ringkasan Kursus</label>
                    <input type="text" name="courseSummary" class="form-control rounded-pill custom-input" placeholder="Masukkan ringkasan singkat kursus" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi Kursus</label>
                    <textarea name="courseText" class="form-control rounded-4 custom-input" rows="4" placeholder="Deskripsikan isi kursus..." required></textarea>
                </div>

                <div class="row mb-3">
                    <!-- Tipe Pembayaran -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tipe Pembayaran</label>
                        <select name="coursePaymentType" class="form-select rounded-pill custom-input select-with-icon" required>
                            <option selected disabled>Pilih Tipe Pembayaran</option>
                            <option value="gratis">Gratis</option>
                            <option value="berbayar">Berbayar</option>
                        </select>
                    </div>

                    <!-- Tutor  -->
                    <div class="col-md mb-4">
                        <label class="form-label fw-semibold">Pilih 3 Tutor</label>

                        <div class="dropdown">
                            <button 
                                class="form-control rounded-pill text-start dropdown-checkbox-with-icon"
                                type="button"
                                id="tutorDropdown"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                disabled
                            >
                                Pilih Tutor
                            </button>

                            <ul class="dropdown-menu dropdown-checkbox-menu w-100 p-3" aria-labelledby="tutorDropdown" id="lecturers-container">
                                @foreach($lecturers as $lecturer)
                                    <li class="form-check dropdown-checkbox-item" data-category="{{ $lecturer->specialization }}">
                                        <input
                                            class="form-check-input lecturer-checkbox"
                                            type="checkbox"
                                            name="lecturers[]"
                                            value="{{ $lecturer->id }}"
                                            id="lecturer-{{ $lecturer->id }}"
                                        >
                                        <label class="form-check-label ms-2" for="lecturer-{{ $lecturer->id }}">
                                            {{ $lecturer->user->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <small class="text-muted d-block mt-2">
                            Pilih maksimal <strong>3 tutor</strong> sesuai kategori kursus
                        </small>
                    </div>
                </div>            

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-3">
                    <button type="button" id="saveDraftBtn" class="btn pink-cream-btn px-4">
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
    const dropdownBtn = document.getElementById('tutorDropdown');
    const lecturers = document.querySelectorAll('.dropdown-checkbox-item');
    const checkboxes = document.querySelectorAll('.lecturer-checkbox');

    // DEFAULT: dropdown disable
    dropdownBtn.disabled = true;

    courseTypeSelect.addEventListener('change', () => {
        const selectedCategory = courseTypeSelect.value;

        if (selectedCategory) {
            dropdownBtn.disabled = false;
            dropdownBtn.textContent = 'Pilih Tutor';
        } else {
            dropdownBtn.disabled = true;
            dropdownBtn.textContent = 'Pilih Tutor';
        }

        // filter tutor + reset checkbox
        lecturers.forEach(item => {
            const checkbox = item.querySelector('.lecturer-checkbox');

            if (item.dataset.category === selectedCategory) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
                checkbox.checked = false;
            }
        });

        updateDropdownText();
    });

    function updateDropdownText() {
        const checked = document.querySelectorAll('.lecturer-checkbox:checked');
        const names = Array.from(checked).map(cb =>
            cb.nextElementSibling.textContent.trim()
        );

        dropdownBtn.textContent = names.length
            ? names.join(', ')
            : 'Pilih Tutor';
    }

    // limit max 3 tutor
    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            const checkedCount = document.querySelectorAll('.lecturer-checkbox:checked').length;

            if (checkedCount > 3) {
                cb.checked = false;
                return;
            }

            updateDropdownText();
        });
    });

    const form = document.getElementById('courseForm');
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const nextBtn = document.getElementById('nextBtn');

    nextBtn.addEventListener('click', () => {
        form.action = "{{ route('admin.courses.tempStore') }}";
    });

    saveDraftBtn.addEventListener('click', (e) => {
        e.preventDefault();
        form.action = "{{ route('admin.courses.draftCourseInformation') }}";
        form.submit();
    });


    // cek input untuk disabled button
    const lecturerCheckboxes = document.querySelectorAll('.lecturer-checkbox');
    const nextButton = document.getElementById('nextBtn');
    const draftButton = document.getElementById('draftBtn');
    
    nextButton.disabled = true;
    nextButton.classList.add('disabled-btn');

    function checkSelectedLecturers() {
        const selectedCount = document.querySelectorAll('.lecturer-checkbox:checked').length;

        if (selectedCount === 3) {
            nextButton.disabled = false;
            nextButton.classList.remove('disabled-btn');
        } else {
            nextButton.disabled = true;
            nextButton.classList.add('disabled-btn');
        }
    }

    lecturerCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            let selectedCount = document.querySelectorAll('.lecturer-checkbox:checked').length;
            if (selectedCount > 3) {
                cb.checked = false;
                selectedCount--;
            }

            checkSelectedLecturers();
        });
    });
</script>
@endsection
