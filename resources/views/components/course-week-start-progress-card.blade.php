@php
    $weekProg = $weekProgress[$week->id] ?? null;
    $isUnlocked = $weekProg?->status === 'unlocked';
    $progressPercent = $weekProg?->progress ?? 0;

    $buttonText = 'Mulai belajar';

    if ($weekProg->progress == 0) {
        $buttonText = 'Mulai belajar';
    } 
    else if ($weekProg->progress < 100) {
        $buttonText = 'Lanjutkan';
    }
@endphp

<div class="course-week-start-progress-card d-flex flex-column">
    <p class="course-week-title">{{ $week->weekName }}</p>

    <div class="d-flex flex-row align-items-center" style="gap: 12px">

        <div class="progress w-100" style="height: 6px; background-color: #E5E5E5;">
            <div class="progress-bar" role="progressbar" 
               style="width: {{ $progressPercent }}%; background-color: #E92D62;">
            </div>
        </div>
    
        <p class="progress-percentage">{{ $progressPercent }}%</p>
    </div>


    <div class="course-materi-lists d-flex flex-column">
        @foreach ($week->materials as $materi)
            @php
                $materiDone = $materiProgress[$materi->id]->isDone ?? false;
            @endphp
            <div class="materi-lists d-flex flex-row">
                <div class="materi-list-title d-flex flex-row">
                    @if ($materi->tblName === null && $materi->vblName !== null)
                        <iconify-icon icon="mingcute:video-line"></iconify-icon>
                        <p>{{ $materi->vblName }}</p>
                    @elseif ($materi->vblName === null && $materi->tblName !== null)
                        <iconify-icon icon="heroicons-outline:newspaper"></iconify-icon>
                        <p>{{ $materi->tblName }}</p>
                    @endif
                </div>
                <p class="materi-list-duration">{{ $materi->duration }} menit</p>
            </div>
        @endforeach
        
    </div>
    @if($allWeeksCompleted)
        <a href="{{ route('course.project', $course->id) }}" >
            <button type="submit" class="btn w-100 text-dark yellow-gradient-btn">
                Lihat Projek Akhir
            </button>

        </a>
    @else
        <a href="{{ route('course.startWeek', $course->id) }}" >
            <button type="submit" class="btn w-100 text-dark yellow-gradient-btn">
                {{ $buttonText }}
            </button>

        </a>
    @endif
</div>

<style>
    .course-week-start-progress-card{
        display: flex;
        width: 439px;
        height: max-content;
        padding: 32px 30px;
        justify-content: center;
        border-radius: 44px;
        background: white;
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
        gap: 28px;
    }

    .course-week-title{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--black-color);
        font-weight: 700;
    }

    .course-materi-lists {
        gap: 25px;
        padding-inline: 5px;
    }

    .materi-lists p{ 
        margin: 0;
    }

    .materi-lists{
        justify-content: space-between;
    }

    .materi-list-title{
        gap: 20px;
    }

    .materi-list-title p{
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        max-width: 215px;
    }

    .progress-percentage{
        margin: 0;
        color: var(--black-color);
        font-size: var(--font-size-primary);
    }
</style>
