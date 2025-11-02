@extends('layouts.master')

@section('content')
<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    <div class="navigation-prev d-flex flex-start pb-4">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-center gap-5">
        <div class="d-flex flex-column" style="width: 60%;">
            <div class="article-content-container d-flex flex-column">
                <p class="article-name">{{ $materi->articleName }}</p>
                <p class="article-text">{{ $materi->articleText }}</p>
                <p class="article-text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat sit adipisci, dolorem impedit labore architecto consectetur facilis unde eum iure quo minus asperiores fuga quas repellat, voluptates corporis, repellendus sed.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro rem incidunt ratione harum, nulla distinctio explicabo! Odit illum nesciunt ipsa repellendus, vel harum sequi cum, eum recusandae eligendi deserunt facere.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor tempora consequatur animi fugiat iusto quasi veniam natus sunt eius. Ex minima ipsam, saepe eveniet dolor esse explicabo accusantium culpa magnam.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta doloremque adipisci deserunt provident libero esse minus nemo labore porro, eius nihil sint. Nisi modi blanditiis debitis laborum architecto veniam delectus.
                </p>
                <!-- TODO ambil articleText pake cara !!$article->articleText !! -->
        
                <div class="tandai-baca-article-btn d-flex justify-content-end">
                    <button 
                        id="tandai-sudah-baca-btn"  
                        data-materi-id="{{ $materi->id }}" 
                        class="btn px-4 py-2 text-dark btn-tandai-baca">
                        Tandai Sudah Dibaca
                    </button>

                    <button 
                        class="btn px-4 py-2 text-white btn-sudah-baca d-none"
                        style="pointer-events: none;">
                        <img src="{{ asset('assets/icons/icon_sudah_dibaca.svg') }}" alt="checklist-icon" width="19" height="19">
                        <p>Sudah Dibaca</p>
                    </button>

                </div>
            </div>

        </div>


        <div class="d-flex justify-content-center" style="width: 40%">
            @include('components.course-week-progress-card', [
                'week' => $week,
                'weekProgress' => $weekProgress,
                'materiProgress' => $materiProgress,
                'isUnlocked' => $isUnlocked
            ])

        </div>
    </div>

</div>

<style>
    .article-name{
        margin: 0;
        font-size: var(--font-size-big);
        color: var(--black-color);
        font-weight: 700;
    }

    .article-text{
        margin: 0;
        font-size: var(--font-size-big);
        color: var(--black-color);
        font-weight: 400;
    }

    .tandai-baca-article-btn{
        margin-block-start: 22px;
    }

    .btn-tandai-baca {
        background: var(--pink-medium-gradient-color);
        border: none;
        border-radius: 50rem;
        padding: 12px 0;
        box-shadow: 0px 4px 8px 0px var(--brown-shadow-color);
        transition: all 0.3s ease;
        font-size: var(--font-size-primary);
    }

    .btn-tandai-baca:hover {
        opacity: 0.7;
    }

    .btn-sudah-baca{
        background: var(--cream2-color);
        color: transparent;
        border: none;
        border-radius: 50rem;
        padding: 12px 0;
        box-shadow: 0px 4px 8px 0px var(--brown-shadow-color);
        transition: all 0.3s ease;
        font-size: var(--font-size-primary);
        align-items: center;
        position: relative;
        display: flex;
        flex-direction: flex-row;
        gap: 10px;

    }

    .btn-sudah-baca p{
        margin: 0; 
        font-size: var(--font-size-primary);
        background: var(--pink-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;

    }

    .btn-sudah-baca::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 100px;
        padding: 2px;
        background: var(--pink-gradient-color);
        -webkit-mask:
            linear-gradient(#fff 0 0) content-box,
            linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
                mask-composite: exclude;
        pointer-events: none;
    }
    
</style>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const markAsReadBtn = document.getElementById('tandai-sudah-baca-btn');
    const checkbox = document.getElementById('materiCheckbox');
    const lanjutkanBtn = document.getElementById('lanjutkanBtn');
    
    if (!markAsReadBtn || !lanjutkanBtn) return; 
    
    markAsReadBtn.addEventListener('click', function () {
        console.log('vynn')
        const materiId = this.dataset.materiId;
        const checkbox = document.querySelector(`.materi-checkbox[data-materi-id="${materiId}"]`);
        if (!checkbox) return;

    
        checkbox.checked = true;
        toggleButton(true);

    
    })

    function toggleButton(isChecked) {
        if (isChecked) {
            lanjutkanBtn.classList.remove('disabled');
            lanjutkanBtn.setAttribute('aria-disabled', 'false');
            lanjutkanBtn.style.pointerEvents = 'auto';
            lanjutkanBtn.style.opacity = '1';
        } else {
            lanjutkanBtn.classList.add('disabled');
            lanjutkanBtn.setAttribute('aria-disabled', 'true');
            lanjutkanBtn.style.pointerEvents = 'none';
            lanjutkanBtn.style.opacity = '0.5';
        }
    }

     document.querySelectorAll('.btn-tandai-baca').forEach(button => {
        button.addEventListener('click', async function () {
            const materiId = this.dataset.materiId;

            const parent = this.closest('.tandai-baca-article-btn');
            const btnSudahBaca = parent.querySelector('.btn-sudah-baca');

            this.classList.add('d-none');
            btnSudahBaca.classList.remove('d-none');
        });
    });
});
</script>
