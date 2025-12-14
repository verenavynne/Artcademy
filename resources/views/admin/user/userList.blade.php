@extends('layouts.master-admin')

@section('content')

<div class="container ps-4 container-content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">Daftar Pengguna</h4>
        <button class="btn text-dark d-flex align-items-center gap-2 yellow-gradient-btn px-4 py-3" id="openPopupBtn">
            Tambah Pengguna
            <iconify-icon icon="ic:round-plus"></iconify-icon>
        </button>
    </div>

    <div class="status-tab-container mb-4 mt-4">
        <div class="tab-header">
            <button class="tab-link {{ $activeTab === 'active' ? 'active' : '' }}" data-status="active">
                Aktif
            </button>
            <button class="tab-link {{ $activeTab === 'inactive' ? 'active' : '' }}" data-status="inactive">
                Nonaktif
            </button>
            <button class="tab-link {{ $activeTab === 'all' ? 'active' : '' }}" data-status="all">
                Semua
            </button>
            <div class="tab-underline"></div>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between mb-2">
        <form action="{{ route('admin.user.list') }}" method="GET" class="d-flex align-items-center">
            <div class="custom-select-wrapper me-3" style="width: 80px; height: 48px;" onclick="closeOnIconClick(this)">
                <select name="perPage"
                    class="form-select form-select-sm rounded-pill shadow-sm border-0 select-custom-dynamic" style="min-height: 0; font-size: 18px; padding-left: 24px; padding-right: 24px;"
                    onchange="this.form.submit()"
                    onblur="toggleChevron(this, false)"
                    style="height: 48px; font-size: 18px;">
                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </div>
            <span style="font-size: 18px;">Data Pengguna</span>
        </form>

        <!-- Search -->
        <form action="{{ route('admin.user.list') }}" method="GET" class="d-flex align-items-center">
            <div class="d-flex align-items-center rounded-pill shadow-sm custom-input-2"
                style="width: 215px; height: 48px; background-color: #fff; justify-content: space-between;">
                
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
                        @php
                            $userRole = null;
                            
                            if($user->role === 'lecturer'){
                                $userRole = 'Tutor';
                            }else{
                                $userRole =  ucfirst($user->role);
                            }
                        @endphp
                    
                        <tr>
                            <td class="text-center">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                            <td class="text-truncate-ellipsis" title="{{ $user->id }}">{{ $user->id }}</td>
                            <td class="text-truncate-ellipsis" title="{{ $user->name }}">{{ $user->name }}</td>
                            <td>{{ $userRole}}</td>
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
                            <td colspan="9" class="text-center text-muted py-4" style="display: table-cell;">Tidak ada data pengguna.</td>
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

    .text-custom {
        color: #D0C4AF !important;
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

@include('admin.user.create-user-popup')