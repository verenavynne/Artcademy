<div class="projek-progress-card d-flex flex-column">
    <p class="projek-title">Projek Akhir</p>
    <div class="d-flex flex-row align-items-center" style="gap: 12px">
        <div class="progress w-100" style="height: 6px; background-color: #E5E5E5;">
            <div class="progress-bar" role="progressbar" 
            style="width: {{ $isSubmitted ? 100 : 0 }}%; background-color: #E92D62;">
            </div>
        </div>
        <p class="progress-percentage">{{ $isSubmitted ? 100 : 0 }}%</p>
    </div>

    <div class="projek-list-content d-flex flex-row justify-content-between align-items-center">
        <div class="projek-number-name d-flex flex-row align-items-center">
            <div class="projek-number">
                <p>1</p>
            </div>

            <div class="projek-name-title d-flex flex-column">
                <p class="projek-name">Kumpul Projek Akhir</p>
                <div class="d-flex flex-row align-items-center" style="gap: 4px">
                    <iconify-icon class="projek-calender-icon" icon="tabler:calendar-week-filled"></iconify-icon>
                    @if($submission->deadlineSubmission)
                        <p class="projek-date">
                            {{ $submission->deadlineSubmission->translatedFormat('d F Y') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>

        <input id="projekCheckbox" 
            class="projek-checkbox form-check-input" 
            type="checkbox" 
            style="pointer-events: none;" 
            {{ $isSubmitted ? 'checked' : '' }}
            >

    </div>

    @if($isSubmitted)
        <form action="{{ route('projectSubmission.hasil', ['id'=> $submission->id]) }}"
            method="GET"
            id="hasilPenilaianForm">
            <button type="submit" id="lihatPenilaianBtn" class="btn text-dark yellow-gradient-btn px-4 d-flex align-items-center justify-content-center gap-2 w-100">
                <div id="loadingSpinnerPenilaian" class="spinner-border spinner-border-sm text-dark d-none"></div>
                <span id="btnTextPenilaian">Lihat Penilaian</span>
            </button>
        </form>
    @else
        <button type="submit"
            id="kumpulBtn"
            class="btn w-100 text-dark yellow-gradient-btn  {{ $isDisabled ? 'disabled' : '' }}"
            aria-disabled="{{ $isDisabled ? 'true' : 'false' }}"
            >
            <div id="loadingSpinnerProject" class="spinner-border spinner-border-sm text-dark d-none"></div>
            <span id="btnTextProject">Kumpul Sekarang</span>
        </button>
    @endif

</div>

<style>

    .projek-checkbox:checked{
        border: none !important;
    }

    .projek-progress-card{
        display: flex;
        width: 439px;
        height: max-content;
        padding: 32px 30px;
        justify-content: center;
        border-radius: 44px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        gap: 28px;

        position: sticky !important;
        top: 108px !important;
        z-index: 10 !important;   
        align-self: flex-start;
        height: auto !important;
    }

    .projek-title{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--black-color);
        font-weight: 700;
    }

    .projek-list-content{
        padding-inline: 5px;
        gap: 25px;
    }

    .progress-percentage{
        margin: 0;
        color: var(--black-color);
        font-size: var(--font-size-primary);
    }

    .projek-number-name{
        gap: 20px;
    }

    .projek-number p{
        margin: 0;
    }

    .projek-number{
        display: flex; 
        align-items: center; 
        justify-content: center;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        background: var(--yellow-gradient-color);
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        font-weight: 700;
        align-items: center;
        justify-content: center; 
    }

    .projek-name-title{
        gap: 4px;
    }

    .projek-name{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);
    }

    .projek-date{
        margin: 0;
        font-size: var(--font-size-tiny);
        color: var(--dark-gray-color);
    }


    .projek-calender-icon{
        font-size: 16px
    }

    .form-check-input{
        width: 24px;
        height: 24px;
        border-radius: 10px;
        border-color: 1px var(--dark-gray-color)
    }

    .form-check-input:checked {
        background: var(--orange-gradient-color);
        border-color: var(--orange-gradient-color);
        position: relative;
    }

    .form-check-input:checked::after {
        content: "";
        position: absolute;
        top: 5px;
        left: 9px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .yellow-gradient-btn.disabled{
        background: #D0D0D0;
    }
</style>

<script>
    const form = document.getElementById('hasilPenilaianForm');
    const submitBtn = document.getElementById('lihatPenilaianBtn');
    const btnText = document.getElementById('btnTextPenilaian');
    const loadingSpinner = document.getElementById('loadingSpinnerPenilaian');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;

        btnText.textContent = 'Memproses...';
        loadingSpinner.classList.remove('d-none');
    });
</script>