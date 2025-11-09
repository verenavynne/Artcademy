@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content-admin">

    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">Manajemen Zoom</h4>
        <a href="{{ route('admin.zoom.create') }}" class="btn text-dark d-flex align-items-center gap-2 yellow-gradient-btn px-4 py-3">
            Tambah Kelas Zoom <iconify-icon icon="ic:round-plus"></iconify-icon>
        </a>
    </div>

    <ul class="nav mb-4 mt-4 w-100 statusTabs">
        @php
            $statuses = ['Akan Datang', 'Draft', 'Selesai', 'Dihapus', 'Semua'];
            $currentStatus = request('zoomStatus') ?? 'Semua';
        @endphp
        @foreach($statuses as $status)
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ $currentStatus === $status ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.zoom.index', ['zoomStatus' => $status]) }}">
                {{ $status }}
            </a>
        </li>
        @endforeach
    </ul>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <form action="{{ route('admin.zoom.index') }}" method="GET" class="d-flex align-items-center">
            <select name="perPage" 
                    class="form-select form-select-sm rounded-pill shadow-sm border-0 me-2 p-3" 
                    onchange="this.form.submit()" 
                    style="width: 65px;">
                <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
            </select>
            <span>Data Pengguna</span>
        </form>

        <form action="{{ route('admin.zoom.index') }}" method="GET" class="d-flex align-items-center">
            <div class="d-flex align-items-center rounded-pill px-3 shadow-sm custom-input-2"
                style="width: 250px; background-color: #fff;">
                
                <input type="text" 
                    name="search"
                    value="{{ request('search') }}" 
                    placeholder="Cari..."
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
                    <th>Topik Zoom</th>
                    <th>Kursus</th>
                    <th>Jadwal Zoom</th>
                    <th class="text-center">Jumlah Pendaftar</th>
                    <th>Terakhir Diubah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($zooms as $zoom)
                <tr>
                    <td class="text-center">{{ $loop->iteration + ($zooms->currentPage() - 1) * $zooms->perPage() }}</td>
                    <td>{{ $zoom->created_at->format('d M Y H:i') }}</td>
                    <td class="text-truncate-ellipsis" title="{{ $zoom->zoomName }}">{{ $zoom->zoomName }}</td>
                    <td class="text-truncate-ellipsis" title="{{ $zoom->course->courseName ?? '-' }}">{{ $zoom->course->courseName ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($zoom->zoomDate.' '.$zoom->start_time)->format('d M Y H:i') }}</td>
                    <td class="text-center">{{ $zoom->zoomRegistereds->count() }}</td>
                    <td>{{ $zoom->updated_at->format('d M Y H:i') }}</td>
                    <td>
                        @php
                            $now = \Carbon\Carbon::now();
                            $zoomDateTime = \Carbon\Carbon::parse($zoom->zoomDate.' '.$zoom->start_time);

                            if($zoom->zoomStatus === 'draft'){
                                $displayStatus = 'Draft';
                                $bgColor = '#E7F6FE';
                                $textColor = 'var(--blue-gradient-color)';
                            } elseif($zoom->zoomStatus === 'dihapus'){
                                $displayStatus = 'Dihapus';
                                $bgColor = '#FFEAF0';
                                $textColor = 'var(--pink-gradient-color)';
                            } elseif($zoom->zoomStatus === 'publikasi'){
                                if($zoomDateTime->isPast()){
                                    $displayStatus = 'Selesai';
                                    $bgColor = '#EAFFEC';
                                    $textColor = 'var(--green-gradient-color)';
                                } else {
                                    $displayStatus = 'Akan Datang';
                                    $bgColor = '#FFF4E0';
                                    $textColor = 'var(--orange-gradient-color)';
                                }
                            } else {
                                $displayStatus = ucfirst($zoom->zoomStatus);
                                $bgColor = '#eee';
                                $textColor = '#333';
                            }
                        @endphp
                        <div class="course-status-text-container" style="background: {{ $bgColor }}">
                            <p class="course-status-text" style="background: {{ $textColor }}; margin:0; background-clip: text; font-weight:700; font-size:var(--font-size-small)">
                                {{ $displayStatus }}
                            </p>
                        </div>
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.zoom.show', $zoom->id) }}" class="btn btn-sm p-0 me-2 border-0 bg-transparent">
                            <iconify-icon icon="fa6-solid:eye" width="20" height="20"></iconify-icon>
                        </a>
                        <a href="{{ route('admin.zoom.edit', $zoom->id) }}" class="btn btn-sm text-warning p-0 me-2 border-0 bg-transparent">
                            <iconify-icon icon="lets-icons:edit" width="20" height="20"></iconify-icon>
                        </a>
                        <form action="{{ route('admin.zoom.destroy', $zoom->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm text-danger p-0 border-0 bg-transparent" 
                                    onclick="return confirm('Yakin ingin hapus Zoom ini?')">
                                <iconify-icon icon="fluent:delete-12-filled" width="20" height="20"></iconify-icon>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">Tidak ada data Zoom.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small ms-2">
            Menampilkan {{ $zooms->firstItem() }} sampai {{ $zooms->lastItem() }} dari {{ $zooms->total() }} data
        </div>

        <div>
            {{ $zooms->links('pagination::bootstrap-5') }}
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
        width: max-content;
    }

    .course-status-text{
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .text-truncate-ellipsis {
        max-width: 120px;
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
