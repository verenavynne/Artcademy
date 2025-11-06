@extends('layouts.master-admin')

@section('content')
<div class="container-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold" style="font-size: 32px">Selamat Pagi, Farren!</h4>
    <div class="tambah-kursus-event">

      <button class="btn-tambah">
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
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">2.525</h3>
      </div>
    </div>

    <div class="total-kursus col">
      <div class="card border-0 text-center">
        <div class="icon-text">
        <iconify-icon icon="mingcute:book-2-fill" class="total-icon"></iconify-icon>
        <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Total Kursus</h6>
        </div>
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">1.365</h3>
      </div>
    </div>

    <div class="total-event col">
      <div class="card border-0 text-center">
        <div class="icon-text">
        <iconify-icon icon="bxs:calendar" class="total-icon"></iconify-icon>
        <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Total Event</h6>
        </div>
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">200</h3>
      </div>
    </div>

  </div>


<div class="table-section">
  <div class="title-section">
    <iconify-icon icon="ic:round-report-problem" class="total-icon"></iconify-icon>
    <h6>Laporan Forum</h6>
  </div>

  <hr class="title-divider">

  <div class="table-data">

    <table class="table table-borderless">
      <thead class="sticky-top">
          <tr>
            <th>No.</th>
            <th>Waktu Dilaporkan</th>
            <th>Nama Pengguna</th>
            <th>Postingan</th>
            <th>Dilaporkan Oleh</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
  <tbody>
            <tr><td>1</td><td>01/11/2025</td><td>Andi</td>
            <td class="textpanjang">Diskusi Umum Diskusi Umum Diskusi Umum</td>
            <td>Budi</td>
              <td><span class="badge-status pending"><span class="gradient-text pending">Menunggu</span></span></td>
              <td>
                <iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon>
                <iconify-icon icon="tabler:circle-check-filled" class="aman-icon"></iconify-icon>
                <iconify-icon icon="fluent:delete-12-filled" class="hapus-icon"></iconify-icon>
            </td>
            </tr>
            <tr><td>2</td><td>01/11/2025</td><td>Citra</td><td>Tips Belajar</td><td>Dian</td>
              <td><span class="badge-status success"><span class="gradient-text success">Aman</span></span></td>
              <td><iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon></td>
            </tr>
            <tr><td>3</td><td>01/11/2025</td><td>Doni</td><td>Keluhan Sistem</td><td>Eva</td>
              <td><span class="badge-status danger"><span class="gradient-text danger">Dihapus</span></span></td>
              <td><iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon></td>
            </tr>
            <tr><td>4</td><td>01/11/2025</td><td>Fina</td><td>Feedback Aplikasi</td><td>Gina</td>
              <td><span class="badge-status pending"><span class="gradient-text pending">Menunggu</span></span></td>
              <td><iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon>
                <iconify-icon icon="tabler:circle-check-filled" class="aman-icon"></iconify-icon>
                <iconify-icon icon="fluent:delete-12-filled" class="hapus-icon"></iconify-icon></td>
            </tr>
            <tr><td>5</td><td>02/11/2025</td><td>Hadi</td><td>Topik Diskusi</td><td>Ika</td>
              <td><span class="badge-status success"><span class="gradient-text success">Aman</span></span></td>
              <td><iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon></td>
            </tr>
            <tr><td>6</td><td>02/11/2025</td><td>Joko</td><td>Bug Laporan</td><td>Kiki</td>
              <td><span class="badge-status danger"><span class="gradient-text danger">Dihapus</span></span></td>
              <td><iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon></td>
            </tr>
            <tr><td>7</td><td>02/11/2025</td><td>Rio</td><td>Bug Laporan</td><td>Kiki</td>
              <td><span class="badge-status danger"><span class="gradient-text danger">Dihapus</span></span></td>
              <td><iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon></td>
            </tr>
            <tr><td>8</td><td>02/11/2025</td><td>Ren</td><td>Bug Laporan</td><td>Kiki</td>
              <td><span class="badge-status success"><span class="gradient-text success">Aman</span></span></td>
              <td><iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon></td>
            <tr><td>9</td><td>02/11/2025</td><td>Fel</td><td>Bug Laporan</td><td>Kiki</td>
              <td><span class="badge-status danger"><span class="gradient-text danger">Dihapus</span></span></td>
              <td><iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon></td>
            </tr>
            <tr><td>10</td><td>02/11/2025</td><td>Vyn</td><td>Bug Laporan</td><td>Kiki</td>
              <td><span class="badge-status success"><span class="gradient-text success">Aman</span></span></td>
              <td><iconify-icon icon="fa6-solid:eye" class="view-icon"></iconify-icon></td>
            </tr>
            </tr>
          </tbody>
</table>
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





</div>
</div>
@endsection
