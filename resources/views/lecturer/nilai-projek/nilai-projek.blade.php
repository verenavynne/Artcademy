@extends('layouts.master-tutor')

@section('content')
<div class="container-content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

  <div class="d-flex justify-content-between align-items-center">
    <h4 class="fw-semibold" style="font-size: 32px">Nilai Projek</h4>
  </div>

  @include('profile.components.tab', ['firstTab' => 'menunggu-dinilai', 'secondTab' => 'selesai', 'activeTab' => 'menunggu-dinilai'])

  <div class="tab-content-container">
        <div class="tab-content active" data-tab-content="menunggu-dinilai">
            <div class="d-flex flex-row flex-wrap gap-4 p-3">
                @forelse ($menungguSubmissions as $submission)
                    @include('components.nilai-projek-card')
                @empty
                    <div class="d-flex flex-column align-items-center w-100 gap-4" style="margin-top: 70px;">
                        <img src="{{ asset('assets/course/empty.svg') }}" alt="" style="width: 100px">
                        <div>
                            <h3 class="text-center fw-semibold" style="font-size: 20px; color: var(--black-color)">Belum ada projek siswa</h3>
                            <p class="text-center" style="font-size: 18px; color: var(--dark-gray-color)">Saat ini belum ada projek siswa yang perlu dinilai</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="tab-content" data-tab-content="selesai">
            <div class="d-flex flex-row flex-wrap gap-4 p-3">
                @forelse ($selesaiSubmissions as $submission)
                    @include('components.selesai-nilai-projek-card')
                @empty
                    <div class="d-flex flex-column align-items-center w-100 gap-4" style="margin-top: 70px;">
                        <img src="{{ asset('assets/course/empty.svg') }}" alt="" style="width: 100px">
                        <div>
                            <h3 class="text-center fw-semibold" style="font-size: 20px; color: var(--black-color)">Belum ada projek siswa</h3>
                            <p class="text-center" style="font-size: 18px; color: var(--dark-gray-color)">Saat ini belum ada projek siswa yang selesai dinilai</p>
                        </div>
                    </div>
                @endforelse
            </div>
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


  const tabLinks = document.querySelectorAll(".tab-link");
    const tabContents = document.querySelectorAll(".tab-content");

    tabLinks.forEach(btn => {
        btn.addEventListener("click", () => {
            const target = btn.getAttribute("data-tab");

            tabLinks.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            tabContents.forEach(content => {
                if (content.getAttribute("data-tab-content") === target) {
                    content.classList.add("active");
                } else {
                    content.classList.remove("active");
                }
            });
        });
    });
</script>



<style>    
    .text-custom {
        color: #D0C4AF !important;
    }
</style>
@endsection
