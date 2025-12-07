@extends('layouts.master-tutor')

@section('content')
<div class="container-content">
  <div class="d-flex justify-content-between align-items-center">
    <h4 class="fw-semibold" style="font-size: 25px">Selamat {{ $greeting }}, {{ ucfirst($user->name) }}!</h4>
  </div>

  <div class="row mb-3">


    <div class="total-kursus col">
      <div class="card-tutor border-0 text-center">
        <div class="icon-text-tutor">
        <iconify-icon icon="mingcute:book-2-fill" class="total-icon-tutor"></iconify-icon>
        <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Total Kursus</h6>
        </div>
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">{{ $totalCourses }}</h3>
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

            <a href="{{ route('lecturer.jadwal-saya') }}">
              <iconify-icon icon="iconamoon:arrow-up-2-bold" class="arrow-icon" style="transform: rotate(90deg); color:black;"></iconify-icon>
            </a>
          </div>


          @if($zoom)
            <h3 class="fw-bold mb-0" style="font-size: 18px; color: var(--Black, #1B1B1B);">
              {{ $zoom->zoomName }}
            </h3>
            
            <div class="info-item-wrapper d-flex flex-row gap-4">
              <div class="info-item d-flex align-items-center gap-2">
                <iconify-icon icon="mdi:calendar-month" class="info-icon"></iconify-icon>
                <span>{{ \Carbon\Carbon::parse($zoom->zoomDate)->translatedFormat('d F Y') }}</span>
              </div>

              <div class="info-item d-flex align-items-center gap-2">
                <iconify-icon icon="mdi:clock-time-four-outline" class="info-icon"></iconify-icon>
                <span>{{ \Carbon\Carbon::parse($zoom->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($zoom->end_time)->format('H:i') }}</span>
              </div>
            </div>
          @else
              <p class="text-muted">Tidak ada jadwal zoom mendatang</p>
          @endif

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

            <a href="{{ route('lecturer.nilai-projek') }}">
              <iconify-icon icon="iconamoon:arrow-up-2-bold" class="arrow-icon" style="transform: rotate(90deg); color: black;"></iconify-icon>
            </a>
          </div>

          @if($submissions->isEmpty())
              <div class="d-flex flex-column align-items-center gap-3">
                  <p class="text-muted text-center" style="font-size: 18px">Belum ada projek siswa</p>
              </div>
          @else
            <div class="nilai-projek-card-section">
              @foreach($submissions as $submission)
              @include('components.nilai-projek-card')
              @endforeach
              
            </div>
          @endif
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
  min-width: 230px;
}

.empty-nilai-siswa{
  padding: 150px;
  align-items: center;
  width: 100%;
  justify-content: center;
  font-size: 18px;
  color: var(--dark-gray-color);
  text-align: center;
}

.nilai-projek-card-section{
  display: grid;
  gap: 10px;
  grid-template-columns: repeat(4, 1fr);
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
@endsection