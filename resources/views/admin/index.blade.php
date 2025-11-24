@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content-admin">

    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">Manajemen Kursus</h4>
        <a href="{{ route('admin.courses.create') }}" class="btn text-dark d-flex align-items-center gap-2 yellow-gradient-btn px-4 py-3">
            Tambah Kursus <iconify-icon icon="ic:round-plus"></iconify-icon>
        </a>
    </div>

    <ul class="nav mb-4 mt-4 w-100 statusTabs">
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ request('courseStatus') == 'draft' ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.courses.index', ['courseStatus' => 'draft']) }}">
            Draft
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ request('courseStatus') == 'publikasi' ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.courses.index', ['courseStatus' => 'publikasi']) }}">
            Dipublikasikan
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ request('courseStatus') == 'arsip' ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.courses.index', ['courseStatus' => 'arsip']) }}">
            Diarsipkan
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ !request('courseStatus') ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.courses.index') }}">
            Semua
            </a>
        </li>
    </ul>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <!-- Dropdown Pagination -->
        <form action="{{ route('admin.courses.index') }}" method="GET" class="d-flex align-items-center">
            <select name="perPage" 
                    class="form-select form-select-sm rounded-pill shadow-sm border-0 me-2 p-3" 
                    onchange="this.form.submit()" 
                    style="width: 65px;">
                <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
            </select>
            <span>Data Kursus</span>
        </form>

        <!-- Search -->
        <form action="{{ route('admin.courses.index') }}" method="GET" class="d-flex align-items-center">
            <div class="d-flex align-items-center rounded-pill px-3 shadow-sm custom-input-2"
                style="width: 250px; background-color: #fff;">
                
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


    <div class="table-responsive shadow-sm rounded">
        <table class="table align-middle table-hover">
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
                                <form action="{{ route('admin.courses.archive', $course->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm p-0 border-0 bg-transparent" 
                                            onclick="return confirm('Yakin ingin arsipkan kursus ini?')">
                                        <iconify-icon icon="material-symbols:archive-rounded" width="20" height="20" style="color: var(--pink-medium-color)"></iconify-icon>
                                    </button>
                                </form>
                            @endif
                            @if($course->courseStatus !== 'publikasi')
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm text-danger p-0 border-0 bg-transparent" 
                                            onclick="return confirm('Yakin ingin hapus kursus ini?')">
                                        <iconify-icon icon="fluent:delete-12-filled" width="20" height="20"></iconify-icon>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">Tidak ada data kursus.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small ms-2">
            Menampilkan {{ $courses->firstItem() }} sampai {{ $courses->lastItem() }} dari {{ $courses->total() }} data
        </div>

        <div>
            {{ $courses->links('pagination::bootstrap-5') }}
        </div>
    </div>
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

    .statusTabs {
        border-bottom: 4px solid #F9EEDB;
        position: relative;
    }

    .statusTabs .nav-link:hover,
    .statusTabs .nav-link.active {
        background: var(--pink-gradient-color);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .statusTabs .nav-link:hover::after,
    .statusTabs .nav-link.active::after {
        position: absolute;
        bottom: -4px;
        border-radius: 10px;
        height: 4px;
    }

    .pagination {
        margin-top: 0px !important; 
    }

    .text-custom {
        color: #D0C4AF !important;
    }
</style>
@endsection