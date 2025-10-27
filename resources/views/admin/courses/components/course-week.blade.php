<template id="week-template">
    <div class="week-group bg-white shadow-sm rounded-4 p-4 mb-4 position-relative" data-week="__WEEK_INDEX__"
        style="border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">

        <!-- Header Minggu -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0 text-orange-gradient">Minggu __WEEK_INDEX_PLUS_ONE__</h5>
            <button type="button" class="btn p-0 text-danger remove-week">
                <i class="bi bi-trash fs-5"></i>
            </button>
        </div>

        <!-- Judul dan Tutor -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="fw-semibold">Judul</label>
                <input type="text" name="weeks[__WEEK_INDEX__][weekName]" 
                    placeholder="Masukkan Judul" 
                    class="form-control border-0 rounded-pill shadow-sm px-3 py-2 bg-light-subtle custom-input" required>
            </div>
            <div class="col-md-6">
                <label class="fw-semibold">Tutor</label>
                <select name="weeks[__WEEK_INDEX__][tutorId]" 
                    class="form-select border-0 rounded-pill shadow-sm px-3 py-2 bg-light-subtle custom-input" required>
                    <option value="" disabled selected>Pilih tutor minggu ini</option>
                    @foreach($tutors as $tutor)
                        <option value="{{ $tutor->lecturerId }}">{{ $tutor->lecturer->user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Container Materi -->
        <div class="materi-container"></div>

        <!-- Tombol Tambah Materi -->
        <div class="d-flex justify-content-end align-items-center mt-3">
            <button type="button" 
                class="rounded-circle d-flex justify-content-center align-items-center fw-bold me-2 add-materi"
                style="width:24px;height:24px; background: var(--yellow-gradient-color); border: none;"
                data-week="__WEEK_INDEX__">+</button>
                <span class="fw-bold">Materi</span>
        </div>
    </div>
</template>