<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artcademy</title>
    @include('custom.library')
    @include('styles.style')
    @include('styles.course-card')
    @include('styles.tutor-card')
    @include('styles.zoom-card')
    @include('styles.testimoni-card')
    @include('styles.custom-plyr')
    @include('styles.form-style')
    <link rel="icon" type="image/png" href="{{ asset('assets/artcademy-icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body>
    <header class="sticky-top" style="z-index: 1030;">
        @include('layouts.navbar')
    </header>
    <div class="content" style="min-height: 100vh">
        @yield('content')

        @include('profile.components.popup-logout')

    </div>
    <footer>
        @unless (View::hasSection('hide_footer'))
            @include('layouts.footer')
        @endunless
    </footer>

    
</body>

<style>
    body {
        font-family: 'Afacad', sans-serif;
        background-color: rgba(255, 249, 239, 1);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}

        function autoscrollToHash() {
        const hash = window.location.hash;
        if (!hash) return;

        const el = document.querySelector(hash);
        if (!el) return;

        const postId   = el.dataset.postId;
        const parentId = el.dataset.parentId;

        // 🔥 buka comment TANPA scroll
        const commentToggle = document.querySelector(
            `.comment-toggle[data-target="#comment-box-${postId}"]`
        );
        if (commentToggle && !commentToggle.classList.contains('active')) {
            commentToggle.click();
        }

        // 🔥 buka reply TANPA scroll
        if (parentId) {
            const replyToggle = document.querySelector(
                `.reply-toggle[data-target="#reply-content-${parentId}"]`
            );
            if (replyToggle && !replyToggle.classList.contains('active')) {
                replyToggle.click();
            }
        }

        // 🔥 scroll SEKALI setelah layout stabil
        requestAnimationFrame(() => {
            setTimeout(() => {
                el.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });
            }, 200);
        });
    }

    // 🚀 jalankan sekali
    autoscrollToHash();

    // optional kalau hash berubah manual
    window.addEventListener("hashchange", autoscrollToHash);
});
</script>

</html>