<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artcademy Admin Panel</title>

  @include('custom.library')
  @include('styles.style')
  @include('styles.table-admin')
  @include('styles.admin-tutor-layoutscroll')
  @include('styles.form-style')

  <link rel="icon" type="image/png" href="{{ asset('assets/artcademy-icon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>
  <div class="container-fluid ps-4 pe-4">
    <header>
      @include('layouts.navbar-admin-tutor')
    </header>

    <!-- Wrapper utama berisi sidebar dan konten -->
    <div class="d-flex" id="admin-wrapper">
      <!-- Sidebar -->
      @include('layouts.menu-admin')

      <!-- Konten utama (Dashboard, Cards, Table, dsb) -->
      @yield('content')
    </div>

    @include('layouts.footer-admin')
  </div>
</body>


<style>
    body {
      font-family: 'Afacad', sans-serif;
      background-color: #FFF9EF;
      min-height: 100vh;
    }
    #admin-sidebar {
      width: 250px;
      min-height: 100vh;
      border-right: 1px solid #eee;
    }
    #admin-wrapper {
        display: flex;
        align-items: flex-start;
        height: calc(100vh - 146px);
        padding-bottom: 24px;
        padding-top: 12px;
        align-items: stretch; 
    }

    .row {
      --bs-gutter-x: 0 !important;
      gap: 24px;
      flex-wrap: nowrap !important;
    }

  /* .container-content{
    padding-right: 0px;
    padding-left: 28px;
    height: 100%;
    width:100%;
  } */

.tambah-kursus-event{
  display: flex;
  gap: 24px;
}

.btn-tambah {
  display: flex;
  width: 216px;
  height: 66px;
  font-size: 18px;
  align-items: center;
  gap: 10px;
  background: #fff;
  border: none;
  border-radius: 10px;
  box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
  padding: 0px 30px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  font-weight: 500;
  color: #4a4a4a;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-tambah:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(67, 39, 0, 0.2);
}


.icon-circle-kursus {
display: flex;
width: 37px;
height: 37px;
padding: 11.893px 9.25px;
flex-direction: column;
justify-content: center;
align-items: center;
gap: 13.214px;
flex-shrink: 0;
color: var(--black-color);
border-radius: 132.143px;
background: var(--Yellow-Gradient, linear-gradient(158deg, #FFDE22 36.37%, #F4A700 89.58%));
box-shadow: 0 5.286px 10.571px 0 rgba(67, 39, 0, 0.20);
}

.icon-circle-event {
display: flex;
width: 37px;
height: 37px;
padding: 11.893px 9.25px;
flex-direction: column;
justify-content: center;
align-items: center;
gap: 13.214px;
flex-shrink: 0;
color: var(--black-color);
border-radius: 132.143px;
background: var(--Orange-Gradient, linear-gradient(0deg, #F69000 0%, #F8BA0C 100%));
box-shadow: 0 5.286px 10.571px 0 rgba(67, 39, 0, 0.20);
}

.icon-tambah-tutor{
  width: 24px;
  height: 24px;
  aspect-ratio: 1/1;
  color: var(--black);
}


.card{
  display: flex;
  width: auto;
  height: auto;
  padding: 24px 0;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  border-radius: 10px;
  background: var(--white, #FFF);
  box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
}

.icon-text{
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 4px;
}

.icon-text h6{
  margin: 0 !important;
}

.total-icon {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 2px;
  font-size: 26px;
  width: 24px;
  height: 24px;
  aspect-ratio: 1 / 1;
  color: var(--orange-color, rgba(251, 168, 52, 1));
}

/* === Table Section Container === */
.table-section {
  display: flex;
  height: calc(100% - 256px);
  padding: 24px 25px;
  flex-direction: column;
  align-items: flex-start;
  gap: 10px;
  align-self: stretch;
  border-radius: 10px;
  background: var(--white, #FFF);
  box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
  overflow-x: auto;
}

@media (max-width: 992px) {
  .table-section {
    width: 100%;
    border-radius: 0;
    box-shadow: none;
  }
}

/* === Title Section === */
.title-section {
  display: flex;
  align-items: center;
  gap: 4px;
}

.title-section h6 {
  color: var(--Black, #1B1B1B);
  font-size: 18px;
  font-weight: 400;
  margin: 0 !important;
}

/* === Divider === */
.title-divider {
  border: none;
  border-top: 3px solid #F9EEDB;
  margin: 8px 0;
  width: 100%;
  opacity: 1;
  border-radius: 4px;
}

.tabs-container {
  width: 100%;
  display: flex;
  padding: 0 160px;
  justify-content: space-between;
  align-items: flex-start;
  align-self: stretch;
}

.tab-list {
  width:100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}








  </style>
</body>
</html>
