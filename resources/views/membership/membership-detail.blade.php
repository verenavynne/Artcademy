@extends('layouts.master')

@section('content')

@if (session('info'))
    <div class="alert alert-warning mt-3">{{ session('info') }}</div>
@endif

@php

    $backgroundGradient = match($membership->membershipName) {
        'Basic Canvas' => 'var(--orange-gradient-color)',    
        'Creative Studio' => 'var(--blue-gradient-color)',
        'Masterpiece Pro' => 'var(--pink-gradient-color)',
    };

    $backgroundMembershipLevel= match($membership->membershipName){
        'Basic Canvas' => '#DC970A',    
        'Creative Studio' => '#3E85CB',         
        'Masterpiece Pro' => '#E0567D', 
    };

    $headerText = match($membership->membershipName){
        'Basic Canvas' => ['dasar', 'baru mulai menjelajahi dunia seni!'],    
        'Creative Studio' => ['dasar dan menengah', 'mau eksplor dunia kreatif!'],         
        'Masterpiece Pro' => ['dasar, menengah, dan lanjutan', 'ingin mengembangkan skill ke level profesional!'], 
    };

    $levelText = match($membership->membershipName){
        'Basic Canvas' => 'Dasar',    
        'Creative Studio' => 'Dasar, Menengah',         
        'Masterpiece Pro' => 'Dasar, Menengah, Lanjutan', 
    };

    $checkBenefit = match($membership->membershipName){
        'Basic Canvas' => 'var(--orange-color)',    
        'Creative Studio' => 'var(--blue-color)',         
        'Masterpiece Pro' => 'var(--pink-color)', 
    };

    $testimonis = [
        ['name' => 'Vynne', 'rating' => 5, 'time' => '2 days ago', 'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis'],
        ['name' => 'Vynne', 'rating' => 5, 'time' => '2 days ago', 'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis'],
        ['name' => 'Vynne', 'rating' => 5, 'time' => '2 days ago', 'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis'],
        ['name' => 'Vynne', 'rating' => 5, 'time' => '2 days ago', 'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio aperiam magni illo corrupti autem. Laudantium iste fugit reiciendis'],
    ];
@endphp

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">

    <div class="navigation-prev d-flex flex-start">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-center gap-5">
        <!-- Sisi Kiri -->
        <div class="d-flex flex-column" style="width: 60%;">
            <div class="membership-card-detail card d-flex flex-row">
                <div class="round-background"></div>

                <div class="col-7 membership-card-detail-content d-flex flex-column justify-content-center">
                    <p class="membership-name-text">{{ $membership->membershipName }}</p>
                    <div class="d-flex flex-row gap-5">
                        <div class="d-flex flex-column" style="gap:12px">
                            <p style="margin:0; font-size: var(--font-size-small); color: var(--dark-gray-color)">Akses semua kursus level {{ $headerText[0] }} untuk mulai bangun skill seni dari nol. Cocok untuk kamu yang {{ $headerText[1] }}</p>
                            <div class="d-flex gap-2">
                                <p class="fw-bold fs-2">Rp {{ number_format($membership->membershipPrice, 0, ',', '.') }}</p>
                                <span class="fs-5 fw-light mt-2" style="color: var(--dark-gray-color);">/ bulan</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5 d-flex flex-column ps-5" style="gap: 22px">
                    <div class="d-flex justify-content-end">
                        <div class="membership-card-detail-header d-flex" style="background:{{ $backgroundMembershipLevel }}; position: relative;">
                            <p style="margin: 0; color: white; font-size: var(--font-size-small)">Akses Level {{ $levelText }}</p>
                        </div>

                    </div>
                    <div class="d-flex justify-content-center" style="position: relative;">
                        <img src="{{ asset('assets/membership/membership-header-icon.svg') }}" alt="membership Picture" width="187" height="165">
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column mb-2" style="gap: 22px;">
                <div class="d-flex flex-row justify-content-between">
                    <p style="margin:0; font-size: var(--font-size-big); font-weight: 700">Paket Membership {{ $membership->membershipName }}</p>
                    <p class="fw-bold fs-5">Rp {{ number_format($membership->membershipPrice, 0, ',', '.') }} <span class="fw-normal">/ bulan</span></p>
                </div>
            </div>  

            <div id="deskripsi-section" class="description-section d-flex flex-column">
                <p class="text-start sub-title">{{ $membership->membershipDesc }}</p>
            </div>

            <hr class="divider">

            <!-- Benefit Section -->
            <div id="benefit-section" class="benefit-section d-flex flex-column">
                <p class="title text-start fw-bold">Benefit</p>

                <ul>
                    @foreach ($membership->membershipBenefits as $benefit)
                    <li class="d-flex align-items-center mb-4 gap-2"><iconify-icon icon="mingcute:check-fill" style="color: {{ $checkBenefit }}"></iconify-icon> <p class="text-start sub-title">{{ $benefit }}</p></li>
                    @endforeach
                </ul>
            </div>

            <hr class="divider">

            <!-- TNC Section -->
            <div class="tnc-section d-flex flex-column">
                <p class="title text-start fw-bold">Syarat dan Ketentuan</p>
                <ul>
                    <li class="d-flex mb-2 gap-2"><iconify-icon class="mt-1" icon="material-symbols:privacy-tip-outline-rounded"></iconify-icon> <p class="text-start sub-title">Video pembelajaran bisa kamu nikmati selama <span class="fw-bold">1 bulan</span> setelah pembayaran kamu berhasil dan terverifikasi oleh sistem Artcademy.</p></li>
                    <li class="d-flex gap-2"><iconify-icon class="mt-1" icon="material-symbols:privacy-tip-outline-rounded"></iconify-icon> <p class="text-start sub-title">Setiap pembelian kursus berlaku untuk <span class="fw-bold">1 pengguna</span>. Sertifikat akan diberikan sesuai dengan nama dan email yang terdaftar di akun Artcademy kamu.</p></li>

                </ul>

            </div>

            <hr class="divider">

            <!-- Testimoni Section -->
            <div id="testimoni-section" class="testimoni-section d-flex flex-column">
                <p class="title text-start fw-bold">Testimoni</p>
                <div class="testimoni-wrapper d-flex flex-column" style="gap: 28px">
                    <div class="testimoni-recap d-flex flex-row gap-2">
                        <img src="{{ asset('assets/icons/icon_star.svg') }}" alt="Star" height="22" width="22">
                        <p style="margin: 0">4.6 / 5.0</p>
                    </div>

                    <div class="testimoni-card-container flex-wrap gap-4">
                        @foreach ($testimonis as $testimoni)
                            @include('components.testimoni-card',['testimoni'=>$testimoni])
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        <!-- Sisi Kanan -->
        <div class="d-flex justify-content-center" style="width: 40%;">
            @include('components.membership-rincian-card', ['isCheckoutPage' => false])
        </div>
    </div>
</div>

<style>
    .membership-card-detail{
        padding-inline: 40px;
        padding-block: 30px;
        border-radius: 40px;
        margin-block-end: 22px;
        position: relative; 
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
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

    .membership-card-detail-content{
        gap: 12px;
        padding-inline-end: 26px;
        z-index: 2;
    }

    .round-background {
        position: absolute;
        right: -50px;
        top: 50%;
        transform: translateY(-50%);
        width: 410px;
        height: 410px;
        background: {{ $backgroundGradient }};
        border-radius: 50%;
        z-index: 0;
    }

    .membership-name-text{
        background: {{ $backgroundGradient }};
        margin: 0;
        font-weight: 700;
        font-size: var(--font-size-big);
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