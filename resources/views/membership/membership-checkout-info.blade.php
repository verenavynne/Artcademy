@extends('layouts.master')

@section('content')

@if (session('info'))
    <div class="alert alert-warning mt-3">{{ session('info') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">

    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-center gap-5">
        <!-- Sisi Kiri -->
        <div>
            <div class="d-flex flex-column mb-2">
                <p class="title text-start fw-bold mb-2">Info Pribadi</p>
                <p class="projek-title-desc">Yuk, lengkapi info pribadimu!</p>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" 
                            class="form-control rounded-pill @error('name') is-invalid @enderror" 
                            placeholder="Masukkan nama anda"
                            value="{{ $user->name }}">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" id="name" name="email" 
                            class="form-control rounded-pill @error('email') is-invalid @enderror" 
                            placeholder="Masukkan email anda"
                            value="{{ $user->email }}">
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">No. Telepon</label>
                    <input type="text" id="phone" name="phone" 
                            class="form-control rounded-pill @error('phone') is-invalid @enderror" 
                            placeholder="Masukkan nomor telepon anda"
                            value="{{ $user->phoneNumber }}">
                    @error('phone')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="divider">

            <p>Dengan checkout, Anda setuju dengan <span class="fw-bold" style="color: var(--orange-color)">Ketentuan Penggunaan</span> kami dan mengonfirmasi bahwa Anda telah membaca <span class="fw-bold" style="color: var(--orange-color)">Kebijakan Privasi</span> kami. Anda dapat membatalkan biaya perpanjangan layanan kapan saja.</p>
        </div>

        <!-- Sisi Kanan -->
        <div class="d-flex justify-content-center" style="width: 40%;">
            @include('components.membership-rincian-card', ['isCheckoutPage' => true])
        </div>
    </div>

    <!-- popup modal success payment -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content d-flex justify-content-center flex-column text-center p-4" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
            
            <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            
            <img src="{{ asset('assets/course/zoom_berhasil_daftar.png') }}" alt="Transaksi Berhasil" class="mb-3" width="80" style="align-self: center">
            
            <h5 class="fw-bold mb-2" style="font-size: var(--font-size-title)">Transaksi Berhasil!</h5>
            <p class="mb-4" style="margin: 0; font-size: var(--font-size-primary); color: var(--dark-gray-color)">
                Yey, transaksi berhasil, saatnya eksplor kursus dan mulai berkarya!
            </p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('course') }}" class="btn w-100 text-dark yellow-gradient-btn">
                    Lihat Kursus
                </a>
            </div>
            </div>
        </div>
    </div>
</div>

<style>
    .membership-card-detail{
        padding-inline: 40px;
        padding-block: 30px;
        border-radius: 40px;
        margin-block-end: 22px;
    }

    .membership-card-detail-header{
        display: flex;
        height: max-content;
        padding: 10px;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        width: max-content;
    }

    .membership-name-text{
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .sub-title{
        margin: 0;
        font-size: var(--font-size-primary);
        font-weight: 400;
        color:var(--dark-gray-color)
    }

    ul {
        list-style: none;
        padding-left: 0;
        margin-left: 0;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .testimoni-recap p{
        margin: 0;
        font-size: 22px;
        font-weight: 600;
        color: var(--black-color);
    }

    .review-btn-group{
        justify-content: space-between;
    }

    .review-btn-group a{
        text-decoration: none;
    }

    
</style>

@endsection