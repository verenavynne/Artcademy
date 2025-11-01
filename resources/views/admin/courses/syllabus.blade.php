@extends('layouts.master')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex align-items-center mb-4 gap-2">
        <div class="navigation-prev">
            <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </a>
        </div>
        <h3 class="fw-bold mb-0">Tambah Kursus</h3>
    </div>
    <p class="text-muted mb-4">Lengkapi formulir berikut untuk menambahkan kursus baru</p>

    <!-- Progress bar -->
    <div class="d-flex align-items-center justify-content-between mb-5" style="font-size: 14px;">
        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex justify-content-center align-items-center fw-bold me-2"
                style="width:24px;height:24px; background: var(--orange-gradient-color);">1</div>
            <span class="text-orange-gradient">Informasi Kursus</span>
        </div>

        <div class="flex-grow-1 mx-2" 
            style="height: 3px; border-radius: 10px; background: var(--orange-gradient-color);">
        </div>


        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex justify-content-center align-items-center text-dark fw-bold me-2"
                style="width:24px;height:24px;background: var(--orange-gradient-color);;">2</div>
            <span class="text-orange-gradient">Silabus Kursus</span>
        </div>
    </div>

    <form action="{{ route('admin.courses.saveSyllabus') }}" method="POST">
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
            <button type="submit" name="action" value="draft" class="btn pink-cream-btn px-4">
                Simpan Draft
            </button>
            <button type="submit" name="action" value="publish" class="btn yellow-gradient-btn px-4">
                Publikasi
            </button>
        </div>
    </form>

    @include('admin.courses.components.course-week')
    @include('admin.courses.components.material-item')
</div>

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
</script>
@endsection
