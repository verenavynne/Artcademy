@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content-admin">
    <!-- Header -->
    <div class="page-header d-flex gap-3">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <div class="navigation-prev">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </div>
        </a>

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
                    <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                    <span class="btn-text text-pink-gradient">Simpan Draft</span>
                </button>
                <button type="submit" id="nextBtn" class="btn yellow-gradient-btn px-4">
                    <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                    <span class="btn-text">Lanjut</span>
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
        const newIndex = document.querySelectorAll('.week-group').length;

        container.insertAdjacentHTML('beforeend', createWeekElement(newIndex));
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

    // update index
    function updateAllIndexes() {
        document.querySelectorAll(".week-group").forEach((week, wIndex) => {
            week.setAttribute("data-week", wIndex);

            week.querySelector("h5").textContent = "Minggu " + (wIndex + 1);

            week.querySelectorAll("input, select, textarea").forEach(el => {
                if (el.name) {
                    el.name = el.name.replace(/weeks\[\d+\]/g, `weeks[${wIndex}]`);
                }
            });

            week.querySelectorAll(".materi-group").forEach((materi, mIndex) => {
                materi.querySelector("h6").textContent = "Materi " + (mIndex + 1);

                materi.querySelectorAll("input, textarea").forEach(el => {
                    if (el.name) {
                        el.name = el.name
                            .replace(/materials\]\[\d+\]/g, `materials][${mIndex}]`)
                            .replace(/__MATERIAL_INDEX__/g, mIndex)
                            .replace(/__MATERIAL_INDEX_PLUS_ONE__/g, mIndex + 1);
                    }
                });
            });
        });
    }

    document.addEventListener("DOMContentLoaded", function () {

        // Tambah minggu pertama accordion
        const addWeekBtn = document.getElementById("add-week");
        addWeekBtn.click();

        setTimeout(() => {
            const firstWeek = document.querySelector('.week-group[data-week="0"]');
            if (!firstWeek) return;

            // EXPAND WEEK PERTAMA
            firstWeek.classList.add('active');
            const weekIcon = firstWeek.querySelector('.week-header .toggle-icon');
            if (weekIcon) {
                weekIcon.setAttribute('icon', 'iconamoon:arrow-up-2-bold');
            }

            // TAMBAH MATERI PERTAMA ACCORDION
            const addMateriBtn = firstWeek.querySelector('.add-materi');
            if (addMateriBtn) addMateriBtn.click();

            // EXPAND MATERI PERTAMA
            setTimeout(() => {
                const firstMateri = firstWeek.querySelector('.materi-group');
                if (firstMateri) {
                    firstMateri.classList.add('active');
                    const materiIcon = firstMateri.querySelector('.materi-header .toggle-icon');
                    if (materiIcon) {
                        materiIcon.setAttribute('icon', 'iconamoon:arrow-up-2-bold');
                    }
                }
            }, 80);

        }, 120);
    });

    // button loading state & direct form action
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('courseForm');
        const saveDraftBtn = document.getElementById('saveDraftBtn');
        const nextBtn = document.getElementById('nextBtn');

        function setLoading(button, textLabel) {
            const spinner = button.querySelector('.spinner-border');
            const text = button.querySelector('.btn-text');

            saveDraftBtn.disabled = true;
            nextBtn.disabled = true;

            if (spinner) spinner.classList.remove('d-none');
            if (text) text.textContent = textLabel;
        }

        saveDraftBtn.addEventListener('click', function (e) {
            e.preventDefault();

            setLoading(this, 'Memproses...');
            form.action = "{{ route('admin.courses.draftSyllabus') }}";
            form.requestSubmit();
        });

        nextBtn.addEventListener('click', function () {
            setLoading(this, 'Memproses...');
            form.action = "{{ route('admin.courses.tempSyllabus') }}";
            form.requestSubmit();
        });
    });

    // reset loading
    window.addEventListener('pageshow', function () {
        const saveDraftBtn = document.getElementById('saveDraftBtn');
        const nextBtn = document.getElementById('nextBtn');

        function resetButton(button, originalText) {
            if (!button) return;

            const spinner = button.querySelector('.spinner-border');
            const text = button.querySelector('.btn-text');

            button.disabled = false;
            if (spinner) spinner.classList.add('d-none');
            if (text) text.textContent = originalText;
        }

        resetButton(saveDraftBtn, 'Simpan Draft');
        resetButton(nextBtn, 'Lanjut');
    });
</script>
@endsection