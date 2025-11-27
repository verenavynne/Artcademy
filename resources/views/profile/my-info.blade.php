@extends($layout)

@section('content')
<div class="container-fluid d-flex flex-column justify-content-center px-4" style="margin-bottom: 75px; width: calc(100% - 300px);">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="page-header align-items-center d-flex gap-3 mb-3">
        <div class="navigation-prev">
            <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </a>
        </div>

        @if ($user->role !== 'student')
            <div class="d-flex flex-column">
                <h3 class="fw-bold">{{ $user->role == 'admin' ? 'Profil Saya' : 'Info Pribadi' }}</h3>
            </div>
        @endif
    </div>

    <div class="d-flex flex-row justify-content-between" style="width: 100%;">
        @if ($user->role === 'student')
            <!-- <div style="width: 20%"> -->
                @include('profile.components.sidebar-profile')
            <!-- </div> -->
        @endif

        <div class="d-flex flex-column" style="width: {{ $user->role == 'student' ? '75%' : '100%' }}">
            <div class="info-profile-card d-flex flex-column" style="{{ $user->role !== 'student' ? 'max-height: 68vh; overflow-y: auto;' : '' }}">
                @if ($user->role === 'student')
                    <p class="title text-start fw-bold">Info Pribadi</p>
                    <hr class="divider">
                @else
                    <div class="d-flex flex-row align-items-center gap-3">
                        <div style="position: relative; width: 100px; height: 100px;">
                            <img src="{{ Str::startsWith($user->profilePicture, ['http://', 'https://']) 
                                ? $user->profilePicture 
                                : ($user->profilePicture 
                                    ? asset('storage/' . $user->profilePicture) 
                                    : asset('assets/default-profile.jpg')) }}"
                                class="profile-picture rounded-circle object-fit"
                                width="100" height="100" style="object-fit: cover">

                            <form action="{{ route('profile.updatePicture') }}" 
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <button type="button" class="edit-profile-btn" id="editProfileBtn">
                                    <img src="{{ asset('assets/icons/icon_edit.svg') }}" width="16" height="16">
                                </button>
                                <input type="file" name="profilePicture" id="profilePicture" class="d-none" onchange="this.form.submit()">
                            </form>
                        </div>

                        <div>   
                            <p class="fw-bold mb-2 fs-5">
                                {{ ucfirst($user->role) }}
                            </p>
                        </div>
                    </div>
                @endif
                
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" 
                                    class="form-control rounded-pill @error('name') is-invalid @enderror" 
                                    placeholder="Masukkan nama anda"
                                    value="{{ $user->name }}">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" 
                                    class="form-control rounded-pill @error('email') is-invalid @enderror" 
                                    placeholder="Masukkan email anda"
                                    value="{{ $user->email }}">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="{{ $user->role == 'admin' ? 'col-md-12' : 'col-md-6' }}">
                            <label for="phoneNumber" class="form-label">Nomor Telepon</label>
                            <input type="text" id="phoneNumber" name="phoneNumber" 
                                    class="form-control rounded-pill @error('phoneNumber') is-invalid @enderror" 
                                    placeholder="Masukkan nomor telepon anda"
                                    value="{{ $user->phoneNumber }}">
                            @error('phoneNumber')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($user->role !== 'admin')
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select id="gender" 
                                        name="gender" 
                                        class="form-select rounded-pill @error('gender') is-invalid @enderror">
                                    <option value="" disabled {{ $user->gender == null ? 'selected' : '' }}>
                                        Pilih jenis kelamin
                                    </option>
                                    <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    @if ($user->role !== 'admin')
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="dob" class="form-label">Tanggal lahir</label>
                            <input type="date" 
                                    id="dob" 
                                    name="dob" 
                                    class="form-control rounded-pill @error('dob') is-invalid @enderror" 
                                    value="{{ old('dob', $user->dateOfBirth) }}">
                            @error('dob')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="profession" class="form-label">Profesi</label>
                            <input type="text" id="profession" name="profession" 
                                    class="form-control rounded-pill @error('profession') is-invalid @enderror" 
                                    placeholder="Masukkan profesi anda"
                                    value="{{ $user->profession }}">
                            @error('profession')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="col d-flex justify-content-end mt-2 gap-2">
                        <button type="button" class="btn py-2 px-4 pink-cream-btn" id="openPasswordPopupBtn">
                            <p class="text-pink-gradient" style="margin: 0">Ubah kata sandi</p>
                        </button>
                        <button class="btn py-2 px-4 text-dark yellow-gradient-btn">Simpan perubahan</button>

                    </div>
                </form>
            </div> 
        </div>
    </div>

    @include('profile.components.popup-change-password')
</div>

<script>
    // edit profile picture
    document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.getElementById('profilePicture').click();
    });

    // Open & Close Popup
    const passwordPopupOverlay = document.getElementById('passwordPopupOverlay');
    const closePasswordPopupBtn = document.getElementById('closePasswordPopupBtn');

    function openPasswordPopup() {
        passwordPopupOverlay.style.display = 'flex';
    }

    // buka popup saat tombol diklik
    document.getElementById('openPasswordPopupBtn').addEventListener('click', function() {
        openPasswordPopup();
    });

    // tutup popup
    closePasswordPopupBtn.addEventListener('click', () => {
        passwordPopupOverlay.style.display = 'none';
    });

    passwordPopupOverlay.addEventListener('click', (e) => {
        if(e.target === passwordPopupOverlay) {
            passwordPopupOverlay.style.display = 'none';
        }
    });
</script>

<style>
    .title{
        margin-block-end: 0;
    }

    .divider{
        margin-block: 16px;
    }
    .info-profile-card{
        background: white;
        border-radius: 40px;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        gap: 16px;
        padding-block: 40px;
        padding-inline: 38px;
    }

    .edit-profile-btn {
        position: absolute;
        bottom: 5px;
        right: 0px;
        width: 40px;
        height: 40px;
        border: none;
        cursor: pointer;
        background: linear-gradient(180deg, #FFDE22 0%, #F4A700 100%);
        border-radius: 50rem;
        box-shadow: 0px 4px 8px 0px var(--brown-shadow-color);
        transition: all 0.3s ease;
        
    }

    .edit-profile-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(0,0,0,0.25);
    }
</style>

@endsection