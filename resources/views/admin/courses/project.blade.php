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

                        <div class="dropdown">
                            <button
                                class="form-control rounded-pill text-start dropdown-checkbox-with-icon"
                                type="button"
                                id="toolsDropdown"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                Pilih Tools
                            </button>

                            <ul class="dropdown-menu dropdown-checkbox-menu w-100 p-3"
                                aria-labelledby="toolsDropdown"
                                id="tools-container">

                                @foreach ($tools as $tool)
                                    <li class="form-check dropdown-checkbox-item">
                                        <input
                                            type="checkbox"
                                            name="projectTools[]"
                                            value="{{ $tool->id }}"
                                            class="form-check-input tool-checkbox"
                                            id="tool-{{ $tool->id }}"
                                            {{ in_array($tool->id, old('projectTools', $selectedTools ?? [])) ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label ms-2" for="tool-{{ $tool->id }}">
                                            {{ $tool->toolsName }}
                                        </label>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
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
                            <select id="creativity" name="criteriaCreativity" class="form-select rounded-pill custom-input select-with-icon" >
                                <option selected disabled>Pilih Persentase</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label class="form-label">Keterbacaan</label>
                            <select id="readability" name="criteriaReadability" class="form-select rounded-pill custom-input select-with-icon"  disabled>
                                <option selected disabled>Pilih Persentase</option>
                            </select>
                        </div>
                        <div class="col-md">
                            <label class="form-label">Kesesuaian Tema</label>
                            <select id="theme" name="criteriaTheme" class="form-select rounded-pill custom-input select-with-icon"  disabled>
                                <option selected disabled>Pilih Persentase</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <button id="saveDraftBtn" type="submit" class="btn pink-cream-btn px-4">
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        <span class="btn-text text-pink-gradient">Simpan Draft</span>
                    </button>
                    <button id="publishBtn" type="button" class="btn yellow-gradient-btn px-4">
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        <span class="btn-text">Publikasikan</span>
                    </button>
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

// dropdown checkbox tools
const toolsDropdownBtn = document.getElementById('toolsDropdown');
const toolCheckboxes = document.querySelectorAll('.tool-checkbox');

function updateToolsDropdownText() {
    const checked = document.querySelectorAll('.tool-checkbox:checked');
    const names = Array.from(checked).map(cb =>
        cb.nextElementSibling.textContent.trim()
    );

    toolsDropdownBtn.textContent = names.length
        ? names.join(', ')
        : 'Pilih Tools';
}

document.addEventListener('DOMContentLoaded', () => {
    updateToolsDropdownText();
});

toolCheckboxes.forEach(cb => {
    cb.addEventListener('change', updateToolsDropdownText);
});

document.querySelector('#tools-container')
    .addEventListener('click', e => e.stopPropagation());


// cek input untuk disabled button
document.addEventListener("DOMContentLoaded", function () {
    const publishBtn = document.querySelector('button[value="publish"]');

    const inputs = {
        name: document.querySelector('input[name="projectName"]'),
        concept: document.querySelector('textarea[name="projectConcept"]'),
        requirement: document.querySelector('textarea[name="projectRequirement"]'),
        creativity: document.getElementById("creativity"),
        readability: document.getElementById("readability"),
        theme: document.getElementById("theme"),
    };

    const toolCheckboxes = document.querySelectorAll('input[name="projectTools[]"]');

    window.validateForm = function validateForm() {
        let isValid = true;

        // project name
        if (!inputs.name.value.trim()) isValid = false;

        // tools (minimal 1 dicentang)
        const selectedTools = document.querySelectorAll(
            'input[name="projectTools[]"]:checked'
        );
        if (selectedTools.length === 0) isValid = false;

        // textareas
        if (!inputs.concept.value.trim()) isValid = false;
        if (!inputs.requirement.value.trim()) isValid = false;

        // criteria
        let c = parseInt(inputs.creativity.value ?? 0);
        let r = parseInt(inputs.readability.value ?? 0);
        let t = parseInt(inputs.theme.value ?? 0);

        if (isNaN(c) || isNaN(r) || isNaN(t)) isValid = false;
        if (c + r + t !== 100) isValid = false;

        publishBtn.disabled = !isValid;
    };

    // input & textarea
    Object.values(inputs).forEach(input => {
        input.addEventListener("input", validateForm);
        input.addEventListener("change", validateForm);
    });

    // checkbox tools
    toolCheckboxes.forEach(cb => {
        cb.addEventListener("change", validateForm);
    });

    validateForm();
});

// button loading state & direct form action
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action*="saveCourse"]');
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const publishBtn = document.getElementById('publishBtn');

    function setLoading(button, textLabel) {
        const spinner = button.querySelector('.spinner-border');
        const text = button.querySelector('.btn-text');

        saveDraftBtn.disabled = true;
        publishBtn.disabled = true;

        if (spinner) spinner.classList.remove('d-none');
        if (text) text.textContent = textLabel;
    }

    function setAction(value) {
        let actionInput = form.querySelector('input[name="action"]');
        if (!actionInput) {
            actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            form.appendChild(actionInput);
        }
        actionInput.value = value;
    }

    // simpan draft
    saveDraftBtn.addEventListener('click', function () {
        setAction('draft');
        setLoading(this, 'Memproses...');
        form.requestSubmit();
    });

    // publikasikan
    publishBtn.addEventListener('click', function () {
        if (publishBtn.disabled) return;

        setAction('publish');
        setLoading(this, 'Memproses...');
        form.requestSubmit();
    });
});


// reset loading
window.addEventListener('pageshow', function () {
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const publishBtn = document.getElementById('publishBtn');

    function resetButton(button, originalText) {
        if (!button) return;

        const spinner = button.querySelector('.spinner-border');
        const text = button.querySelector('.btn-text');

        button.disabled = false;
        if (spinner) spinner.classList.add('d-none');
        if (text) text.textContent = originalText;
    }

    resetButton(saveDraftBtn, 'Simpan Draft');
    resetButton(publishBtn, 'Publikasikan');
});
</script>
@endsection
