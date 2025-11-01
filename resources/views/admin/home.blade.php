@extends('layouts.master-admin')

@section('content')
<div class="container-fluid">
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

  <div class="row g-4 mb-4">

    <div class="total-pengguna col-md-4">
      <div class="card border-0 text-center p-3">
        <div class="icon-text">
        <iconify-icon icon="fluent:person-12-filled" class="total-icon"></iconify-icon>
        <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Total Pengguna</h6>
        </div>
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">2.525</h3>
      </div>
    </div>

    <div class="total-kursus col-md-4">
      <div class="card border-0 text-center p-3">
        <div class="icon-text">
        <iconify-icon icon="mingcute:book-2-fill" class="total-icon"></iconify-icon>
        <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Total Kursus</h6>
        </div>
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">1.365</h3>
      </div>
    </div>

    <div class="total-event col-md-4">
      <div class="card border-0 text-center p-3">
        <div class="icon-text">
        <iconify-icon icon="bxs:calendar" class="total-icon"></iconify-icon>
        <h6 style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Total Event</h6>
        </div>
        <h3 class="fw-bold mb-0" style="font-size: 50px; color: var(--Black, #1B1B1B);">200</h3>
      </div>
    </div>

  </div>

  <div class="table-responsive table-custom p-3">
    <div style="align-items: flex-start; gap: 4px;">
      <iconify-icon icon="ic:round-report-problem" class="total-icon"></iconify-icon>
      <h6 class="mb-3" style="font-size: 18px; color: var(--Black, #1B1B1B); font-weight: 400;">Laporan Forum</h6>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Waktu Dilaporkan</th>
          <th>Nama Pengguna</th>
          <th>Postingan</th>
          <th>Dilaporkan Oleh</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>06 Juli 2024 . 21:10</td>
          <td>Farren</td>
          <td>Lorem ipsum dolor sit amet</td>
          <td>Felicia</td>
          <td><span class="badge bg-warning text-dark">Menunggu</span></td>
          <td>
            <i class="fa-regular fa-eye me-2 text-secondary"></i>
            <i class="fa-solid fa-check me-2 text-success"></i>
            <i class="fa-solid fa-trash text-danger"></i>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
