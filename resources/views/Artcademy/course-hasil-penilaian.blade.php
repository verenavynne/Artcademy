@extends('layouts.master')

@section('content')
@if (session('info'))
    <div class="alert alert-warning mt-3">{{ session('info') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    
    <div class="navigation-prev d-flex flex-start mt-1">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>
        
    <div class="d-flex flex-row justify-content-center gap-5">
        <div class="d-flex flex-column" style="width: 60%">
            <div class="d-flex flex-column pb-4">
                <p class="title text-start fw-bold">Hasil Projek Akhir</p>
                <p class="projek-title-desc">Inilah hasil karya kerennya kamu! Dari ide, jadi nyata. Keren kan!</p>
            </div>
            <div class="hasil-projek-submission-card d-flex flex-column">
                <div class="row">
                    <img class="col-md-4 projek-thumbnail" src="{{ asset('storage/' . $submission->projectSubmissionThumbnail) }}" alt="Project thumbnail" height="205" width="205">
                    <div class="col mb-3">
                        <div class="col mb-3">
                            <label for="" class="form-label">Judul Projek</label>
                            <input type="text" id="projectTitle" name="title" 
                                    class="form-control rounded-pill" 
                                    value="{{ $submission->projectSubmissionName }}" 
                                    disabled>
                        </div>

                        <div class="col">
                            <label class="form-label fw-semibold">Link Projek</label>
                            <div class="position-relative d-flex">
                                <iconify-icon icon="material-symbols:link-rounded" class="input-icon"></iconify-icon>
                                <input type="text" id="projectLink" name="link" 
                                        class="form-control rounded-pill form-link-input" 
                                        value="{{ $submission->projectSubmissionLink }}"
                                        disabled>
                            </div>
                        </div>
                    </div>
                    <div class={{ $allTutorsGraded ? 'mb-4' : '' }}>
                        <label class="form-label">Deskripsi Projek</label>
                        <textarea id="projectDesc" name="description" rows="4" 
                                class="form-control description rounded-4" disabled
                                >{{ $submission->projectSubmissionDesc }}</textarea>
                       
                    </div>

                    @if($allTutorsGraded)
                        <form action="{{ route('add.to.portfolio', $submission->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-100 px-4 py-2 text-white pink-cream-btn">
                                <p class="text-pink-gradient" style="margin: 0">Masukkan ke Portofolio</p>
                            </button>
                        </form>
                    @endif
                </div>

            </div>

            <hr class="divider">

            <div class="penilaian-tutor-section d-flex flex-column">
                <p class="title text-start fw-bold">Penilaian dari Tutor</p>
                <p class="projek-title-desc mb-3">Yuk, intip komentar dan nilai dari tutor yang udah liat karya kerennya kamu!</p>
                <div class="penilaian-tutor-card-section d-flex flex-row gap-3 flex-wrap">
                    @foreach ($tutors as $tutor)
                        <div class="penilaian-tutor-card d-flex flex-column">
                            <div class="penilaian-tutor-header d-flex flex-column">
                                <div class="penilaian-tutor-profile d-flex flex-row gap-2">
                                    <img src="{{ asset($tutor['photo']) }}"
                                        class="tutor-picture" alt="tutor profile" height="37" width="37">
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="tutor-name">{{ $tutor['name'] }}</p>
                                        <p class="tutor-specialization">{{ $tutor['specialization'] }}</p>
                                    </div>
                                </div>

                                <hr class="projek-divider">

                                <div class="tutor-criteria-list d-flex flex-column" style="gap: 8px;">

                                     @forelse ($tutor['grades'] as $grade)
                                        
                                        <div class="tutor-criteria d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex flex-row align-items-center gap-1">
                                                <img src="{{ asset('assets/criteria/' . $grade['icon']) }}" alt="" width="16" height="16">
                                                <p class="criteria-name">{{ $grade['criteria'] }}</p>
                                            </div>
                                            <p class="criteria-grade">{{ $grade['score'] }}</p>
                                        </div>
                                    @empty
                                        <div class="no-grade-container d-flex flex-row justify-content-center align-items-center gap-1">
                                            <img src="{{ asset('assets/icons/icon_clock_gradient.svg') }}" alt="clock icon" weight="16" height="16">
                                            <p class="no-grade-text">Menunggu penilaian</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="penilaian-tutor-comment d-flex flex-column mt-2">
                                <p class="tutor-komentar-title">Komentar:</p>
                                <p class="tutor-komentar">{{ $tutor['comment'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="width: 40%;">
            <div class="nilai-projek-card d-flex flex-column" style="gap: 20px">
                <p class="title text-start fw-bold">Nilai Projek Akhir</p>
                <hr class="projek-divider nilai">
                <div class="nilai-projek-criteria-list d-flex flex-column" style="gap: 12px;">
                    @foreach ($criteriaScores as $criteria)
                        <div class="nilai-projek-criteria d-flex flex-row justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center gap-2">
                                <img src="{{ asset('assets/criteria/' . $criteria['icon']) }}" alt="" width="24" height="24">
                                <p class="nilai-name">{{ $criteria['name'] }}</p>
                            </div>
                            <p class="nilai-grade">{{ $criteria['average'] }} </p>
                        </div>
                    @endforeach

                </div>
                <hr class="projek-divider nilai">
                <div class="nilai-total d-flex flex-row justify-content-between align-items-center">
                    <p class="nilai-name">Total</p>
                    <p class="nilai-grade">{{ $totalScore }}</p>

                </div>

                @if ($allTutorsGraded)
                    <a href="{{ route('certificate.generate', $courseId) }}" class="btn px-4 yellow-gradient-btn text-dark" >
                        Klaim Sertifikatmu
                    </a>
                @else
                    <button class="btn px-4 py-2 tunggu-nilai-btn text-dark" >
                        <img src="{{ asset('assets/icons/icon_clock_disabled.svg') }}" alt="" height="24" width="24">
                        <p>Menunggu penilaian</p>
                    </button>
                @endif
            </div>

        </div>
        
    </div>
</div>

<style>

    .form-control:disabled{
        background-color: unset;
    }

    .title{
        margin-block-end: 0;
    }

    .projek-title-desc{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);
    }

    .projek-thumbnail{
        border-radius: 20%;
        object-fit: cover;
        border: 2px dashed var(--orange-gradient-color);
    }

    .hasil-projek-submission-card{
        background: white;
        border-radius: 40px;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        gap: 16px;
        padding-block: 40px;
        padding-inline: 38px;
    }


    .tutor-picture{
        border-radius: 50%;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        object-fit: cover;
    }
    
    .penilaian-tutor-card{
        border-radius: 40px;
        background: var(--cream2-color);
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        min-height: 314px;
        width: 258px;
    }

    .penilaian-tutor-header{
        padding: 20px;
        border-radius: 40px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        height: max-content;
    }

    .tutor-komentar-title,
    .criteria-grade,
    .tutor-name{
        margin: 0;
        font-size: var(--font-size-tiny);
        color: var(--dark-gray-color);
        font-weight: 700;
    }

    .tutor-komentar,
    .criteria-name,
    .tutor-specialization{
        margin: 0;
        font-size: var(--font-size-mini);
        color: var(--dark-gray-color);
    }

    .projek-divider{
        border: none;
        height: 1px;
        background-color: var(--orange-color);
        border-radius: 2px;
        margin-block: 0.8rem;
    }

    .projek-divider.nilai{
        height: 3px;
        margin-block: 0.5rem;
    }

    .penilaian-tutor-comment{
        padding: 20px;
        gap: 8px;
    }

    .nilai-projek-card{
        padding: 32px 26px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        border-radius: 44px;
        width: 439px;
        height: max-content;
    }

    .nilai-name,
    .nilai-grade{
        margin: 0;
        color: var(--dark-gray-color);
        font-size: var(--font-size-primary);
    }

    .nilai-grade{
        font-weight: 700;
    }

    .no-grade-text{
        margin: 0;
        font-size: var(--font-size-tiny); 
        background: var(--orange-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .no-grade-container{
        min-height: 80px;
    }

    .tunggu-nilai-btn{
        display: flex;
        gap: 10px;
        border-radius: 100px;
        background: rgba(208, 208, 208, 1);
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .tunggu-nilai-btn p{
        margin: 0;
        font-size: var(--font-size-primary);
        color: #8F8F8F;
    }

</style>

@endsection