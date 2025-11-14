@extends('layouts.master')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-4" style="margin-bottom: 75px;">
    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-between" style="width: 100%; ">
        <div style="width: 20%">
            @include('profile.components.sidebar-profile')
        </div>

        <div class="d-flex flex-column" style="width: 75%; ">
            <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="info-profile-card d-flex flex-column">
                <p class="title text-start fw-bold">Info Pribadi</p>
                <hr class="divider">
                <div class="row">
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
                <div class="row">
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
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="phoneNumber" class="form-label">Nomor Telepon</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" 
                                class="form-control rounded-pill @error('phoneNumber') is-invalid @enderror" 
                                placeholder="Masukkan nomor telepon anda"
                                value="{{ $user->phoneNumber }}">
                        @error('phoneNumber')
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
                <div class="col d-flex justify-content-end mt-2 gap-2">
                    <button class="btn py-2 px-4 pink-cream-btn">
                        <p class="text-pink-gradient" style="margin: 0">Ubah kata sandi</p>
                    </button>
                    <button class="btn py-2 px-4 text-dark yellow-gradient-btn">Simpan perubahan</button>

                </div>
            </div>
            </form>
        </div>
    </div>
</div>

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
</style>

@endsection