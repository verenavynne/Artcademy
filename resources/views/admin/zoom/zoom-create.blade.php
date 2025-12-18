@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content-admin">
    <div class="page-header d-flex gap-3">
        <a class="page-link" href="{{ route('admin.zoom.index') }}" onclick="window.history.back()">
            <div class="navigation-prev">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </div>
        </a>

        <div class="d-flex flex-column">
            <h3 class="fw-bold">Tambah Kelas Zoom</h3>
            <p class="text-muted">Lengkapi formulir berikut untuk menambah kelas zoom baru</p>
        </div>
    </div>

    <div class="form-container scroll-card-wrapper border-0 shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Informasi Kelas Zoom</h5>

            <form id="courseForm" action="{{ route('admin.zoom.createZoom') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Topik Zoom -->
                <div class="row mb-3">
                    <div class="col-md">
                        <label class="form-label fw-semibold">Topik Kelas Zoom</label>
                        <input type="text" name="zoomTopic" class="form-control rounded-pill custom-input" placeholder="Apa topik kelas zoom kali ini?" required>
                    </div>

                    <!-- Pilihan Kursus -->
                    <div class="col-md">
                        <label class="form-label fw-semibold">Pilih Kursus</label>
                        <select name="zoomCourse" class="form-select rounded-pill custom-input select-with-icon" required>
                            <option selected disabled>Zoom ini berkaitan dengan kursus apa?</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->courseName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi Zoom</label>
                    <textarea name="courseDesc" class="form-control rounded-4 custom-input" rows="4" placeholder="Kelas ini adalah..." required></textarea>
                </div>

                <!-- Link Zoom -->
                <div class="row mb-3">
                    <div class="col-md">
                        <label class="form-label fw-semibold">Lokasi Kelas Zoom</label>
                        <input type="text" name="zoomLink" class="form-control rounded-pill custom-input" placeholder="Masukkan Lokasi Kelas Zoom" required>
                    </div>

                    <!-- Tutor -->
                    <div class="col-md">
                        <label class="form-label fw-semibold">Tutor</label>
                        <select name="zoomTutor" class="form-select rounded-pill custom-input select-with-icon" disabled required>
                            <option selected disabled>Pilih Tutor</option>
                        </select>
                    </div>
                </div>
                
                <!-- Tanggal -->
                <div class="row mb-3">
                    <div class="col-md">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="zoomDate" class="form-control rounded-pill custom-input" placeholder="DD/MM/YYYY" required>
                    </div>

                    <!-- Kuota -->
                    <div class="col-md">
                        <label class="form-label fw-semibold">Maksimal Peserta</label>
                        <select name="zoomQuota" class="form-select rounded-pill custom-input select-with-icon" required>
                            <option selected disabled>Pilih Jumlah Maksimal Peserta</option>
                            @for ($i = 10; $i <= 100; $i += 10)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Durasi -->
                <div class="row mb-3">
                    <div class="col-md">
                        <label class="form-label fw-semibold">Durasi (menit)</label>
                        <input type="text" name="zoomDuration" class="form-control rounded-pill custom-input" placeholder="90" required>
                    </div>

                    <!-- Waktu -->
                    <div class="col-md">
                        <label class="form-label fw-semibold">Waktu</label>
                        <input type="time" name="zoomTime" class="form-control rounded-pill custom-input" required>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-3">
                    <button id="btnDraft" type="submit" name="action" value="draft" class="btn pink-cream-btn px-4" disabled>Simpan Draft</button>
                    <button id="btnPublish" type="submit" name="action" value="publish" class="btn yellow-gradient-btn px-4" disabled>Publikasikan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const courseSelect = document.querySelector('select[name="zoomCourse"]');
    const tutorSelect = document.querySelector('select[name="zoomTutor"]');
    const allTutors = @json($tutors);

    courseSelect.addEventListener('change', function () {
        const courseId = this.value;
        tutorSelect.innerHTML = '<option selected disabled>Pilih Tutor</option>';

        const filteredTutors = allTutors.filter(t => t.courseId == courseId);

        filteredTutors.forEach(tutor => {
            const tutorName = tutor.lecturer?.user?.name ?? 'Nama tidak tersedia';
            tutorSelect.innerHTML += `<option value="${tutor.lecturerId}">${tutorName}</option>`;
        });

        tutorSelect.disabled = false;
    });

    // cek input untuk disabled button
    function checkRequiredFields() {
        const requiredFields = [
            'input[name="zoomTopic"]',
            'select[name="zoomCourse"]',
            'textarea[name="courseDesc"]',
            'input[name="zoomLink"]',
            'select[name="zoomTutor"]',
            'input[name="zoomDate"]',
            'select[name="zoomQuota"]',
            'input[name="zoomDuration"]',
            'input[name="zoomTime"]'
        ];

        const allFilled = requiredFields.every(selector => {
            const field = document.querySelector(selector);
            return field && field.value.trim() !== '' && field.disabled === false;
        });

        document.getElementById('btnDraft').disabled = !allFilled;
        document.getElementById('btnPublish').disabled = !allFilled;
    }

    // listen semua perubahan input
    document.querySelectorAll('input, select, textarea').forEach(input => {
        input.addEventListener('input', checkRequiredFields);
        input.addEventListener('change', checkRequiredFields);
    });
</script>
@endsection