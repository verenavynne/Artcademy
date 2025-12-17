<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artcademy</title>

  @include('custom.library')
  @include('styles.style')
  @include('styles.table-admin')
  @include('styles.nilai-projek-card')
  @include('styles.admin-tutor-layoutscroll')
  @include('styles.form-style')
  @include('styles.zoom-card')
  @include('styles.course-card')
  @include('styles.tutor-card')
  @include('styles.testimoni-card')
  
  <link rel="icon" type="image/png" href="{{ asset('assets/artcademy-icon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>
  <div class="container-fluid p-0">
    <header class="sticky-top" style="z-index: 2000;">
      @include('layouts.navbar-admin-tutor')
    </header>

      <!-- Wrapper utama berisi sidebar dan konten -->
      <div class="d-flex" id="tutor-wrapper">
          <!-- Sidebar -->

          <!-- Hide buat forum page -->
          @unless (View::hasSection('hide_sidebar'))
              @include('layouts.menu-tutor')
          @endunless

        <!-- Konten utama (Dashboard, Cards, Table, dsb) -->
        @yield('content')

        @include('profile.components.popup-logout')
      </div>

      
      @unless (View::hasSection('hide_footer'))
          @include('layouts.footer-tutor')
      @endunless
    </div>
</body>


<style>
  body {
    font-family: 'Afacad', sans-serif;
    background-color: #FFF9EF;
    min-height: 100vh;
  }

  #tutor-sidebar {
    width: 250px;
    min-height: 100vh;
    border-right: 1px solid #eee;
  }

  #tutor-wrapper {
    display: flex;
    align-items: flex-start;
    height: auto;
    padding-bottom: 24px;
    padding-top: 12px;
    padding-left: 34px;
    padding-right: 34px;
  }

  .row {
    --bs-gutter-x: 0 ;
    gap: 24px;
    flex-wrap: nowrap;
  }

  .icon-tambah-tutor{
    width: 24px;
    height: 24px;
    aspect-ratio: 1/1;
    color: var(--black);
  }


  .card-tutor{
    display: flex;
    width: auto;
    height: 100%;
    padding: 18px 24px;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    border-radius: 10px;
    background: var(--white, #FFF);
    box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
  }

  .icon-text-tutor{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 4px;
  }

  .icon-text-tutor h6{
    margin: 0 !important;
  }

  .total-icon-tutor {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 2px;
    width: 24px;
    height: 24px;
    font-size: 26px;
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

  .info-item-wrapper{
    display: flex;
    padding: 4px 5px;
    justify-content: space-between;
    align-items: center;
    border-radius: 10px;
    background: #E9F3FF;

  }

  .dashboard-card-wrapper{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    align-self: stretch;
  }

  .info-item span{
    white-space: nowrap;
  }

  .info-item{
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1 0 0;
    background: var(--Blue-Gradient, linear-gradient(149deg, #50C4ED 5.33%, #387ADF 75.32%));
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 16px;
    font-weight: 700;
  }

  .info-icon{
    color: #387ADF;
  }

  .icon-text-wrapper{
    display: flex;
    justify-content: left;
    align-items: flex-start;
    gap: 90px;
    align-self: stretch;
  }
  .dashboard-nilai-projek-card {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    align-self: stretch;
    padding: 18px 24px;
    border-radius: 10px;
    background: var(--white, #FFF);
    gap: 16px;
    box-shadow: 0 4px 8px rgba(67, 39, 0, 0.2);

    /* Biar seukuran tinggi sidebar */
    height: auto; /* bisa sesuaikan 100px tergantung header atas */
    margin-bottom: 64px;
  }

  .nilai-projek-title{
    display: flex;
    width: 100%;
    align-items: flex-start;
    gap: 12px;
  }

  .warning-info{
    display: flex;
    padding: 20px 32px;
    align-items: center;
    gap: 10px;
    margin: 0 6px;
    align-self: stretch;
    border-radius: 10px;
    background: #FFF0DF;

    /* Shadow 2 */
    box-shadow: 0 2px 10px 0 rgba(67, 39, 0, 0.20);
  }

  .warning-info-text{
    font-family: Afacad;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    background: var(--Orange-Gradient, linear-gradient(0deg, #F69000 0%, #F8BA0C 100%));
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    function autoscrollToHash() {
        const hash = window.location.hash;
        if (!hash) return;

        const el = document.querySelector(hash);
        if (!el) {
            console.log("Not on forum page, skipping autoscroll.");
            return;
        }

        const postId   = el.dataset.postId;
        const parentId = el.dataset.parentId;

        const commentToggle = document.querySelector(
            `.comment-toggle[data-target="#comment-box-${postId}"]`
        );


        if (commentToggle) {
            commentToggle.click();
        }

        if (parentId) {
            const replyToggle = document.querySelector(
                `.reply-toggle[data-target="#reply-content-${parentId}"]`
            );
            if (replyToggle) replyToggle.click();
        }

       
        setTimeout(() => {
            el.scrollIntoView({ behavior: "smooth", block: "center" });
        }, 250);
    }

    autoscrollToHash();
    
    window.addEventListener("hashchange", autoscrollToHash);
});
</script>

</html>
