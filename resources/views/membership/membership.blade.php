@extends('layouts.master')

@section('content')

@if (session('info'))
    <div class="alert alert-warning mt-3">{{ session('info') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <div class="d-flex flex-row align-items-center gap-4">
        <div class="navigation-prev d-flex flex-start pb-4">
            <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </a>
        </div>
        <div class="d-flex flex-column pb-4">
            <p class="title text-start fw-bold">Langganan Sekali, Belajar Berkali-Kali!</p>
            <p class="projek-title-desc">Dapatkan akses ke ratusan materi seni dari dasar sampai tingkat lanjutan. Semua ada di sini, tinggal kamu yang mulai!</p>
        </div>

    </div>

    <div class="pricing-container">
    <!-- BASIC -->
        <div class="pricing-card">
            <div class="card-top">
                <h3 class="title">Basic Canvas</h3>
                <p class="subtitle">Langkah awal untuk mulai berkarya</p>

                <div class="price-section">
                    <span class="old-price">Rp 100.000</span>
                    <span class="discount">Diskon 50%</span>
                    <h2 class="price">Rp 49.000 <span>/ Bulan</span></h2>
                </div>
            </div>
            
            <div class="card-bottom">
                <ul class="features">
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--orange-color)"></iconify-icon> Akses semua kursus Level Dasar</li>
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--orange-color)"></iconify-icon> Sertifikat digital resmi Artcademy</li>
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--orange-color)"></iconify-icon> Upload hingga 5 portofolio</li>
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--orange-color)"></iconify-icon> Akses komunitas</li>
                </ul>

                <button class="btn pink-cream-btn">Pilih Langganan</button>
            </div>
        </div>

        <!-- CREATIVE STUDIO -->
        <div class="pricing-card highlight">
            <div class="badge">Terpopuler</div>
            <div class="card-top">
                <h3 class="title">Creative Studio</h3>
                <p class="subtitle">Naikin level, biar skill makin kece</p>

                <div class="price-section">
                    <span class="old-price">Rp 150.000</span>
                    <span class="discount">Diskon 50%</span>
                    <h2 class="price">Rp 99.000 <span>/ Bulan</span></h2>
                </div>
            </div>

            <div class="card-bottom">
                <ul class="features">
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--blue-color)"></iconify-icon> Akses kursus Level Dasar & Menengah</li>
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--blue-color)"></iconify-icon> Sertifikasi digital resmi Artcademy</li>
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--blue-color)"></iconify-icon> Upload hingga 10 portofolio</li>
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--blue-color)"></iconify-icon> Akses komunitas + fitur chatbot apollo</li>
                </ul>

                <button class="btn yellow-gradient-btn">Pilih Langganan</button>
            </div>
        </div>

        <!-- MASTERPIECE -->
        <div class="pricing-card">
            <div class="card-top">
                <h3 class="title">Masterpiece Pro</h3>
                <p class="subtitle">All out jadi seniman, tanpa batas</p>

                <div class="price-section">
                    <span class="old-price">Rp 200.000</span>
                    <span class="discount">Diskon 50%</span>
                    <h2 class="price">Rp 149.000 <span>/ Bulan</span></h2>
                </div>
            </div>

            <div class="card-bottom">
                <ul class="features">
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--pink-color);"></iconify-icon> Akses kursus Level Dasar, Menengah, Lanjutan</li>
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--pink-color);"></iconify-icon> Sertifikasi digital resmi Artcademy</li>
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--pink-color);"></iconify-icon> Upload portofolio tanpa batas</li>
                    <li><iconify-icon icon="mingcute:check-fill" style="color: var(--pink-color);"></iconify-icon> Akses komunitas + fitur chatbot apollo</li>
                </ul>

                <button class="btn pink-cream-btn">Pilih Langganan</button>
            </div>
        </div>

    </div>
</div>

<style>
    .pricing-container {
        display: flex;
        justify-content: center;
        gap: 48px;
        padding: 40px 20px;
        flex-wrap: wrap;
    }

    .pricing-card {
        position: relative;
        width: 300px;
        border-radius: 53px;
        background: var(--cream2-color);
        box-shadow: 0 4px 8px rgba(67, 39, 0, 0.2);
    }

    .card-top {
        background: #FFFFFF;
        padding: 20px 35px;
        border-radius: 53px;
        text-align: center;
        box-shadow: 0 4px 9px rgba(67, 39, 0, 0.2);

    }

    .card-bottom {
        background: var(--cream2-color);
        padding: 0px 35px;
        border-radius: 53px;
    }

    .highlight {
        border: 2px solid var(--pink-color);
    }

    .badge {
        position: absolute;
        top: -18px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--pink-color);
        padding: 8px 22px;
        border-radius: 40px;
        color: white;
        font-weight: 600;
        font-size: 14px;
    }

    .title {
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 22px;
    }

    .subtitle {
        color: var(--dark-gray-color);
        font-size: 14px;
        margin-bottom: 20px;
    }

    .old-price {
        text-decoration: line-through;
        color: var(--dark-gray-color);
        margin-right: 8px;
    }

    .discount {
        background: #F93838;
        color: white;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 12px;
    }

    .price {
        margin-top: 10px;
        font-size: 32px;
        font-weight: 800;
    }

    .price span {
        font-size: 14px;
        font-weight: 400;
    }

    .features {
        list-style: none;
        padding: 0;
        text-align: left;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .features li {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 6px 0;
        font-size: 15px;
        color: var(--dark-gray-color);
    }

    .features img {
        width: 20px;
        height: 20px;
    }

    .btn {
        width: 100%;
        padding: 14px 0;
        border-radius: 40px;
        cursor: pointer;
        font-size: 18px;
        transition: all .3s ease;
    }

    .pink-cream-btn:hover {
        transform: scale(1.05);
        border: var(--pink-color) 2px solid;
    }

    .yellow-gradient-btn:hover {
        transform: scale(1.05);
    }
</style>
@endsection