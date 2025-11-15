@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content-admin">

    <!-- Header -->
    <div class="page-header align-items-center d-flex gap-3 mb-3">
        <div class="navigation-prev">
            <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </a>
        </div>

        <div class="d-flex flex-column">
            <h3 class="fw-bold">Pengguna {{ ucwords($user->name) }}</h3>
        </div>
    </div>

    <!-- Content Card -->
    <div class="form-container">
        <div class="d-flex align-items-start justify-content-between flex-wrap mb-4 mt-4">
            <!-- Left side -->
            <div class="d-flex flex-row align-items-center gap-3">
                <img src="{{ asset('assets/default-profile.jpg') }}" class="rounded-circle" width="100" height="100" alt="Foto Tutor">
                <div>
                    <p class="fw-bold mb-2 fs-5">
                        @if($user->role === 'student')
                            Siswa
                        @elseif($user->role === 'lecturer')
                            Tutor
                        @elseif($user->role === 'admin')
                            Admin
                        @endif
                    </p>
                    @if($user->role !== 'admin')
                        <span class="badge text-dark" style="background-color: #FFF4DE; border-radius: 100px; padding: 8px 20px;">
                            @if($user->role === 'student')
                                Member Creative Studio
                            @elseif($user->role === 'lecturer')
                                {{ $user->lecturer?->specialization ?? '-' }}
                            @endif
                        </span>
                    @endif
                </div>
            </div>

            <!-- toggle aktif -->
            <div class="d-flex align-items-center gap-1">
                <div class="form-check form-switch">
                    <input class="form-check-input" 
                        type="checkbox" 
                        role="switch" 
                        id="status" 
                        {{ $user->userStatus === 'active' ? 'checked' : '' }}>
                </div>
                <label class="fw-semibold">Aktif</label>
                <iconify-icon icon="material-symbols:info-outline-rounded" 
                    title="Jika di nonaktifkan, maka pengguna tidak dapat masuk ke akunnya." 
                    style="font-size: 20px;"></iconify-icon>
            </div>
        </div>

        <!-- Info Form -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="fw-semibold mb-1">Nama</label>
                <input type="text" class="form-control rounded-pill custom-input" value="{{ $user->name }}" readonly>
            </div>

            <div class="col-md-6 ">
                <label class="fw-semibold mb-1">E-mail</label>
                <input type="email" class="form-control rounded-pill custom-input" value="{{ $user->email }}" readonly>
            </div>
        </div>

        <div class="row mb-4">
            <div class="{{ $user->role === 'admin' ? 'col-md-12' : 'col-md-6' }}">
                <label class="fw-semibold mb-1">Nomor Telepon</label>
                <input type="text" class="form-control rounded-pill custom-input" value="{{ $user->phoneNumber }}" readonly>
            </div>

            @if($user->role !== 'admin')
                <div class="col-md-6">
                    @if($user->role === 'student')
                        <label class="fw-semibold mb-1">Tanggal Lahir</label>
                        <input type="date" class="form-control rounded-pill custom-input" value="{{ $user->dateOfBirth ?? '-' }}" readonly>
                    @elseif($user->role === 'lecturer')
                        <label class="fw-semibold mb-1">Keahlian</label>
                        <input type="text" class="form-control rounded-pill custom-input" value="{{ $user->lecturer?->specialization ?? '-' }}" readonly>
                    @endif
                </div>
            @endif
        </div>

        @if($user->role !== 'admin')
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Jenis Kelamin</label>
                    <input type="text" class="form-control rounded-pill custom-input" value="{{ $user->gender ?? '-' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Profesi</label>
                    <input type="text" class="form-control rounded-pill custom-input" value="{{ $user->profession ?? '-' }}" readonly>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
document.getElementById('status').addEventListener('change', function () {
    fetch("{{ route('admin.user.toggle-status', $user->id) }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({})
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            console.log("Status berubah menjadi:", data.newStatus);
        }
    })
    .catch(err => console.error(err));
});
</script>
@endsection
