@extends('layouts.master-admin')

@section('content')
<div class="container ps-4 container-content-admin">

    <!-- Header -->
    <div class="page-header align-items-center d-flex gap-3 mb-3">
        <a class="page-link" href="{{ route('admin.user.list') }}" onclick="window.history.back()">
            <div class="">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </div>
        </a>

        <div class="d-flex flex-column">
            <h3 class="fw-bold">Pengguna {{ ucwords($user->name) }}</h3>
        </div>
    </div>

    <!-- Content Card -->
    <div class="form-container">
        <div class="d-flex align-items-start justify-content-between flex-wrap mb-4 mt-4">
            <!-- Left side -->
            <div class="d-flex flex-row align-items-center gap-3">
                <img src="{{ Str::startsWith($user->profilePicture, ['http://', 'https://']) 
                        ? $user->profilePicture 
                        : ($user->profilePicture 
                            ? asset('storage/' . $user->profilePicture) 
                            : asset('assets/default-profile.jpg')) }}"
                    class="profile-picture rounded-circle"
                    width="100" height="100" style="object-fit: cover">

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
                        @php
                            $membershipName = $membershipTransaction->membership->membershipName ?? null;
                            $specialization = $user->lecturer->specialization ?? null;

                            if( ($membershipStatus === 'active' && $membershipName === 'Basic Canvas') || 
                                ($user->role === 'lecturer' && $specialization === 'Seni Lukis & Digital Art')) {
                                $bgColor = '#FFF4E0';
                                $textColor = 'var(--orange-gradient-color)';
                            } elseif( ($membershipStatus === 'active' && $membershipName === 'Masterpiece Pro') || 
                                ($user->role === 'lecturer' && $specialization === 'Seni Tari')) {
                                $bgColor = '#FFEAF0';
                                $textColor = 'var(--pink-gradient-color)';
                            } elseif($user->role === 'lecturer' && $specialization === 'Seni Musik') {
                                $bgColor = '#fffdeaff';
                                $textColor = 'var(--yellow-gradient-color)';
                            } elseif( ($membershipStatus === 'active'&& $membershipName === 'Creative Studio') || 
                                ($user->role === 'lecturer' && $specialization === 'Seni Fotografi')) {
                                $bgColor = '#E7F6FE';
                                $textColor = 'var(--blue-gradient-color)';
                            } else {
                                $bgColor = '#D9D9D9';
                                $textColor = '#6c757d';
                            }
                        @endphp

                        <div class="status-text-container" style="background: {{ $bgColor }}">
                            <p class="status-text" style="background: {{ $textColor }}; margin:0; background-clip: text; font-weight:700; font-size:var(--font-size-small)">
                                @if($user->role === 'student')
                                    {{ ($membershipName && $membershipStatus === 'active')
                                        ? 'Member '. $membershipName
                                        : 'Belum Berlangganan' }}
                                @elseif($user->role === 'lecturer')
                                    {{ $specialization }}
                                @endif
                            </p>
                        </div>
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

<style>
    .status-text-container{
        border-radius: 10px;
        display: flex;
        padding: 2px 10px;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        width: max-content;
    }

    .status-text{
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection
