@extends('layouts.master-tutor')
@include('styles.style')

@section('content')
<div class="container-content" style="gap : 24px;">
    <div class="nilai-projek-title d-flex justify-content-start align-items-center">
        <div class="navigation-prev d-flex flex-start">
            <a class="page-link" href="#" onclick="window.history.back()">
                <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
            </a>
        </div>

        <h4 class="fw-semibold" style="font-size: 32px; margin: 0; color: var(--black-color);">Nilai Projek</h4>
    </div>

    <div class="warning-info row align-center justify-content-start">
        <iconify-icon icon="material-symbols:info-outline-rounded" class="total-icon-tutor"></iconify-icon>
        <p class="warning-info-text"style="margin: 0;">Nilai projek sebelum <b>{{ $project->created_at->addDays(7)->format('d M Y') }}</b> agar siswa bisa segera klaim sertifikat</p>
    </div>

    @include('components.course-project-card')

    <div class="hasil-projek-submission-card d-flex flex-column">
        <h5>Projek {{ $projectSubmission->student->user->name }}</h5>

        <div class="row">
            <div class="col-md-3">
                <img 
                    class="projek-thumbnail" 
                    src="{{ asset('storage/' . $projectSubmission->projectSubmissionThumbnail) }}" 
                    alt="Project thumbnail"
                    height="205"
                    width="205"
                    style="object-fit: cover; border-radius: 20px;"
                >
            </div>

            <div class="col-md-9"  style="margin-left: -20px;">
                <div class="mb-3">
                    <label class="form-label">Judul Projek</label>
                    <input 
                        type="text" 
                        class="form-control rounded-pill"
                        value="{{ $projectSubmission->projectSubmissionName }}"
                        disabled
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Link Projek</label>
                    <div class="position-relative d-flex">
                        <iconify-icon icon="material-symbols:link-rounded" class="input-icon"></iconify-icon>
                        <input 
                            type="text" 
                            class="form-control rounded-pill form-link-input" 
                            value="{{ $projectSubmission->projectSubmissionLink }}"
                            disabled
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <label class="form-label">Deskripsi Projek</label>
            <textarea 
                rows="4" 
                class="form-control description rounded-4" 
                disabled
            >{{ $projectSubmission->projectSubmissionDesc }}</textarea>
        </div>
    </div>

    <form action="{{ route('lecturer.nilai-projek.send', $projectSubmission->id) }}" method="POST">
        @csrf

        <div class="nilai-projek-container">
            <h2>Nilai Projek</h2>

            <div class="nilai-row">

                @foreach ($projectCriterias as $pc)
                    <div class="nilai-item">
                        <label>
                            {{ $pc->criteria->criteriaName }} 
                            <span style="color: #939393;">({{ $pc->customWeight }}%)</span>
                        </label>

                        <div class="select-box">
                            <select name="scores[{{ $pc->id }}]">
                                @for ($i = 0; $i <= 100; $i += 10)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                @endforeach

            </div>

            <label class="komentar-label">Komentar <span style="color: #939393;">(Optional)</span></label>
            <textarea 
                name="comment"
                id="commentBox"
                class="komentar-box"
                placeholder="Berikan komentar, kritik, atau saran untuk hasil karya siswa..."
            ></textarea>

        </div>

        <div class="button-container mt-4">
            <button class="yellow-gradient-btn" id="submitBtn" style="width: 170px;" disabled>Kirim Penilaian</button>
        </div>
    </form>

</div>

<script>
    const commentBox = document.getElementById('commentBox');
    const submitBtn = document.getElementById('submitBtn');

    commentBox.addEventListener('input', () => {
        submitBtn.disabled = commentBox.value.trim() === '';
    });
</script>

<style>

.container-content {
    overflow-y: scroll;
    overflow-x: hidden;
    scrollbar-width: thin;
}

.hasil-projek-submission-card{
    background: white;
    border-radius: 40px;
    box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
    gap: 16px;
    padding-block: 40px;
    padding-inline: 38px;
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

.yellow-gradient-btn:disabled {
    background: #D0D0D0;
    cursor: not-allowed;
    color: #8F8F8F;
}
</style>

@endsection