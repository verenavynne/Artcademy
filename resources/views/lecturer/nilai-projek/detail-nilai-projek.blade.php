@extends('layouts.master-tutor')
@include('styles.style')

@section('content')
<div class="container-content" style="gap : 24px;">
    <div class="nilai-projek-title d-flex justify-content-start align-items-center sticky-top">
        <div class="navigation-prev d-flex flex-start">
            <a class="page-link" href="#" onclick="window.history.back()">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </a>
        </div>

        <h4 class="fw-semibold" style="font-size: 32px; margin: 0; color: var(--black-color);">Nilai Projek</h4>
    </div>

    <div class="warning-info row align-center justify-content-start">
        <iconify-icon icon="material-symbols:info-outline-rounded" class="total-icon-tutor"></iconify-icon>
        <p class="warning-info-text"style="margin: 0;">Nilai projek sebelum <b>17 Juli 2025</b> agar siswa bisa segera klaim sertifikat</p>
    </div>

    @include('components.course-project-card')

    <!-- Ini nanti di import -->
    <div style="display: none">
        <p>include('Artcademy.course-hasil-penilaian')</p>
    </div>

    <div class="nilai-projek-container">
        <h2>Nilai Projek</h2>

        <div class="nilai-row">
            <div class="nilai-item">
                <label>Kreativitas <span style="color: #939393;">(50%)</span></label>
                <div class="select-box">
                    <select>
                        <option>0</option>
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                        <option>40</option>
                        <option>50</option>
                    </select>
                </div>
            </div>

            <div class="nilai-item">
                <label>Keterbacaan <span>(20%)</span></label>
                <div class="select-box">
                    <select>
                        <option>0</option>
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                    </select>
                </div>
            </div>

            <div class="nilai-item">
                <label>Kesesuaian Tema <span>(30%)</span></label>
                <div class="select-box">
                    <select>
                        <option>0</option>
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                    </select>
                </div>
            </div>
        </div>

        <label class="komentar-label">Komentar <span style="color: #939393;">(Optional)</span></label>
        <textarea class="komentar-box" placeholder="Berikan komentar, kritik, atau saran untuk hasil karya siswa..."></textarea>
    </div>

    <div class="button-container">
        <button class= "pink-cream-btn" style="width: 170px;">Simpan Draft</button>
        <button class= "disabled-btn" style="width: 170px;">Kirim Penilaian</button>
    </div>



</div>
@endsection

<style>

.container-content {
    overflow-y: scroll;
    overflow-x: hidden;
    scrollbar-width: thin;
}

.nilai-projek-title {
    background: var(--cream-color);
}

.nilai-projek-container{
    display: flex;
    padding: 40px 38px;
    flex-direction: column;
    align-items: flex-start;
    gap: 16px;
    margin: 0 6px;
    align-self: stretch;
    border-radius: 40px;
    background: var(--white, #FFF);

    /* drop shadow brown */
    box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
}

.nilai-projek-container h2{
    align-self: stretch;
    color: var(--Black, #1B1B1B);
    font-family: Afacad;
    font-size: 20px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
}

.nilai-row{
    display: flex;
    align-items: flex-start;
    gap: 16px;
    align-self: stretch;
}

.nilai-item{
    display: flex;
    height: 90px;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    flex: 1 0 0;
}

.nilai-item label{
    align-self: stretch;
    color: var(--dark-gray-color);
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.select-box{
    display: flex;
    height: 56px;
    padding: 10px 30px;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0;
    align-self: stretch;
    border-radius: 1000px;
    background: var(--very-light-grey, #FAFAFA);

    /* drop shadow brown */
    box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
}

.select-box select{
    border: none;
    background: none;
    width: 100%;
}

.komentar-label{
    color: var(--dark-gray-color);
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.komentar-box{
    display: flex;
    height: 105px;
    padding: 20px 30px;
    justify-content: space-between;
    align-items: flex-start;
    align-self: stretch;
    border-radius: 20px;
    background: var(--very-light-grey, #FAFAFA);

    /* drop shadow brown */
    box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
    border: none;
}

textarea::placeholder{
    color: var(--Disabled-Text, #A8A7A4);
    font-family: Afacad;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.button-container{
    display: flex;
    align-items: flex-start;
    gap: 22px;
    justify-content: flex-end;
}
</style>