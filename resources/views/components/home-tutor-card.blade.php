<div class="tutor-card-v2 rounded-5 shadow-sm">
    <div class="p-3 d-flex justify-content-between align-items-start">
        <div class="tutor-info-v2">
            <h5 class="tutor-name-v2 fw-bold mb-0">Jane Doe</h5>
            <p class="tutor-role-v2 text-muted small mb-0">Visual Artist di ABC</p>
        </div>
        
        <a href="#" class="linkedin-icon-v2 rounded-circle d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V9.357c0-.98-.348-1.65-1.228-1.65-.658 0-1.042.482-1.218.959-.06.166-.073.376-.073.582v4.204h-2.5V5.558h2.5v1.174h.034c.355-.602.833-.99 1.9-1.053 1.298-.073 2.27 1.05 2.27 3.321v5.15H4.943zm-2.5-8.239h-2.5V3.856h2.5v.512z"/>
            </svg>
        </a>
    </div>

    <div class="tutor-image-v2 d-flex justify-content-center">
        <img src="path/to/tutor/image.png" alt="Jane Doe" style="width: 100%; height: 280px; object-fit: contain;"> 
    </div>
</div>

<style>
    /* Gaya untuk Judul (Jika belum ada dari jawaban sebelumnya) */
/* .text-pink-gradient {
    background: linear-gradient(45deg, #ff6b81, #ff99aa); 
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent; /* Fallback */
} */

/* Gaya untuk Card Tutor Versi 2 */
.tutor-card-v2 {
    width: 250px; /* Lebar card, sesuaikan jika perlu */
    height: 380px; /* Tinggi card agar seragam */
    background-color: white; /* Latar belakang card */
    border-radius: 2rem !important; /* Membuat sudut sangat melengkung (rounded-5) */
    overflow: hidden; /* Penting untuk menjaga gambar di dalam batas card */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #f0f0f0; 
}

/* Efek Hover */
.tutor-card-v2:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
}

/* Gaya untuk Icon LinkedIn */
.linkedin-icon-v2 {
    width: 30px;
    height: 30px;
    background-color: #0077b5; /* Warna biru LinkedIn */
    color: white;
    font-size: 14px;
}

.linkedin-icon-v2 svg {
    fill: currentColor; /* Agar icon SVG menggunakan warna putih */
}

/* Gaya untuk Area Gambar Tutor */
.tutor-image-v2 {
    /* Pastikan gambar mengisi sisa ruang di bawah info */
    height: calc(100% - 70px); /* Kurangi tinggi header (sekitar 70px) */
    align-items: flex-end; /* Memastikan gambar diletakkan di bagian bawah */
    overflow: hidden; /* Mengatasi jika gambar sedikit keluar */
}

/* Styling untuk container wrapper di halaman utama */
.testimoni-card {
    /* Hapus jika tidak diperlukan, tapi ini membantu jika ada padding/margin khusus */
    padding: 0;
    margin: 0;
}
</style>