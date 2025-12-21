<div class="popup-overlay" id="passwordPopupOverlay">
  <div class="popup-card" style="width: 570px;">
    <!-- Close Button -->
    <button class="close-btn" id="closePasswordPopupBtn">
        <iconify-icon icon="si:close-fill" class="tambah-icon"></iconify-icon>
    </button>

    <!-- Title -->
    <h4 class="popup-title">Ubah Kata Sandi</h4>
    <p>Masukkan kata sandi barumu pada kolom berikut </p>

    <!-- Form -->
    <form id="passwordForm" action="{{ route('profile.change-password') }}" method="POST" class="popup-form">
      @csrf
      <!-- Kata Sandi Saat Ini -->
      <div class="form-row">
        <div class="form-group full">
          <label for="currentPassword">Kata Sandi Saat ini</label>
          <div class="position-relative">
            <input type="password" name="currentPassword" id="currentPassword" class="form-control rounded-pill px-4 py-2 custom-input pe-5" placeholder="Minimal 8 karakter" value="{{ old('currentPassword') }}">
            <span class="toggle-password" onclick="togglePassword('currentPassword', 'eyeCurrent')" 
                  style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); cursor: pointer;">
              <iconify-icon id="eyeCurrent" icon="mingcute:eye-close-line"></iconify-icon>
            </span>
          </div>
          @error('currentPassword', 'passwordErrors')
            <div class="text-danger mt-1" style="font-size: 0.875rem;">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>

      <!-- Kata Sandi Baru -->
      <div class="form-row">
        <div class="form-group full">
          <label for="newPassword">Kata Sandi Baru</label>
          <div class="position-relative">
            <input type="password" name="newPassword" id="newPassword" class="form-control rounded-pill px-4 py-2 custom-input pe-5" placeholder="Minimal 8 karakter" value="{{ old('newPassword') }}" value="{{ old('confirmNewPassword') }}">
            <span class="toggle-password" onclick="togglePassword('newPassword', 'eyeNew')" 
                  style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); cursor: pointer;">
              <iconify-icon id="eyeNew" icon="mingcute:eye-close-line"></iconify-icon>
            </span>
          </div>
          @error('newPassword', 'passwordErrors')
            <div class="text-danger mt-1" style="font-size: 0.875rem;">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>

      <!-- Konfirmasi Kata Sandi Baru -->
      <div class="form-row">
        <div class="form-group full">
          <label for="confirmNewPassword">Konfirmasi Kata Sandi Baru</label>
          <div class="position-relative">
            <input type="password" name="confirmNewPassword" id="confirmNewPassword" class="form-control rounded-pill px-4 py-2 custom-input pe-5" placeholder="Tulis kembali kata sandimu">
            <span class="toggle-password" onclick="togglePassword('confirmNewPassword', 'eyeConfirm')" 
                  style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); cursor: pointer;">
              <iconify-icon id="eyeConfirm" icon="mingcute:eye-close-line"></iconify-icon>
            </span>
          </div>
          @error('confirmNewPassword', 'passwordErrors')
            <div class="text-danger mt-1" style="font-size: 0.875rem;">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>

      <!-- Tombol Simpan -->
      <div class="d-flex justify-content-end mt-4">
        <button id="savePasswordBtn" type="submit" class="btn text-dark yellow-gradient-btn px-4">
          <span class="spinner-border spinner-border-sm d-none"></span>
          <span class="btn-text">Simpan</span>
        </button>
      </div>
    </form>
  </div>
</div>

@if ($errors->passwordErrors->any())
<script>
    document.getElementById('passwordPopupOverlay').style.display = 'flex';
</script>
@endif

<script>
  function togglePassword(inputId, eyeId) {
    const input = document.getElementById(inputId);
    const eyeIcon = document.getElementById(eyeId);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    eyeIcon.setAttribute('icon', isHidden ? 'mingcute:eye-line' : 'mingcute:eye-close-line');
  }


  document.getElementById('closePasswordPopupBtn').addEventListener('click', function() {
    const overlay = document.getElementById('passwordPopupOverlay');
    overlay.style.display = 'none';

    document.getElementById('currentPassword').value = '';
    document.getElementById('newPassword').value = '';
    document.getElementById('confirmNewPassword').value = '';
  });


  document.getElementById("passwordForm").addEventListener("submit", function() {
      const btn = document.getElementById("savePasswordBtn");
      const btnText = btn.querySelector('.btn-text');
      const spinner = btn.querySelector('.spinner-border');

      btn.disabled = true;
      btnText.textContent = "Memproses...";
      spinner.classList.remove("d-none");
  });
</script>

<style>
    .popup-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(27, 27, 27, 0.4);
        backdrop-filter: blur(3px);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .popup-card {
        background: white;
        border-radius: 24px;
        padding: 36px 48px;
        width: 725px;
        position: relative;
        box-shadow: 0px 8px 20px rgba(67, 39, 0, 0.25);
        animation: popupIn 0.25s ease;
    }

    @keyframes popupIn {
        from {
            transform: scale(0.95);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .close-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 28px;
        height: 28px;
        background: #F9EEDB;
        border-radius: 100px;
        border: none;
        position: absolute;
        top: 16px;
        right: 16px;
        cursor: pointer;
        color: #E5C69B;
    }

    .popup-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--dark-gray-color);
    }

    .popup-form .form-row {
        display: flex;
        gap: 22px;
        margin-bottom: 16px;
    }

    .popup-form .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .popup-form .form-group.full {
        width: 100%;
    }

    .popup-form label {
        font-size: 18px;
        font-weight: 700;
        color: var(--dark-gray-color);
        margin-bottom: 6px;
    }

    .d-none {
        display: none !important;
    }
</style>