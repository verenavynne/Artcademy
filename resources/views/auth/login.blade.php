<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artcademy</title>
    @include('custom.library')
    @include('styles.style')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row min-vh-100 flex-column flex-md-row">
            <!-- Left Side -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-start p-5 left-panel">
                <img src="{{ asset('assets/logo.png') }}" alt="Artcademy Logo" class="mb-4" style="height: 30px;">
                <h1 class="fw-bold text-pink-gradient" style="font-size: 58px;">Selamat Datang Kembali,</h1>
                <h1 class="fw-bold text-dark mb-3" style="font-size: 58px;">Kreator Hebat!</h1>
                <p class="text-secondary fs-5">
                    Skill keren, karya orisinal, dan komunitas seniman muda siap menyambutmu. Yuk lanjutkan perjalanan senimu bareng Artcademy!
                </p>

                <div class="w-100 d-flex justify-content-center">
                    <img src="{{ asset('assets/auth/login-pic.png') }}" alt="Login Illustration" class="mb-4" style="max-width: 365px;">
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
                <h4 class="fw-bold mb-3 text-center fs-2">Masuk</h4>
                <p class="text-muted text-center fs-5">Masuk sekarang dan terus kembangkan kreativitasmu tanpa batas</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-pill px-4 py-2 custom-input" id="email" placeholder="Cth: artcademy@gmail.com">

                        @error('email')
                            <div class="text-danger mt-1" style="font-size: 0.875rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kata Sandi</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control rounded-pill px-4 py-2 custom-input pe-5" placeholder="Minimal 8 karakter">
                            <span class="toggle-password" onclick="togglePassword('password', 'eye-password')" 
                                style="position: absolute; right: 16px; top: 57%; transform: translateY(-50%); cursor: pointer;">
                                <iconify-icon id="eye-password" icon="mingcute:eye-close-line"></iconify-icon>
                            </span>

                            @error('password')
                                <div class="text-danger mt-1" style="font-size: 0.875rem;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-end mt-1">
                            <a href="{{ route('password.request') }}" class=" fw-semibold text-pink-gradient">Lupa Kata Sandi?</a>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn w-100 text-dark yellow-gradient-btn">Masuk</button>
                    </div>

                    <div class="separator"><span>Atau</span></div>

                    <div class="d-grid">
                        <a href="{{ route('google.login') }}" class="btn pink-cream-btn d-flex align-items-center justify-content-center gap-2">
                            <iconify-icon icon="flat-color-icons:google"></iconify-icon>
                            <span class="text-pink-gradient">Masuk dengan Google</span>
                        </a>
                    </div>

                    <div class="text-center mt-4">
                        Belum Punya Akun? <a href="{{ route('register') }}" class="fw-semibold text-decoration-none text-pink-gradient">Daftar disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>


<script>
    function togglePassword(inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeId);
        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';
        eyeIcon.setAttribute('icon', isHidden ? 'mingcute:eye-line' : 'mingcute:eye-close-line');
    }
</script>


<style>
    .circle {
        border: 4px solid #FFDCA7;
    }
    .left-panel {
        background: radial-gradient(circle at center,rgb(255, 208, 143) 0%, #FFF9EF 100%);
    }
</style>

