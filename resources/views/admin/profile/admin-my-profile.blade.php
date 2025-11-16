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
            <h3 class="fw-bold">Profil Saya</h3>
        </div>
    </div>

    <!-- Content Card -->
    <div class="form-container">
        <div class="d-flex align-items-start justify-content-between flex-wrap mb-4 mt-4">
            <div class="d-flex flex-row align-items-center gap-3">
                <div style="position: relative; width: 100px; height: 100px;">
                    <img src="{{ Str::startsWith($user->profilePicture, ['http://', 'https://']) 
                        ? $user->profilePicture 
                        : ($user->profilePicture 
                            ? asset('storage/' . $user->profilePicture) 
                            : asset('assets/default-profile.jpg')) }}"
                        class="profile-picture rounded-circle object-fit"
                        width="100" height="100">

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
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="fw-semibold mb-1">Nama</label>
                <input type="text" class="form-control rounded-pill custom-input" value="{{ $user->name }}">
            </div>

            <div class="col-md-6 ">
                <label class="fw-semibold mb-1">E-mail</label>
                <input type="email" class="form-control rounded-pill custom-input" value="{{ $user->email }}">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <label class="fw-semibold mb-1">Nomor Telepon</label>
                <input type="text" class="form-control rounded-pill custom-input" value="{{ $user->phoneNumber }}">
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.getElementById('profilePicture').click();
    });
</script>

<style>
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
