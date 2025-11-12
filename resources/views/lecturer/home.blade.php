@extends('layouts.master-tutor')

@section('content')
<div class="container-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold" style="font-size: 32px">Selamat Pagi, Farren!</h4>
  </div>

  <div class="row mb-4">


    <div class="total-kursus col">
      <div class="card-tutor border-0 text-center">
        <div class="icon-text-tutor">
        <iconify-icon icon="mingcute:book-2-fill" class="total-icon-tutor"></iconify-icon>
        <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Total Kursus</h6>
        </div>
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">30</h3>
      </div>
    </div>

    <div class="jadwal-zoom col">
      <div class="card-tutor border-0 text-start">
        <div class="dashboard-card-wrapper">
          
          <div class="icon-text-wrapper">
            <div class="icon-text-tutor" style="width:100%; justify-content: left;">
              <iconify-icon icon="bxs:calendar" class="total-icon-tutor"></iconify-icon>
              <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">
                Jadwal Zoom Mendatang
              </h6>
            </div>

            <iconify-icon icon="iconamoon:arrow-up-2-bold" class="arrow-icon" style="transform: rotate(90deg);"></iconify-icon>
          </div>


          <h3 class="fw-bold mb-0" style="font-size: 18px; color: var(--Black, #1B1B1B);">
            Live Demo: Membuat Karakter Game dari Nol dalam 90 Menit
          </h3>
          
          <div class="info-item-wrapper d-flex flex-row gap-2">
            <div class="info-item d-flex align-items-center gap-2">
              <iconify-icon icon="mdi:calendar-month" class="info-icon"></iconify-icon>
              <span>1 Juni 2025</span>
            </div>

            <div class="info-item d-flex align-items-center gap-2">
              <iconify-icon icon="mdi:clock-time-four-outline" class="info-icon"></iconify-icon>
              <span>12.00 - 13.30</span>
            </div>
          </div>

        </div>
      </div>
    </div>


  </div>


<div class="dashboard-nilai-projek-card">
          <div class="icon-text-wrapper">
            <div class="icon-text-tutor" style="width:100%; justify-content: left;">
              <iconify-icon icon="iconamoon:file-document-fill" class="total-icon-tutor"></iconify-icon>
              <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">
                Nilai Projek Siswa
              </h6>
            </div>

            <iconify-icon icon="iconamoon:arrow-up-2-bold" class="arrow-icon" style="transform: rotate(90deg);"></iconify-icon>
          </div>

  <div class="admin-tutor-card-wrapper d-flex flex-row">
            @include('components.nilai-projek-card')

            @include('components.nilai-projek-card')

            @include('components.nilai-projek-card')

            @include('components.nilai-projek-card')

            @include('components.nilai-projek-card')
    </div>
</div>

</div>


<script>
  document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".table-body-scroll tbody tr");

    rows.forEach(row => {
      const statusCell = row.querySelector(".badge-status");
      const actionCell = row.querySelector("td:last-child");

      if (!statusCell || !actionCell) return;

      const status = statusCell.textContent.trim();

      actionCell.innerHTML = '';

      const viewIcon = '<i class="fa-regular fa-eye"></i>';

      if (status === "Menunggu") {
        const approveIcon = '<i class="fa-solid fa-check"></i>';
        const deleteIcon = '<i class="fa-solid fa-trash"></i>';
        actionCell.innerHTML = viewIcon + approveIcon + deleteIcon;
      } else {
        actionCell.innerHTML = viewIcon;
      }
    });
  });
</script>

<style>

/* Tiap card */
.admin-tutor-card-wrapper > * {
  flex: 1 1 calc(20% - 16px);
  min-width: 220px;
}

/* Responsif */
@media (max-width: 1200px) {
  .admin-tutor-card-wrapper > * {
    flex: 1 1 calc(33.33% - 16px);
  }
}

@media (max-width: 768px) {
  .admin-tutor-card-wrapper > * {
    flex: 1 1 calc(50% - 16px);
  }
}

@media (max-width: 480px) {
  .admin-tutor-card-wrapper > * {
    flex: 1 1 100%;
  }
}
</style>


</div>
</div>
@endsection














<!-- <h1>Dashboard Lecturer</h1>
<div>
    <a href="{{ route('logout') }}" class="nav-link" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            logout
    </a>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form> -->