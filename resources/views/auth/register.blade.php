@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row min-vh-100 flex-column flex-md-row">
        <!-- Left Side -->
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-start p-5 left-panel">
            <img src="{{ asset('img/logo.png') }}" alt="Artcademy Logo" class="mb-4" style="height: 30px;">
            <h1 class="fw-bold mb-2 text-gradient" style="font-size: 58px;">Langkah - Langkah Kecil,</h1>
            <h1 class="fw-bold text-dark mb-3" style="font-size: 58px;">Awal Karya Besar</h1>
            <p class="text-secondary mb-4 fs-5">
                Saatnya eksplorasi beragam bidang seni yang kamu suka. Yuk, daftar dan wujudkan ide jadi karya nyata!
            </p>

            <div class="w-100 d-flex justify-content-center">
                <img src="{{ asset('img/auth/register-pic.png') }}" alt="Register Illustration" class="mb-4" style="max-width: 400px;">
            </div>

            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
            <div class="circle circle-4"></div>
            <div class="circle circle-5"></div>
            <div class="circle circle-6"></div>
        </div>

        <!-- Right Side -->
        <div class="col-md-6 d-flex flex-column justify-content-center p-5">
            <h4 class="fw-bold mb-3 text-center fs-2">Daftar</h4>
            <p class="text-center fs-5">Daftar sekarang dan mulai petualangan serumu di dunia seni!</p>

            <form>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Role</label>
                    <select class="form-select rounded-pill px-4 py-2 custom-input">
                        <option selected disabled>Pilih role</option>
                        <option value="creator">Tutor</option>
                        <option value="viewer">Siswa</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control rounded-pill px-4 py-2 custom-input" placeholder="Tulis namamu disini">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control rounded-pill px-4 py-2 custom-input" placeholder="Cth: renArtcademy@gmail.com">
                    </div>
                </div>

                <div class="row">
                   <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kata Sandi</label>
                        <div class="position-relative">
                            <input type="password" id="password" class="form-control rounded-pill px-4 py-2 custom-input pe-5" placeholder="Minimal 8 karakter">
                            <span class="toggle-password" onclick="togglePassword('password', 'eye-password')" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                <img src="{{ asset('img/auth/password-hide.png') }}" id="eye-password" alt="Toggle" style="height: 15px;">
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Konfirmasi Kata Sandi</label>
                        <div class="position-relative">
                            <input type="password" id="confirmPassword" class="form-control rounded-pill px-4 py-2 custom-input pe-5" placeholder="Tulis kembali kata sandimu">
                            <span class="toggle-password" onclick="togglePassword('confirmPassword', 'eye-confirm')" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                <img src="{{ asset('img/auth/password-hide.png') }}" id="eye-confirm" alt="Toggle" style="height: 15px;">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="d-grid mt-3">
                    <button type="submit" class="btn w-100 text-dark daftar-btn">
                        Daftar
                    </button>
                </div>

                <div class="separator"><span>Atau</span></div>

                <div class="d-grid">
                    <button type="button" class="btn rounded-pill py-2 px-3 d-flex align-items-center justify-content-center gap-2" style="border: 2px solid #E92D62; background: #F9EEDB;">
                        <img src="{{ asset('img/auth/google-logo.png') }}" alt="Google" style="height: 20px;">
                        <span class="text-gradient">Daftar dengan Google</span>
                    </button>
                </div>

                <div class="text-center mt-4">
                    Sudah Punya Akun? <a href="{{ route('login') }}" class="fw-semibold text-decoration-none text-gradient">Masuk disini</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
  function togglePassword(inputId, eyeId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById(eyeId);
    const isHidden = input.type === 'password';

    input.type = isHidden ? 'text' : 'password';
    eye.src = isHidden 
      ? '{{ asset("img/auth/password-unhide.png") }}'
      : '{{ asset("img/auth/password-hide.png") }}';
  }
</script>


<style>
    .daftar-btn {
        background: linear-gradient(180deg, #FFDE22 0%, #F4A700 100%);
        border: none;
        border-radius: 999px;
        padding: 12px 0;
        box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .daftar-btn:hover {
        opacity: 0.9;
    }

    .text-gradient {
        background: linear-gradient(90deg, #FF6E97, #E92D62);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .custom-input {
        background-color: #FAFAFA;
        border: none;
        box-shadow: 0px 4px 8px#43270033;
    }

    .custom-input::placeholder {
        color: #D0C4AF;
        opacity: 1;
    }

    .separator {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1rem 0;
    }

    .separator::before,
    .separator::after {
        content: '';
        flex: 1;
        border-bottom: 4px solid #F9EEDB;
        border-radius: 999px;
        margin: 0 12px;
    }

    .left-panel {
        background: radial-gradient(circle at center,rgb(255, 174, 174) 0%, #FFF9EF 100%);
        border-top-right-radius: 45px;
        border-bottom-right-radius: 45px;
        box-shadow: 0px 4px 8px #43270033;
    }

    .circle {
        position: absolute;
        border-radius: 50%;
        border: 4px solid #FFD7DE;
    }

    .circle-1 {
        width: 79px;
        height: 79px;
        top: -40px;
        left: 154px;
    }

    .circle-2 {
        width: 34px;
        height: 34px;
        top: 39px;
        left: 250px;
    }

    .circle-3 {
        width: 25px;
        height: 25px;
        top: 73px;
        left: 636px;
    }

    .circle-4 {
        width: 74px;
        height: 74px;
        top: 575px;
        left: 39px;
    }

    .circle-5 {
        width: 31px;
        height: 31px;
        top: 400px;
        left: 600px;
    }

    .circle-6 {
        width: 48px;
        height: 48px;
        top: 578px;
        left: 640px;
    }
</style>
@endsection
