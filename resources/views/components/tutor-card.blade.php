<div class="tutor-card d-flex flex-row">
    <img class="tutor-profile-image" src="{{ asset('assets/course/default_tutor_profile.png') }}" alt="Tutor Profile Icon" style="">
    <div class="tutor-info-container d-flex flex-column justify-content-center">
        <div class="d-flex flex-column" style="padding-block-end: 9px">
            <p class="tutor-name fw-bold">{{ $tutor->lecturer->user->name }}</p>
            <p class="tutor-info">{{ $tutor->lecturer->specialization }}</p>

        </div>
        <div class="d-flex flex-row gap-1 align-items-center">
            <img src="{{ asset('assets/icons/icon_suitcase.svg') }}" alt="Arrow Icon" width="18" height="18" style="">
            <p class="tutor-info">5 tahun</p>
        </div>
    </div>
        <img src="{{ asset('assets/logo/logo_linkedin.png') }}" alt="Linkedin logo" width="33" height="33" style="">
</div>