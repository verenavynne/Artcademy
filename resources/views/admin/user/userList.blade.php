@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content">

    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">Daftar Pengguna</h4>
        <button class="btn text-dark d-flex align-items-center gap-2 yellow-gradient-btn px-4 py-3" id="openPopupBtn">
            Tambah Pengguna
            <iconify-icon icon="ic:round-plus"></iconify-icon>
        </button>
    </div>

    <ul class="nav mb-4 mt-4 w-100 statusTabs">
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ request('userStatus') == 'active' ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.user.list', ['userStatus' => 'active']) }}">
            Aktif
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ request('userStatus') == 'inactive' ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.user.list', ['userStatus' => 'inactive']) }}">
            Nonaktif
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link fs-5 {{ !request('userStatus') ? 'active' : 'text-custom' }}" 
            href="{{ route('admin.user.list') }}">
            Semua
            </a>
        </li>
    </ul>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <!-- Dropdown Pagination -->
        <form action="{{ route('admin.user.list') }}" method="GET" class="d-flex align-items-center">
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

        <!-- Search -->
        <form action="{{ route('admin.user.list') }}" method="GET" class="d-flex align-items-center">
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


    <div class="table-section">
        <div class="table-data">
            <table class="table table-borderless">
                <thead class="sticky-top">
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Waktu Terdaftar</th>
                        <th>ID Pengguna</th>
                        <th>Nama Pengguna</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($users as $index => $user)
                    
                        <tr>
                            <td class="text-center">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                            <td class="text-truncate-ellipsis" title="{{ $user->id }}">{{ $user->id }}</td>
                            <td class="text-truncate-ellipsis" title="{{ $user->name }}">{{ $user->name }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>
                                @php
                                if($user->userStatus === 'active'){
                                    $displayStatus = 'Aktif';
                                    $bgColor = '#EAFFEC';
                                    $textColor = 'var(--green-gradient-color)';
                                } elseif($user->userStatus === 'inactive'){
                                    $displayStatus = 'Non Aktif';
                                    $bgColor = '#EDEDED';
                                    $textColor = 'var(--grey-gradient-color)';
                                }
                            @endphp        
                                <div class="course-status-text-container" style="background: {{ $bgColor }}">
                                    <p class="course-status-text px-2 py-1" style="background: {{ $textColor }}; margin:0; background-clip: text; font-weight:700; font-size:var(--font-size-small)">{{ $displayStatus }}</p>
                                </div>
                            </td>
                            <td class="text-nowrap">
                                <a href="{{ route('admin.user.detail', ['userId' => $user->id]) }}" class="btn">
                                    <iconify-icon icon="fa6-solid:eye" width="20" height="20"></iconify-icon>
                                </a>
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
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small ms-2">
            Menampilkan {{ $users->firstItem() }} sampai {{ $users->lastItem() }} dari {{ $users->total() }} data
        </div>

        <div>
            {{ $users->links('pagination::bootstrap-5') }}
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

<script>
  const popupOverlay = document.getElementById("popupOverlay");
  const openPopupBtn = document.getElementById("openPopupBtn");
  const closePopupBtn = document.getElementById("closePopupBtn");
  const formTambahUser = document.getElementById("formTambahUser");

  openPopupBtn.addEventListener("click", () => {
    popupOverlay.style.display = "flex";
  });

  closePopupBtn.addEventListener("click", () => {
    formTambahUser.reset();
    popupOverlay.style.display = "none";
  });

  window.addEventListener("click", (e) => {
    if (e.target === popupOverlay) {
        formTambahUser.reset();
        popupOverlay.style.display = "none"
    };
  });

  @if ($errors->any())
        document.addEventListener("DOMContentLoaded", function () {
            const popupOverlay = document.getElementById("popupOverlay");
            popupOverlay.style.display = "flex";
        });
    @endif
</script>

@endsection

@include('admin.user.create-user-popup')