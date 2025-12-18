@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">Manajemen Kursus</h4>
        <a href="{{ route('admin.courses.create') }}" class="btn text-dark d-flex align-items-center gap-2 yellow-gradient-btn px-4 py-3">
            Tambah Kursus <iconify-icon icon="ic:round-plus"></iconify-icon>
        </a>
    </div>

    <div class="status-tab-container mb-4 mt-4">
        <div class="tab-header">
            <button class="tab-link {{ $activeTab === 'draft' ? 'active' : '' }}" data-status="draft">
                Draft
            </button>
            <button class="tab-link {{ $activeTab === 'publikasi' ? 'active' : '' }}" data-status="publikasi">
                Dipublikasikan
            </button>
            <button class="tab-link {{ $activeTab === 'arsip' ? 'active' : '' }}" data-status="arsip">
                Diarsipkan
            </button>
            <button class="tab-link {{ $activeTab === 'all' ? 'active' : '' }}" data-status="all">
                Semua
            </button>
            <div class="tab-underline"></div>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <!-- Dropdown Pagination -->
        <form action="{{ route('admin.courses.index') }}" method="GET" class="d-flex align-items-center mb-2">
            <div class="custom-select-wrapper me-3" style="width: 80px; height: 48px;" onclick="closeOnIconClick(this)">
                <select name="perPage"
                    class="form-select form-select-sm rounded-pill shadow-sm border-0 select-custom-dynamic" style="min-height: 0; font-size: 18px; padding-left: 24px; padding-right: 24px;"
                    onchange="this.form.submit()"
                    onblur="toggleChevron(this, false)"
                    style="height: 100%; font-size: 18px;">
                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </div>
            <span style="font-size: 18px;">Data Kursus</span>
        </form>

        <!-- Search -->
        <form action="{{ route('admin.courses.index') }}" method="GET" class="d-flex align-items-center">
            <div class="d-flex align-items-center rounded-pill px-3 shadow-sm custom-input-2"
                style="width: 250px; height: 48px; background-color: #fff; justify-content: space-between;">
                
                <input type="text" 
                    name="search"
                    value="{{ request('search') }}" 
                    placeholder="Cari kursus..."
                    class="form-control border-0 bg-transparent flex-grow-1 ps-2"
                    style="outline: none; box-shadow: none;">
                    
                <button type="submit" 
                        class="btn border-0 bg-transparent p-0 d-flex align-items-center justify-content-center">
                    <iconify-icon icon="icon-park-outline:search" width="20" height="20"></iconify-icon>
                </button>
            </div>
        </form>
    </div>


    <div class="table-section">
        <div class="table-data">
            <table class="table table-borderless">
                <thead class="sticky-top">
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Waktu Dibuat</th>
                        <th>Nama Kursus</th>
                        <th>Kategori</th>
                        <th>Level Kursus</th>
                        <th class="text-center">Jumlah Pendaftar</th>
                        <th>Terakhir Diubah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($courses as $index => $course)
                        @php
                            $backgroundCourseStatus = match($course->courseStatus) {
                                'publikasi' => '#EAFFEC',    
                                'draft' => '#E7F6FE',         
                                'arsip' => '#FFEAF0'
                            };

                            $backgroundCourseStatusText = match($course->courseStatus) {
                                'publikasi' => 'var(--green-gradient-color)',    
                                'draft' => 'var(--blue-gradient-color)',         
                                'arsip' => 'var(--pink-gradient-color)'
                            };
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration + ($courses->currentPage() - 1) * $courses->perPage() }}</td>
                            <td>{{ $course->created_at->format('d M Y H:i') }}</td>
                            <td class="text-truncate-ellipsis" title="{{ $course->courseName }}">{{ $course->courseName }}</td>
                            <td class="text-truncate-ellipsis" title="{{ $course->courseType }}">{{ $course->courseType }}</td>
                            <td>{{ ucfirst($course->courseLevel) }}</td>
                            <td class="text-center">{{ $course->course_enrollments_count }}</td>
                            <td>{{ $course->updated_at->format('d M Y H:i') }}</td>
                            <td>
                                @if($course->courseStatus === 'publikasi')
                                    <div class="course-status-text-container" style="background: {{ $backgroundCourseStatus }}">
                                        <p class="course-status-text" style="background: {{ $backgroundCourseStatusText }}; margin: 0; background-clip: text; font-weight: 700; font-size:var(--font-size-small)">Dipublikasikan</p>
                                    </div>
                                @elseif($course->courseStatus === 'draft')
                                    <div class="course-status-text-container" style="background: {{ $backgroundCourseStatus }}">
                                        <p class="course-status-text" style="background: {{ $backgroundCourseStatusText }}; margin: 0; background-clip: text; font-weight: 700; font-size:var(--font-size-small)">Draft</p>
                                    </div>
                                @elseif($course->courseStatus === 'arsip')
                                    <div class="course-status-text-container" style="background: {{ $backgroundCourseStatus }}">
                                        <p class="course-status-text" style="background: {{ $backgroundCourseStatusText }}; margin: 0; background-clip: text; font-weight: 700; font-size:var(--font-size-small)">Diarsipkan</p>
                                    </div>
                                @endif
                            </td>
                            <td class="text-nowrap">
                                @if($course->courseStatus !== 'draft')
                                <a href="{{ route('course.detail', $course->id) }}" class="btn btn-sm p-0 me-2 border-0 bg-transparent">
                                    <iconify-icon icon="fa6-solid:eye" width="20" height="20"></iconify-icon>
                                </a>
                                @endif
                                @if($course->courseStatus !== 'publikasi')
                                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm text-warning p-0 me-2 border-0 bg-transparent">
                                        <iconify-icon icon="lets-icons:edit" width="20" height="20"></iconify-icon>
                                    </a>
                                @endif
                                @if($course->courseStatus === 'publikasi')
                                    <button
                                        type="button"
                                        class="btn btn-sm p-0 border-0 bg-transparent"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmActionModal"

                                        data-action="{{ route('admin.courses.archive', $course->id) }}"
                                        data-title="Arsipkan Kursus ini?"
                                        data-message="Semua progres tetap disimpan kok dan kamu bisa publikasikan lagi kapanpun kamu mau"
                                        data-button="Arsipkan"
                                        data-icon="{{ asset('assets/course/archive.svg') }}"
                                    >
                                        <iconify-icon icon="material-symbols:archive-rounded"
                                                    width="20" height="20"
                                                    style="color: var(--pink-medium-color)">
                                        </iconify-icon>
                                    </button>
                                @endif
                                @if($course->courseStatus !== 'publikasi')
                                    <button
                                        type="button"
                                        class="btn btn-sm p-0 border-0 bg-transparent"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmActionModal"

                                        data-action="{{ route('admin.courses.destroy', $course->id) }}"
                                        data-title="Hapus Kursus ini?"
                                        data-message="Setelah dihapus, kamu tidak bisa memulihkannya lagi"
                                        data-button="Hapus"
                                        data-icon="{{ asset('assets/portfolio/portfolio_hapus.png') }}"
                                    >
                                        <iconify-icon icon="fluent:delete-12-filled"
                                                    width="20" height="20"
                                                    class="text-danger">
                                        </iconify-icon>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4" style="display: table-cell;">Tidak ada data kursus.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small ms-2">
            Menampilkan {{ $courses->firstItem() }} sampai {{ $courses->lastItem() }} dari {{ $courses->total() }} data
        </div>

        <div>
            {{ $courses->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- confirmation popup -->
    @include('components.confirmation-popup')
</div>

<style>
    .course-status-text-container{
        border-radius: 10px;
        display: flex;
        padding: 2px 10px;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        width: max-content;;
    }

    .course-status-text{
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .text-truncate-ellipsis {
        max-width: 100px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .pagination {
        margin-top: 0px !important; 
    }

    .text-custom {
        color: #D0C4AF !important;
    }

    .status-tab-container {
        width: 100%;
        border-bottom: 4px solid #F9EEDB;
    }

    .tab-header {
        position: relative; 
        display: flex;
    }

    .tab-link {
        flex: 1;
        background: none;
        border: none;
        padding: 12px 0;
        font-size: 18px;
        color: #D0C4AF;
        cursor: pointer;
    }

    .tab-link.active {
        background: var(--pink-gradient-color);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
    }

    .tab-underline {
        position: absolute;
        bottom: -4px;
        height: 4px;
        background: var(--pink-gradient-color);
        border-radius: 10px;
        transition: none; 
        visibility: hidden;
        left: 0;
    }

    .tab-underline.animate {
        visibility: visible;
        transition: transform 0.3s ease, width 0.3s ease;
    }

    /* Chevron sort data pengguna */
.custom-select-wrapper {
    position: relative;
}
.select-custom-dynamic {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: white !important;
    background-image: none !important;
    padding-right: 2rem !important;
}
.custom-select-wrapper::after {
    content: "";
    position: absolute;
    top: 50%;
    right: 1.25rem;
    transform: translateY(-50%) rotate(0deg);
    pointer-events: none;
    transition: transform 0.2s;
    width: 12px;
    height: 12px;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: center;
}
.custom-select-wrapper.open::after {
    transform: translateY(-50%) rotate(180deg);
}

</style>

<script>
    const tabs = document.querySelectorAll(".tab-link");
    const underline = document.querySelector(".tab-underline");

    function moveUnderline(el) {
        underline.style.width = el.offsetWidth + "px";
        underline.style.transform = `translateX(${el.offsetLeft}px)`;
    }

    const active = document.querySelector(".tab-link.active");
    if (active) moveUnderline(active);

    requestAnimationFrame(() => {
        underline.classList.add("animate");
    });

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            tabs.forEach(t => t.classList.remove("active"));
            tab.classList.add("active");
            moveUnderline(tab);

            const status = tab.dataset.status;
            const url = new URL(window.location);

            if (status === 'all') url.searchParams.delete('courseStatus');
            else url.searchParams.set('courseStatus', status);

            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    });

    new ResizeObserver(() => {
        const current = document.querySelector(".tab-link.active");
        if (current) moveUnderline(current);
    }).observe(document.querySelector(".tab-header"));


    // Fungsi ini sama seperti sebelumnya, hanya untuk menangani ONBLUR
    function toggleChevron(selectElement, isOpen) {
        var wrapper = selectElement.closest('.custom-select-wrapper');

        if (wrapper) {
            if (isOpen) {
                wrapper.classList.add('open');
            } else {
                setTimeout(function() {
                    if (document.activeElement !== selectElement) {
                        wrapper.classList.remove('open');
                    }
                }, 150);
            }
        }
    }

    function closeOnIconClick(wrapper) {
        var selectElement = wrapper.querySelector('select');
        if (wrapper.classList.contains('open')) {
            selectElement.blur();

        } else {
            selectElement.focus();
            toggleChevron(selectElement, true);
        }
    }
</script>

@endsection