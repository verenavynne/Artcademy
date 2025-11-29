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
            <h3 class="fw-bold">Edit Kursus</h3>
            <p class="text-muted">Lengkapi formulir berikut untuk mengedit kursus</p>
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
        <form id="courseForm" action="{{ route('admin.courses.updateDraftSyllabus', $course->id) }}" method="POST">
            @csrf

            <!-- Accordion Mingguan -->
            <div class="accordion" id="weekAccordion">
                @foreach($weeks as $week)
                <div class="week-group bg-white shadow-sm rounded-4 p-4 mb-4 position-relative" data-week="{{ $loop->index }}">
                    <!-- Header Minggu -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="week-header d-flex justify-content-between align-items-center cursor-pointer">
                            <h5 class="fw-bold mb-0 text-orange-gradient">Minggu {{ $loop->index + 1 }}</h5>
                            <iconify-icon icon="iconamoon:arrow-down-2-bold" class="toggle-icon"></iconify-icon>
                        </div>
                        <button type="button" class="btn p-0 text-danger remove-week">
                            <iconify-icon icon="fluent:delete-12-filled" class="toggle-icon"></iconify-icon>
                        </button>
                    </div>

                    <!-- Judul dan Tutor -->
                    <div class="week-body">
                        <div class="row mb-4">
                            <div class="col-md">
                                <label class="fw-semibold">Judul</label>
                                <input type="text" name="weeks[{{ $loop->index }}][weekName]" 
                                    value="{{ $week->weekName }}" 
                                    class="form-control border-0 rounded-pill shadow-sm px-3 py-2 bg-light-subtle custom-input" required>
                            </div>
                            <div class="col-md">
                                <label class="fw-semibold">Tutor</label>
                                <select name="weeks[{{ $loop->index }}][tutorId]" 
                                    class="form-select border-0 rounded-pill shadow-sm px-3 py-2 bg-light-subtle custom-input" required>
                                    <option value="" disabled {{ $week->selectedLecturerId ? '' : 'selected' }}>Pilih tutor minggu ini</option>
                                    @foreach($tutors as $tutor)
                                        <option value="{{ $tutor->id }}" {{ $week->selectedLecturerId == $tutor->id ? 'selected' : '' }}>
                                            {{ $tutor->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Container Materi -->
                        <div class="materi-container">
                            @foreach($week->materials as $materi)
                            <div class="materi-group shadow-sm rounded-4 p-3 mt-3 bg-white position-relative">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="material-header d-flex justify-content-between align-items-center cursor-pointer">
                                        <h6 class="fw-bold mb-0">Materi {{ $loop->index + 1 }}</h6>
                                        <iconify-icon icon="iconamoon:arrow-down-2-bold" class="toggle-icon"></iconify-icon>
                                    </div>
                                    <button type="button" class="btn p-0 text-danger remove-materi">
                                        <iconify-icon icon="fluent:delete-12-filled" class="toggle-icon"></iconify-icon>
                                    </button>
                                </div>

                                <div class="material-body">
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="fw-semibold">Nama Materi</label>
                                            <input type="text" name="weeks[{{ $loop->parent->index }}][materials][{{ $loop->index }}][materiName]"
                                                value="{{ $materi->materiName }}" 
                                                placeholder="Nama Materi" class="form-control mb-2 rounded-pill custom-input" required> 
                                        </div>

                                        <div class="col-md">
                                            <label class="fw-semibold">Durasi Materi (menit)</label>
                                            <input type="number" name="weeks[{{ $loop->parent->index }}][materials][{{ $loop->index }}][duration]"
                                                value="{{ $materi->duration }}"
                                                placeholder="Masukkan durasi (menit)" class="form-control mb-2 rounded-pill custom-input" required>
                                        </div>
                                    </div>

                                    <!-- Tipe materi radio (video/article/project) -->
                                    <div class="d-flex align-items-center gap-4">
                                        <label class="d-flex align-items-center gap-2 mb-0">
                                            <input type="radio" 
                                                name="weeks[{{ $loop->parent->index }}][materials][{{ $loop->index }}][type]" 
                                                value="video" 
                                                {{ $materi->vblName ? 'checked' : '' }} 
                                                class="materi-type-radio" required>
                                            <span>Video</span>
                                        </label>

                                        <label class="d-flex align-items-center gap-2 mb-0">
                                            <input type="radio" 
                                                name="weeks[{{ $loop->parent->index }}][materials][{{ $loop->index }}][type]" 
                                                value="article" 
                                                {{ $materi->articleName ? 'checked' : '' }} 
                                                class="materi-type-radio" required>
                                            <span>Artikel</span>
                                        </label>
                                    </div>

                                    <input type="hidden" name="weeks[{{ $loop->parent->index }}][materials][{{ $loop->index }}][articleName]" value="{{ $materi->articleName ?? '' }}">
                                    <input type="hidden" name="weeks[{{ $loop->parent->index }}][materials][{{ $loop->index }}][articleText]" value="{{ $materi->articleText ?? '' }}">
                                    <input type="hidden" name="weeks[{{ $loop->parent->index }}][materials][{{ $loop->index }}][vblName]" value="{{ $materi->vblName ?? '' }}">
                                    <input type="hidden" name="weeks[{{ $loop->parent->index }}][materials][{{ $loop->index }}][vblDesc]" value="{{ $materi->vblDesc ?? '' }}">
                                    <input type="hidden" name="weeks[{{ $loop->parent->index }}][materials][{{ $loop->index }}][vblUrl]" value="{{ $materi->vblUrl ?? '' }}">

                                    <div class="materi-content mt-3"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Tombol Tambah Materi -->
                        <div class="d-flex justify-content-end align-items-center mt-3">
                            <button type="button" 
                                class="rounded-circle d-flex justify-content-center align-items-center fw-bold me-2 add-materi"
                                style="width:24px;height:24px; background: var(--yellow-gradient-color); border: none;"
                                data-week="{{ $loop->index }}">+</button>
                            <span class="fw-bold">Materi</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


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

    // vbl & article
    function initMateriContent(materiGroup) {
        const materiContent = materiGroup.querySelector('.materi-content');
        if (!materiContent) return;

        const radioArticle = materiGroup.querySelector('input[value="article"]');
        const radioVideo = materiGroup.querySelector('input[value="video"]');

        const baseName = radioArticle ? radioArticle.name.replace('[type]', '') :
                        radioVideo ? radioVideo.name.replace('[type]', '') : '';

        const articleName = materiGroup.querySelector('input[name*="[articleName]"]')?.value;
        const articleText = materiGroup.querySelector('input[name*="[articleText]"]')?.value;
        const vblName = materiGroup.querySelector('input[name*="[vblName]"]')?.value;
        const vblDesc = materiGroup.querySelector('input[name*="[vblDesc]"]')?.value;
        const vblUrl = materiGroup.querySelector('input[name*="[vblUrl]"]')?.value;

        if ((articleName || articleText) || radioArticle.checked) {
            radioArticle.checked = true;
            materiContent.innerHTML = `
                <input type="text" name="${baseName}[articleName]" value="${articleName ?? ''}" placeholder="Masukkan Judul Artikel" class="form-control mb-2 rounded-pill custom-input">
                <textarea name="${baseName}[articleText]" class="form-control article-textarea">${articleText ?? ''}</textarea>
            `;

            if (tinymce.get(`${baseName}[articleText]`)) {
                tinymce.get(`${baseName}[articleText]`).remove();
            }

            tinymce.init({
                selector: `textarea[name="${baseName}[articleText]"]`,
                menubar: false,
                plugins: 'lists link code font fontsize textcolor',
                toolbar: 'undo redo | bold italic underline | bullist numlist | forecolor | code',
                height: 300
            });

        } else if ((vblName || vblDesc || vblUrl) || radioVideo.checked) {
            radioVideo.checked = true;
            materiContent.innerHTML = `
                <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label fw-semibold">Judul Video</label>
                            <input type="text" 
                                name="${baseName}[vblName]" value="${vblName ?? ''}" 
                                placeholder="Masukkan Judul Video" 
                                class="form-control rounded-pill custom-input">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Link Video</label>
                            <div class="d-flex align-items-center px-3 py-2 rounded-pill shadow-sm bg-light-subtle custom-input">
                                <iconify-icon icon="material-symbols:link-rounded" class="me-2"></iconify-icon>                    
                                <input type="text" 
                                    name="${baseName}[vblUrl]" value="${vblUrl ?? ''}"
                                    placeholder="Masukkan Link Video" 
                                    class="form-control border-0 bg-transparent flex-grow-1 shadow-none"
                                    style="box-shadow:none; outline:none;">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi Video</label>
                        <textarea 
                            name="${baseName}[vblDesc]" value="${vblDesc ?? ''}"
                            placeholder="Masukkan deskripsi video..." 
                            rows="3"
                            class="form-control mb-2 rounded-pill custom-input">${vblDesc ?? ''}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tools yang digunakan</label>
                        <div id="tools-container" class="border rounded-4 p-3 custom-input">
                            @foreach($tools as $tool)
                                @php
                                    // Cek apakah materi ini sudah punya tool tersebut
                                    $isChecked = isset($materi) && $materi->materiTools->pluck('toolId')->contains($tool->id);
                                @endphp
                                <div class="form-check mb-2">
                                    <input 
                                        type="checkbox" 
                                        name="${baseName}[tools][]" 
                                        value="{{ $tool->id }}" 
                                        class="form-check-input tool-checkbox"
                                        id="tool-{{ $tool->id }}"
                                        {{ $isChecked ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tool-{{ $tool->id }}">
                                        {{ $tool->toolsName }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
            `;
        } else {
            materiContent.innerHTML = '';
        }
    }

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

    // draft / next button
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.materi-group').forEach(initMateriContent);
    });

    const form = document.getElementById('courseForm');
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const nextBtn = document.getElementById('nextBtn');

    nextBtn.addEventListener('click', () => {
        form.action = "{{ route('admin.courses.tempUpdateSyllabus', $course->id)  }}";
    });

    saveDraftBtn.addEventListener('click', (e) => {
        e.preventDefault();
        form.action = "{{ route('admin.courses.updateDraftSyllabus', $course->id) }}";
        form.submit();
    });
</script>
@endsection