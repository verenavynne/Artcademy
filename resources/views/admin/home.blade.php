@extends('layouts.master-admin')

@section('content')
<div class="container-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold" style="font-size: 32px">Selamat {{ $greeting }}, {{ ucfirst($user->name) }}!</h4>
    <div class="tambah-kursus-event">

      <button class="btn-tambah" onclick="window.location='{{ route('admin.courses.create') }}'">
        <span class="icon-circle-kursus">
          <iconify-icon icon="ic:round-plus" class="tambah-icon"></iconify-icon>
        </span>
        Tambah Kursus
      </button>

      <button class="btn-tambah">
        <span class="icon-circle-event">
          <iconify-icon icon="ic:round-plus" class="tambah-icon"></iconify-icon>
        </span>
        Tambah Event
      </button>

    </div>
  </div>

  <div class="row mb-4">

    <div class="total-pengguna col">
      <div class="card border-0 text-center">
        <div class="icon-text">
        <iconify-icon icon="fluent:person-12-filled" class="total-icon"></iconify-icon>
        <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Total Pengguna</h6>
        </div>
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">{{ $totalUsers }}</h3>
      </div>
    </div>

    <div class="total-kursus col">
      <div class="card border-0 text-center">
        <div class="icon-text">
        <iconify-icon icon="mingcute:book-2-fill" class="total-icon"></iconify-icon>
        <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Total Kursus</h6>
        </div>
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">{{ $totalCourses }}</h3>
      </div>
    </div>

    <div class="total-event col">
      <div class="card border-0 text-center">
        <div class="icon-text">
        <iconify-icon icon="bxs:calendar" class="total-icon"></iconify-icon>
        <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Total Event</h6>
        </div>
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">{{ $totalEvents }}</h3>
      </div>
    </div>

  </div>


<div class="table-section">
  <div class="title-section">
    <iconify-icon icon="majesticons:book-plus" class="total-icon"></iconify-icon>
    <h6>Manajemen Kursus</h6>
  </div>

  <hr class="title-divider">

  <div class="table-data">

    <table class="table table-borderless">
      <thead class="sticky-top">
        <tr>
          <th class="text-center">No.</th>
          <th>Waktu Dibuat</th>
          <th>Nama Kursus</th>
          <th>Kategori</th>
          <th>Level Kursus</th>
          <th class="text-center">Jumlah Pendaftar</th>
          <th>Terakhir Diubah</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($courses as $index => $course)
          @php
            $backgroundCourseStatus = match($course->courseStatus) {
            'publikasi' => '#EAFFEC',    
            'draft' => '#E7F6FE',         
            'arsip' => '#FFEAF0'
          };

          $backgroundCourseStatusText = match($course->courseStatus) {
            'publikasi' => 'var(--green-gradient-color)',    
            'draft' => 'var(--blue-gradient-color)',         
            'arsip' => 'var(--pink-gradient-color)'
            };
          @endphp
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $course->created_at->format('d M Y H:i') }}</td>
            <td class="text-truncate-ellipsis" title="{{ $course->courseName }}">{{ $course->courseName }}</td>
            <td class="text-truncate-ellipsis" title="{{ $course->courseType }}">{{ $course->courseType }}</td>
            <td>{{ ucfirst($course->courseLevel) }}</td>
            <td class="text-center">5</td>
            <td>{{ $course->updated_at->format('d M Y H:i') }}</td>
            <td>
              @if($course->courseStatus === 'publikasi')
                <div class="course-status-text-container" style="background: {{ $backgroundCourseStatus }}">
                  <p class="course-status-text" style="background: {{ $backgroundCourseStatusText }}; margin: 0; background-clip: text; font-weight: 700; font-size:var(--font-size-small)">Dipublikasikan</p>
                </div>
              @elseif($course->courseStatus === 'draft')
                <div class="course-status-text-container" style="background: {{ $backgroundCourseStatus }}">
                  <p class="course-status-text" style="background: {{ $backgroundCourseStatusText }}; margin: 0; background-clip: text; font-weight: 700; font-size:var(--font-size-small)">Draft</p>
                </div>
              @elseif($course->courseStatus === 'arsip')
                <div class="course-status-text-container" style="background: {{ $backgroundCourseStatus }}">
                  <p class="course-status-text" style="background: {{ $backgroundCourseStatusText }}; margin: 0; background-clip: text; font-weight: 700; font-size:var(--font-size-small)">Diarsipkan</p>
                </div>
              @endif
            </td>
            <td class="text-nowrap">
              @if($course->courseStatus !== 'draft')
                <a href="{{ route('course.detail', $course->id) }}" class="btn btn-sm p-0 me-2 border-0 bg-transparent">
                  <iconify-icon icon="fa6-solid:eye" width="20" height="20"></iconify-icon>
                </a>
              @endif
              @if($course->courseStatus !== 'publikasi')
                <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm text-warning p-0 me-2 border-0 bg-transparent">
                  <iconify-icon icon="lets-icons:edit" width="20" height="20"></iconify-icon>
                </a>
              @endif
              @if($course->courseStatus === 'publikasi')
                <form action="{{ route('admin.courses.archive', $course->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm p-0 border-0 bg-transparent" 
                    onclick="return confirm('Yakin ingin arsipkan kursus ini?')">
                    <iconify-icon icon="material-symbols:archive-rounded" width="20" height="20" style="color: var(--pink-medium-color)"></iconify-icon>
                  </button>
                </form>
              @endif
              @if($course->courseStatus !== 'publikasi')
                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm text-danger p-0 border-0 bg-transparent" 
                    onclick="return confirm('Yakin ingin hapus kursus ini?')">
                    <iconify-icon icon="fluent:delete-12-filled" width="20" height="20"></iconify-icon>
                  </button>
                </form>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center text-muted py-4">Tidak ada data kursus.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>


<script>
  document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".table-body-scroll tbody tr");

    rows.forEach((row, index) => {
      const statusCell = row.querySelector(".badge-status");
      const actionCell = row.querySelector("td:last-child");

      if (!statusCell || !actionCell) return;

      const status = statusCell.textContent.trim();
      console.log("row : " + index + "status: ", status);

      actionCell.innerHTML = '';

      const viewIcon = '<iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon>';

      if (status === "Menunggu") {
        const approveIcon = '<iconify-icon icon="tabler:circle-check-filled" class="aman-icon"></iconify-icon>';
        const deleteIcon = '<iconify-icon icon="fluent:delete-12-filled" class="hapus-icon"></iconify-icon>';
        actionCell.innerHTML = viewIcon + approveIcon + deleteIcon;
      } else {
        actionCell.innerHTML = viewIcon;
      }
    });
  });
</script>

<style>
  .course-status-text-container{
    border-radius: 10px;
    display: flex;
    padding: 2px 10px;
    justify-content: center;
    align-items: center;
    font-size: 16px;
    width: max-content;;
  }

  .course-status-text{
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .text-truncate-ellipsis {
    max-width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>
@endsection
