<div class="popup-overlay" id="popupOverlay">
  <div class="popup-card">
    <button class="close-btn" id="closePopupBtn">
      <iconify-icon icon="si:close-fill" class="tambah-icon"></iconify-icon>
    </button>

    <h4 class="popup-title">Tambah Pengguna</h4>

    <form action="{{ route('admin.user.user-store') }}" method="POST" enctype="multipart/form-data" id="formTambahUser" class="popup-form">
      @csrf
      <div class="form-row">
        <div class="form-group">
          <label class="form-label fw-semibold">Pilih Role</label>
          <select id="selectedRole" name="role" class="form-select rounded-pill px-4 py-2 custom-input select-with-icon">
            <option disabled {{ old('role') ? '' : 'selected' }}>Pilih role</option>
            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="lecturer" {{ old('role') === 'lecturer' ? 'selected' : '' }}>Tutor</option>
          </select>
          @error('role')
            <div class="text-danger mt-1" style="font-size: 0.875rem;">
              {{ $message }}
            </div>
          @enderror
        </div>
    </div>

      <div class="form-row">
        <div class="form-group">
          <label>Nama</label>
          <input name="name" id="nameInput" class="form-control rounded-pill px-4 py-2 custom-input pe-5" type="text" value="{{ old('name') }}" placeholder="Tulis nama tutor disini">
          @error('name')
            <div class="text-danger mt-1" style="font-size: 0.875rem;">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group" id="specialization-group" style="display: none;">
          <label>Keahlian</label>
          <select name="specialization" class="form-select rounded-pill px-4 py-2 custom-input select-with-icon">
            <option selected disabled>Pilih keahlian</option>
            <option value="Seni Lukis & Digital Art">Seni Lukis & Digital Art</option>
            <option value="Seni Musik">Seni Musik</option>
            <option value="Seni Tari">Seni Tari</option>
            <option value="Seni Fotografi">Seni Fotografi</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>No. Telepon</label>
          <input name="phoneNumber" id="phoneNumber" class="form-control rounded-pill px-4 py-2 custom-input pe-5" type="text" value="{{ old('phoneNumber', '+62') }}" placeholder="+62xxxxxxxxxx">
          @error('phoneNumber')
            <div class="text-danger mt-1" style="font-size: 0.875rem;">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label>Email</label>
            <input name="email" class="form-control rounded-pill px-4 py-1 custom-input" type="email" value="{{ old('email') }}" placeholder="Cth: artcademy@gmail.com">
            @error('email')
              <div class="text-danger mt-1" style="font-size: 0.875rem;">
                {{ $message }}
              </div>
            @enderror
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Kata Sandi</label>
          <div class="position-relative">
            <input type="password" name="password" id="password" class="form-control rounded-pill px-4 py-2 custom-input pe-5" placeholder="Minimal 8 karakter">
            <span class="toggle-password" onclick="togglePassword('password', 'eye-password')" 
              style="position: absolute; right: 16px; top: 57%; transform: translateY(-50%); cursor: pointer;">
              <iconify-icon id="eye-password" icon="mingcute:eye-close-line"></iconify-icon>
            </span>
          </div>
          @error('password')
            <div class="text-danger mt-1" style="font-size: 0.875rem;">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label>Konfirmasi Kata Sandi</label>
          <div class="position-relative">
            <input type="password" name="password_confirmation" id="confirmPassword" class="form-control rounded-pill px-4 py-2 custom-input pe-5" placeholder="Tulis kembali kata sandimu">
            <span class="toggle-password" onclick="togglePassword('confirmPassword', 'eye-confirm-password')" 
              style="position: absolute; right: 16px; top: 57%; transform: translateY(-50%); cursor: pointer;">
              <iconify-icon id="eye-confirm-password" icon="mingcute:eye-close-line"></iconify-icon>
            </span>
          </div>
          @error('password_confirmation')
            <div class="text-danger mt-1" style="font-size: 0.875rem;">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>

      <div class="form-group full" style="display: none;" id="profilePictureGroup">
        <label>Foto Tutor</label>
        <div class="file-upload">
            <button type="button" class="btn pink-cream-btn px-4" id="addProfileBtn">Pilih File</button>
            <span id="fileName" style="color: #D0C4AF;">Tidak ada file yang dipilih</span>
            <input type="file" name="profilePicture" id="profilePicture" accept="image/*" class="d-none">
        </div>
      </div>

      <div class="d-flex justify-content-end mt-4">
        <button type="submit" id="submitBtn" class="btn text-dark yellow-gradient-btn px-4 d-flex align-items-center justify-content-center gap-2" style="width: 170px;">
          <div id="loadingSpinner" class="spinner-border spinner-border-sm text-dark d-none" role="status"></div>
          <span id="btnText">Daftar</span>
       </button>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {

    function togglePassword(inputId, eyeId) {
      const input = document.getElementById(inputId);
      const eyeIcon = document.getElementById(eyeId);
      const isHidden = input.type === 'password';
  
      input.type = isHidden ? 'text' : 'password';
      eyeIcon.setAttribute('icon', isHidden ? 'mingcute:eye-line' : 'mingcute:eye-close-line');
    }
  
    const selectedRole = document.getElementById('selectedRole');
    const specializationGroup = document.getElementById('specialization-group');
    const nameInput = document.getElementById('nameInput');

    function handleRole(role){
      if(!role) return;

      if (role.toLowerCase() === 'lecturer') {
        specializationGroup.style.display = 'block';
        profilePictureGroup.style.display = 'block';
        nameInput.placeholder = 'Tulis nama tutor di sini';
      } else {
        specializationGroup.style.display = 'none';
        profilePictureGroup.style.display = 'none';
        nameInput.placeholder = 'Tulis nama admin di sini'
      }
    }
  
    selectedRole.addEventListener('change', function () {
      handleRole(this.value);
    });

    handleRole(selectedRole.value);
  
    const inputTelp = document.getElementById('phoneNumber');
  
    if (!inputTelp.value.startsWith('+62')) {
        inputTelp.value = '+62';
    }
  
    inputTelp.addEventListener('input', () => {
        // Cegah hapus +62
        if (!inputTelp.value.startsWith('+62')) {
            inputTelp.value = '+62';
        }
  
        // Hanya angka setelah +62
        const numbersOnly = inputTelp.value
            .replace('+62', '')
            .replace(/\D/g, '');
  
        inputTelp.value = '+62' + numbersOnly;
    });
  
    // Cegah cursor ke depan +62
    inputTelp.addEventListener('keydown', (e) => {
        if (input.selectionStart < 3) {
            e.preventDefault();
            input.setSelectionRange(3, 3);
        }
    });
  
    document.getElementById('addProfileBtn').addEventListener('click', function() {
      document.getElementById('profilePicture').click();
    });
  
    document.getElementById('profilePicture').addEventListener('change', function() {
      const fileNameText = document.getElementById('fileName');
      fileNameText.textContent = this.files.length ? this.files[0].name : "Tidak ada file yang dipilih";
    });
  
    // loading
    const form = document.getElementById('formTambahUser');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const loadingSpinner = document.getElementById('loadingSpinner');
  
    form.addEventListener('submit', function () {
      submitBtn.disabled = true;
  
      btnText.textContent = 'Memproses...';
      loadingSpinner.classList.remove('d-none');
    });
  })
</script>

<style>
/* Popup Overlay */
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

/* Popup Card */
.popup-card {
  background: white;
  border-radius: 24px;
  padding: 36px 48px;
  width: 725px;
  box-shadow: 0px 8px 20px rgba(67, 39, 0, 0.25);
  position: relative;
  animation: popupIn 0.25s ease;
}

@keyframes popupIn {
  from { transform: scale(0.95); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

/* Close Button */
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

/* Title */
.popup-title {
  font-size: 22px;
  font-weight: 700;
  color: var(--dark-gray-color);
  margin-bottom: 24px;
}

/* Form Layout */
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

/* File Upload */
.file-upload {
  display: flex;
  align-items: center;
  gap: 16px;
  background-color: var(--very-light-grey-color);
  border-radius: 40px;
  box-shadow: 0px 4px 8px var(--brown-shadow-color);
  width: 100%; 
}

.spinner-border {
  display: inline-block;
  width: 1rem;
  height: 1rem;
  border: 2px solid rgba(0, 0, 0, 0.15);
  border-right-color: transparent;
  border-radius: 50%;
  animation: spin 0.75s linear infinite;
}

@keyframes spin {
  100% {
    transform: rotate(360deg);
  }
}

.d-none {
  display: none !important;
}
</style>

