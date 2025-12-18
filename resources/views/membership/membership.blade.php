@extends('layouts.master')

@section('content')

@if (session('info'))
    <div class="alert alert-warning mt-3">{{ session('info') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <div class="d-flex flex-row align-items-center gap-4">
        <a class="page-link" href="{{ route('home') }}" onclick="window.history.back()">
            <div class="navigation-prev d-flex flex-start">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </div>
        </a>
        <div class="d-flex flex-column pb-4">
            <p class="title text-start fw-bold">Langganan Sekali, Belajar Berkali-Kali!</p>
            <p class="projek-title-desc">Dapatkan akses ke ratusan materi seni dari dasar sampai tingkat lanjutan. Semua ada di sini, tinggal kamu yang mulai!</p>
        </div>
    </div>

    <div class="pricing-container">
        @foreach ($memberships as $membership)
            @include('components.membership-card')
        @endforeach
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
</style>
@endsection