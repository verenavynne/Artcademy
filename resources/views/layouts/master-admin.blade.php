<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artcademy Admin Panel</title>

  @include('custom.bootstrap')
  @include('styles.style')
  @include('styles.table-admin')

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>
  <!-- Navbar tetap di luar -->
<div class="container-fluid ps-4 pe-4">
<header>
    @include('layouts.navbar-admin')
  </header>

  <!-- Wrapper utama berisi sidebar dan konten -->
  <div class="d-flex" id="admin-wrapper">
    
    <!-- Sidebar -->
    @include('layouts.menu-admin')

    <!-- Konten utama (Dashboard, Cards, Table, dsb) -->
    <main class="flex-grow-1" id="admin-content">
      <div class="dashboard-wrapper">
        @yield('content')
      </div>
    </main>
  </div>
   </div>
  

  <!-- Footer di bawah semua -->
  <footer>
    @include('layouts.footer-admin')
  </footer>
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
    }

  .container-fluid{
    padding-right: 0px;
    padding-left: 28px;
  }
  </style>
</body>
</html>
