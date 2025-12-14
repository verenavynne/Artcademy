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
            <p class="text-muted">Lengkapi formulir berikut untuk menambahkan projek akhir kursus</p>
        </div>
    </div>

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
    <div class="form-container border-0 shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Projek Akhir</h5>

            @if ($errors->any())
                <div class="alert alert-warning">
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
                    <div class="col-md mb-3">
                        <label class="form-label fw-semibold">Judul Projek</label>
                        <input type="text" name="projectName" class="form-control rounded-pill custom-input" placeholder="Masukkan Judul Projek">
                    </div>
                    <div class="col-md mb-3">
                        <label class="form-label fw-semibold">Tools yang digunakan</label>
                        <select name="projectTools[]" class="form-select rounded-pill custom-input" multiple>
                            @foreach ($tools as $tool)
                                <option value="{{ $tool->id }}">{{ $tool->toolsName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Konsep & Requirement -->
                <div class="row mb-3">
                    <div class="col-md mb-3">
                        <label class="form-label fw-semibold">Konsep Projek</label>
                        <textarea name="projectConcept" class="form-control rounded-4 custom-input tinymce-editor"
                            placeholder="Bagaimana konsep untuk projek ini?" ></textarea>
                    </div>
                    <div class="col-md mb-3">
                        <label class="form-label fw-semibold">Requirement</label>
                        <textarea name="projectRequirement" class="form-control rounded-4 custom-input tinymce-editor"
                            placeholder="Cth: penggunaan warna, bentuk, dsb" ></textarea>
                    </div>
                </div>

                <!-- Kriteria Penilaian -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kriteria Penilaian</label>
                    <div class="row g-3">
                        <div class="col-md">
                            <label class="form-label">Kreativitas</label>
                            <select id="creativity" name="criteriaCreativity" class="form-select rounded-pill custom-input" >
                                <option selected disabled>Pilih Persentase</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label class="form-label">Keterbacaan</label>
                            <select id="readability" name="criteriaReadability" class="form-select rounded-pill custom-input"  disabled>
                                <option selected disabled>Pilih Persentase</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label class="form-label">Kesesuaian Tema</label>
                            <select id="theme" name="criteriaTheme" class="form-select rounded-pill custom-input"  disabled>
                                <option selected disabled>Pilih Persentase</option>
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
            validateForm();
        });
    }
});


// cek input untuk disabled button
document.addEventListener("DOMContentLoaded", function () {
    const publishBtn = document.querySelector('button[value="publish"]');

    const inputs = {
        name: document.querySelector('input[name="projectName"]'),
        tools: document.querySelector('select[name="projectTools[]"]'),
        concept: document.querySelector('textarea[name="projectConcept"]'),
        requirement: document.querySelector('textarea[name="projectRequirement"]'),
        creativity: document.getElementById("creativity"),
        readability: document.getElementById("readability"),
        theme: document.getElementById("theme"),
    };

    window.validateForm = function validateForm() {
        let isValid = true;

        if (!inputs.name.value.trim()) isValid = false;
        if (!inputs.tools.value) isValid = false;
        if (!inputs.concept.value.trim()) isValid = false;
        if (!inputs.requirement.value.trim()) isValid = false;

        let c = parseInt(inputs.creativity.value ?? 0);
        let r = parseInt(inputs.readability.value ?? 0);
        let t = parseInt(inputs.theme.value ?? 0);

        if (isNaN(c) || isNaN(r) || isNaN(t)) isValid = false;
        if (c + r + t !== 100) isValid = false;

        publishBtn.disabled = !isValid;
    }

    Object.values(inputs).forEach(input => {
        input.addEventListener("change", validateForm);
        input.addEventListener("input", validateForm);
    });

    validateForm();
});
</script>
@endsection
