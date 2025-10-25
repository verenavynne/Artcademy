@extends('layouts.master-admin')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold">Selamat Pagi, Farren!</h4>
    <div>
      <button class="btn btn-warning me-2"><i class="fa-solid fa-plus me-1"></i> Tambah Kursus</button>
      <button class="btn btn-outline-warning"><i class="fa-solid fa-calendar-plus me-1"></i> Tambah Event</button>
    </div>
  </div>

  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="card shadow-sm border-0 text-center p-3">
        <i class="fa-solid fa-user text-warning fs-3 mb-2"></i>
        <h6>Total Pengguna</h6>
        <h3 class="fw-bold mb-0">2.525</h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 text-center p-3">
        <i class="fa-solid fa-book text-warning fs-3 mb-2"></i>
        <h6>Total Kursus</h6>
        <h3 class="fw-bold mb-0">1.365</h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 text-center p-3">
        <i class="fa-solid fa-calendar text-warning fs-3 mb-2"></i>
        <h6>Total Event</h6>
        <h3 class="fw-bold mb-0">200</h3>
      </div>
    </div>
  </div>

  <div class="table-responsive table-custom p-3">
    <h6 class="fw-semibold mb-3">Laporan Forum</h6>
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
