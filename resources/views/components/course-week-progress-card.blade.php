@php
    $totalMateri = $week->materials->count();
    $totalMateriDone = collect($materiProgress)->where('isDone', true)->count();

@endphp


<div class="course-week-progress-card d-flex flex-column" data-total="{{ $totalMateri }}" data-done="{{ $totalMateriDone }}">
    <p class="course-week-title">{{ $week->weekName }}</p>

    <div class="d-flex flex-row align-items-center" style="gap: 12px">
        <div class="progress w-100" style="height: 6px; background-color: #E5E5E5;">
            <div class="progress-bar" role="progressbar" 
               style="width: {{ $progressPercent }}%; background-color: #E92D62;">
            </div>
        </div>
        <p class="progress-percentage">{{ $progressPercent }}%</p>
    </div>


    <div class="course-progress-materi-lists d-flex flex-column">
        @foreach ($week->materials as $materiItem)
            @php
                $isDone = $materiProgress[$materiItem->id]->isDone ?? false;
                $isDisabled = !$isDone && $materiItem->id !== $firstUndoneId;
                
            @endphp

            <div class="progress-materi-list-content d-flex flex-row justify-content-between align-items-center"
                 aria-disabled="{{ $isDisabled ? 'true' : 'false' }}">
                <div class="progress-number-name d-flex flex-row align-items-center">
                    <div class="progress-materi-number {{ $isDisabled ? 'disabled' : '' }}">
                        @if ($isDisabled)
                            <iconify-icon class="lock-icon" icon="tabler:lock-filled"></iconify-icon>
                        @else
                            <p>{{ $loop->iteration }}</p>
                        @endif
                    </div>

                    <div class="progress-materi-name-duration d-flex flex-column">
                        <p class="progress-materi-name">{{ $materiItem->vblName ?? $materiItem->articleName }}</p>
                        <div class="d-flex flex-row align-items-center" style="gap: 4px">
                            <iconify-icon class="vbl-article-icon" icon="{{ $materiItem->vblName ? 'mingcute:video-line' : 'heroicons-outline:newspaper' }}"></iconify-icon>
                            <p class="progress-duration">{{ $materiItem->duration ?? '—' }} menit</p>
                        </div>
                    </div>
                </div>

                <input id="materiCheckbox" 
                class="form-check-input materi-checkbox" 
                type="checkbox" 
                data-materi-id="{{ $materiItem->id }}" 
                style="pointer-events: none;" {{ $isDone ? 'checked' : '' }}
                >
            </div>
        @endforeach
    </div>

    <form action="{{ route('materi.complete', $materi->id) }}" method="POST" id="completeForm">
        @csrf
       
        <button type="submit"
                id="lanjutkanBtn"
                class="btn w-100 text-dark yellow-gradient-btn {{ $isDisabled ? 'disabled' : '' }}"
                aria-disabled="{{ $isDisabled ? 'true' : 'false' }}">
            {{ $navigationData['buttonText'] }}
        </button>
    </form>

    
</div>


<style>
    .course-week-progress-card{
        display: flex;
        width: 439px;
        height: max-content;
        padding: 32px 30px;
        justify-content: center;
        border-radius: 44px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        gap: 28px;
    }

    .course-week-title{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--black-color);
        font-weight: 700;
    }

    .course-progress-materi-lists{
        gap: 25px;
        padding-inline: 5px;
    }

    .progress-percentage{
        margin: 0;
        color: var(--black-color);
        font-size: var(--font-size-primary);
    }

    .progress-number-name{
        gap: 20px;
    }

    .progress-materi-number{
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

    .progress-materi-number.disabled{
        background: #D0D0D0;

    }

    .progress-materi-number p{
        margin: 0;
    }

    .progress-materi-name-duration{
        gap: 4px;
    }

    .progress-materi-name{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);
    }

    .progress-duration{
        margin: 0;
        font-size: var(--font-size-tiny);
        color: var(--dark-gray-color);
    }

    .vbl-article-icon{
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
        top: 3px;
        left: 9px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .lock-icon{
        font-size: 18px;
    }

    .yellow-gradient-btn.disabled{
        background: #D0D0D0;
    }

</style>

