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
            <h3 class="fw-bold">Edit Kelas Zoom</h3>
            <p class="text-muted">Lengkapi formulir berikut</p>
        </div>
    </div>

    <div class="form-container scroll-card-wrapper border-0 shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Informasi Kelas Zoom</h5>

            <form id="courseForm" action="{{ route('admin.zoom.updateZoom', $zoom->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Topik Zoom -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Topik Kelas Zoom</label>
                        <input type="text" name="zoomTopic" class="form-control rounded-pill custom-input" 
                               value="{{ old('zoomTopic', $zoom->zoomName) }}" required>
                    </div>

                    <!-- Pilihan Kursus -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pilih Kursus</label>
                        <select name="zoomCourse" class="form-select rounded-pill custom-input" required>
                            <option disabled>Zoom ini berkaitan dengan kursus apa?</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" 
                                    {{ $course->id == $zoom->courseId ? 'selected' : '' }}>
                                    {{ $course->courseName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi Zoom</label>
                    <textarea name="courseDesc" class="form-control rounded-4 custom-input" rows="4" required>{{ old('courseDesc', $zoom->zoomDesc) }}</textarea>
                </div>

                <!-- Link Zoom -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Lokasi Kelas Zoom</label>
                        <input type="text" name="zoomLink" class="form-control rounded-pill custom-input"
                               value="{{ old('zoomLink', $zoom->zoomLink) }}" required>
                    </div>

                    <!-- Tutor -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tutor</label>
                        <select name="zoomTutor" class="form-select rounded-pill custom-input" required>
                            <option disabled>Pilih Tutor</option>
                            @foreach($tutors as $tutor)
                                @if($tutor->courseId == $zoom->courseId)
                                    <option value="{{ $tutor->id }}" 
                                        {{ $tutor->id == $zoom->tutorId ? 'selected' : '' }}>
                                        {{ $tutor->lecturer->user->name ?? 'Nama tidak tersedia' }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <!-- Tanggal -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="zoomDate" class="form-control rounded-pill custom-input"
                               value="{{ old('zoomDate', $zoom->zoomDate) }}" required>
                    </div>

                    <!-- Kuota -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Maksimal Peserta</label>
                        <select name="zoomQuota" class="form-select rounded-pill custom-input" required>
                            <option disabled>Pilih Jumlah Maksimal Peserta</option>
                            @for ($i = 10; $i <= 100; $i += 10)
                                <option value="{{ $i }}" {{ $i == $zoom->zoomQuota ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Durasi dan Waktu -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Durasi (menit)</label>
                        <input type="text" name="zoomDuration" class="form-control rounded-pill custom-input"
                               value="{{ old('zoomDuration', $zoom->zoomDuration) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Waktu</label>
                        <input type="time" name="zoomTime" class="form-control rounded-pill custom-input"
                               value="{{ old('zoomTime', $zoom->start_time) }}" required>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn yellow-gradient-btn px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const courseSelect = document.querySelector('select[name="zoomCourse"]');
    const tutorSelect = document.querySelector('select[name="zoomTutor"]');
    const allTutors = @json($tutors);
    const currentTutorId = "{{ $zoom->tutorId ?? '' }}";

    courseSelect.addEventListener('change', function () {
        const courseId = this.value;

        tutorSelect.innerHTML = '<option disabled selected>Pilih Tutor</option>';
        tutorSelect.value = ''; 
        tutorSelect.disabled = true;

        const filteredTutors = allTutors.filter(t => t.courseId == courseId);

        filteredTutors.forEach(tutor => {
            const tutorName = tutor.lecturer?.user?.name ?? 'Nama tidak tersedia';
            tutorSelect.innerHTML += `
                <option value="${tutor.lecturerId}" ${tutor.lecturerId == currentTutorId ? 'selected' : ''}>
                    ${tutorName}
                </option>
            `;
        });

        tutorSelect.disabled = filteredTutors.length === 0;
    });
</script>
@endsection
