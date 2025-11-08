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

    <p class="text-muted mb-4">Lengkapi formulir berikut untuk menambahkan proyek akhir kursus</p>

    <!-- Progress Steps -->
    <div class="d-flex align-items-center justify-content-between mb-5" style="font-size: 14px;">
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

        <div class="flex-grow-1 mx-2" 
            style="height: 3px; border-radius: 10px; background: var(--orange-gradient-color);">
        </div>

        <div class="d-flex align-items-center">
            <div class="rounded-circle d-flex justify-content-center align-items-center text-dark fw-bold me-2"
                style="width:24px;height:24px; background: var(--orange-gradient-color);">3</div>
            <span class="fw-bold">Projek Akhir</span>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Proyek Akhir</h5>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.courses.saveCourse') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Judul & Tools -->
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Judul Proyek</label>
                        <input type="text" name="projectName" 
                            value="{{ old('projectName', $project->projectName ?? '') }}" 
                            class="form-control rounded-pill custom-input" placeholder="Masukkan Judul Proyek">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tools yang digunakan</label>
                        <select name="projectTools[]" multiple class="form-select rounded-pill custom-input">
                            @foreach ($tools as $tool)
                                <option value="{{ $tool->id }}" 
                                    {{ in_array($tool->id, $selectedTools) ? 'selected' : '' }}>
                                    {{ $tool->toolsName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Konsep & Requirement -->
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Konsep Proyek</label>
                        <textarea name="projectConcept" class="form-control tinymce-editor"
                        placeholder="Bagaimana konsep untuk proyek ini?">
                        {{ old('projectConcept', $project->projectConcept ?? '') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Requirement</label>
                        <textarea name="projectRequirement" class="form-control tinymce-editor"
                        placeholder="Cth: penggunaan warna, bentuk, dsb">
                        {{ old('projectRequirement', $project->projectRequirement ?? '') }} </textarea>
                    </div>
                </div>

                <!-- Kriteria Penilaian -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kriteria Penilaian</label>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Kreativitas</label>
                            <select id="creativity" name="criteriaCreativity" class="form-select rounded-pill custom-input">
                                <option value="{{ $criteriaWeights['Kreativitas'] ?? 0 }}" disabled selected>
                                    {{ $criteriaWeights['Kreativitas'] ?? 0 }}%
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Keterbacaan</label>
                            <select id="readability" name="criteriaReadability" class="form-select rounded-pill custom-input"  disabled>
                                <option value="{{ $criteriaWeights['Keterbacaan'] ?? 0 }}" disabled selected>
                                    {{ $criteriaWeights['Keterbacaan'] ?? 0 }}%
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kesesuaian Tema</label>
                            <select id="theme" name="criteriaTheme" class="form-select rounded-pill custom-input" disabled>
                                <option value="{{ $criteriaWeights['Kesesuaian Tema'] ?? 0 }}" disabled selected>
                                    {{ $criteriaWeights['Kesesuaian Tema'] ?? 0 }}%
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <button type="submit" name="action" value="draft" class="btn pink-cream-btn px-4">Simpan Draft</button>
                    <button type="submit" name="action" value="publish" class="btn yellow-gradient-btn px-4">Publikasikan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/2er11i2hdiuvi67l797urfnb807szvxxzzrsxu79b1qgecmu/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const creativity = document.getElementById("creativity");
  const readability = document.getElementById("readability");
  const theme = document.getElementById("theme");

  function populateSelect(select, max = 100, step = 10, start = 0) {
    for (let i = start; i <= max; i += step) {
      const option = document.createElement("option");
      option.value = i;
      option.textContent = i + "%";
      select.appendChild(option);
    }
  }

  populateSelect(creativity, 100, 10, 0);

  creativity.addEventListener("change", function () {
    const val = parseInt(this.value);
    readability.removeAttribute("disabled");
    readability.innerHTML = '<option selected disabled>Pilih Persentase</option>';
    populateSelect(readability, 100 - val, 10, 0);
    theme.innerHTML = '<option selected disabled>Pilih Persentase</option>';
    theme.setAttribute("disabled", true);
  });

  readability.addEventListener("change", function () {
    const val1 = parseInt(creativity.value);
    const val2 = parseInt(this.value);
    const remaining = 100 - (val1 + val2);

    theme.removeAttribute("disabled");
    theme.innerHTML = '<option selected disabled>Pilih Persentase</option>';

    if (remaining >= 0) {
      const option = document.createElement("option");
      option.value = remaining;
      option.textContent = remaining + "%";
      theme.appendChild(option);
    } else {
      const option = document.createElement("option");
      option.textContent = "Tidak valid (total > 100)";
      theme.appendChild(option);
      theme.setAttribute("disabled", true);
    }
  });
});


tinymce.init({
    selector: '.tinymce-editor',
    menubar: false,
    plugins: 'lists link code',
    toolbar: 'undo redo | bold italic underline | bullist numlist | forecolor | code',
    height: 300,
    setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave(); 
        });
    }
});
</script>
@endsection
