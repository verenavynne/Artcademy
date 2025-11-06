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

            <form action="{{ route('admin.courses.saveCourse') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Judul & Tools -->
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Judul Proyek</label>
                        <input type="text" name="projectName" class="form-control rounded-pill custom-input" placeholder="Masukkan Judul Proyek" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tools yang digunakan</label>
                        <select name="projectTools" class="form-select rounded-pill custom-input" required>
                            <option selected disabled>Cth: Figma, Adobe Photoshop, dsb</option>
                            <option>Figma</option>
                            <option>Adobe Photoshop</option>
                            <option>Canva</option>
                        </select>
                    </div>
                </div>

                <!-- Konsep & Requirement -->
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Konsep Proyek</label>
                        <textarea name="projectConcept" class="form-control rounded-4 custom-input" rows="4" placeholder="Bagaimana konsep untuk proyek ini?" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Requirement</label>
                        <textarea name="projectRequirement" class="form-control rounded-4 custom-input" rows="4" placeholder="Cth: penggunaan warna, bentuk, dsb" required></textarea>
                    </div>
                </div>

                <!-- Kriteria Penilaian -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kriteria Penilaian</label>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Kreativitas</label>
                            <select name="criteriaCreativity" class="form-select rounded-pill custom-input" required>
                                <option selected disabled>Pilih Persentase</option>
                                <option>20%</option>
                                <option>30%</option>
                                <option>50%</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Keterbacaan</label>
                            <select name="criteriaReadability" class="form-select rounded-pill custom-input" required>
                                <option selected disabled>Pilih Persentase</option>
                                <option>20%</option>
                                <option>30%</option>
                                <option>50%</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kesesuaian Tema</label>
                            <select name="criteriaTheme" class="form-select rounded-pill custom-input" required>
                                <option selected disabled>Pilih Persentase</option>
                                <option>20%</option>
                                <option>30%</option>
                                <option>50%</option>
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
@endsection
