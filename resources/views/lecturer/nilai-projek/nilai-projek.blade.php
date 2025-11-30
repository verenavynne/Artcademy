@extends('layouts.master-tutor')

@section('content')
<div class="container-content">
  <div class="d-flex justify-content-between align-items-center">
    <h4 class="fw-semibold" style="font-size: 32px">Nilai Projek</h4>
  </div>

  <ul class="nav mb-4 mt-4 w-100 statusTabs">
    <li class="nav-item flex-fill text-center">
        <a class="nav-link fs-5 {{ $status !== 'selesai' ? 'active' : 'text-custom' }}" 
           href="{{ route('lecturer.nilai-projek', ['status' => 'menunggu']) }}">
           Menunggu Dinilai
        </a>
    </li>
    <li class="nav-item flex-fill text-center">
        <a class="nav-link fs-5 {{ $status === 'selesai' ? 'active' : 'text-custom' }}" 
           href="{{ route('lecturer.nilai-projek', ['status' => 'selesai']) }}">
           Selesai
        </a>
    </li>
  </ul>

  <div class="admin-tutor-card-wrapper d-flex flex-row flex-wrap">
    @forelse($submissions as $submission)

      @if(!$submission->isGraded)
          @include('components.nilai-projek-card')
      @else
          @include('components.selesai-nilai-projek-card')
      @endif

    @empty
      <p class="text-center w-100">Tidak ada projek yang {{ $status === 'selesai' ? 'sudah selesai' : 'perlu' }} dinilai.</p>
    @endforelse
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
    .nav-link{
        width: 100%;
    }
    .statusTabs {
        border-bottom: 4px solid #F9EEDB;
        position: relative;
    }

    .statusTabs .nav-link:hover,
    .statusTabs .nav-link.active {
        background: var(--pink-gradient-color);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .statusTabs .nav-link:hover::after,
    .statusTabs .nav-link.active::after {
        position: absolute;
        bottom: -4px;
        border-radius: 10px;
        height: 4px;
    }
        .text-custom {
        color: #D0C4AF !important;
    }

    .admin-tutor-card-wrapper {
      overflow-y: scroll;
    }
  
</style>
@endsection
