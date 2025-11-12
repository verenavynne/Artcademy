@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content-admin">
    <!-- Header -->
    <div class="page-header d-flex gap-3">
        <div class="navigation-prev">
            <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </a>
        </div>

        <div class="d-flex flex-column">
            <h3 class="fw-bold">Tambah Kursus</h3>
            <p class="text-muted">Lengkapi formulir berikut untuk menambahkan kursus baru</p>
        </div>
    </div>

    <!-- Progress bar -->
    <div class="d-flex align-items-center justify-content-between mb-3" style="font-size: 14px;">
        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex justify-content-center align-items-center fw-bold me-2"
                style="width:24px;height:24px; background: var(--orange-gradient-color);">1</div>
            <span class="fw-bold">Informasi Kursus</span>
        </div>

        <div class="flex-grow-1 mx-2" 
            style="height: 3px; border-radius: 10px; background: var(--orange-gradient-color);">
        </div>

        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex justify-content-center align-items-center text-dark fw-bold me-2"
                style="width:24px;height:24px; background: var(--orange-gradient-color);">2</div>
            <span class="fw-bold">Silabus Kursus</span>
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

    <div class="form-container border-0 rounded-4">
        <form id="courseForm" action="{{ route('admin.courses.draftSyllabus') }}" method="POST">
            @csrf
            <!-- Accordion Mingguan -->
            <div class="accordion" id="weekAccordion"></div>

            <!-- Tombol Tambah Minggu -->
            <div class="d-flex justify-content-end mt-4">
                <button type="button" class="rounded-circle d-flex justify-content-center align-items-center fw-bold me-2" 
                    id="add-week" style="width:24px;height:24px; background: var(--orange-gradient-color); border: none;">
                    +
                </button>
                <span class="fw-bold">Minggu</span>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="submit" id="saveDraftBtn" class="btn pink-cream-btn px-4">
                    Simpan Draft
                </button>
                <button type="submit" id="nextBtn" class="btn yellow-gradient-btn px-4">
                    Lanjut
                </button>
            </div>
        </form>
    </div>

    @include('admin.courses.components.course-week')
    @include('admin.courses.components.material-item')
</div>

<style>
    .form-container {
        background-color: transparent;
        box-shadow: none;
        padding: 0;
    }
</style>

<script>
    let weekIndex = 0;

    const availableTutors = @json($tutors);

    // Template minggu
    function createWeekElement(index) {
        const template = document.getElementById('week-template').innerHTML
            .replace(/__WEEK_INDEX__/g, index)
            .replace(/__WEEK_INDEX_PLUS_ONE__/g, index + 1);
        return template;
    }

    // Template materi
    function createMaterialElement(week, materiIndex) {
        const template = document.getElementById('material-template').innerHTML
            .replace(/__WEEK_INDEX__/g, week)
            .replace(/__MATERIAL_INDEX__/g, materiIndex)
            .replace(/__MATERIAL_INDEX_PLUS_ONE__/g, materiIndex + 1);
        return template;
    }

    // Tambah minggu
    document.getElementById('add-week').onclick = function() {
        if (availableTutors.length === 0) {
            alert('Tidak ada tutor untuk course ini!');
            return;
        }

        const container = document.getElementById('weekAccordion');
        container.insertAdjacentHTML('beforeend', createWeekElement(weekIndex));
        weekIndex++;
    };

    document.addEventListener('click', e => {
        // Tambah materi
        if (e.target.classList.contains('add-materi')) {
            const weekGroup = e.target.closest('.week-group');
            const week = e.target.dataset.week;
            const container = weekGroup.querySelector('.materi-container');
            const materiIndex = container.children.length;

            container.insertAdjacentHTML('beforeend', createMaterialElement(week, materiIndex));
        }
    });

    const form = document.getElementById('courseForm');
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const nextBtn = document.getElementById('nextBtn');

    nextBtn.addEventListener('click', () => {
        form.action = "{{ route('admin.courses.tempSyllabus') }}";
    });

    saveDraftBtn.addEventListener('click', (e) => {
        e.preventDefault();
        form.action = "{{ route('admin.courses.draftSyllabus') }}";
        form.submit();
    });
</script>
@endsection
