<div class="modal fade" id="zoomDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 840px;">
        <div class="modal-content zoom-popup-container">

            <button type="button" class="btn-close popup-close-btn" data-bs-dismiss="modal"></button>

            <div style="padding: 48px 48px 0px 48px;">
                <div class="zoom-card-detail card d-flex w-100 flex-row mb-4" style="background:var(--orange-gradient-color); border:none;">
                    <div class="zoom-header-left d-flex flex-column justify-content-center" style="gap: 14px;">
                        <p class="zoom-title-big" id="zoomNameHeader"></p>

                        <p class="zoom-desc-small">
                            Ikuti sesi Zoom interaktif ini bersama tutor berpengalaman dan dapatkan wawasan terbaik!
                        </p>

                        <div class="course-time-container d-flex flex-row align-items-center gap-2">
                            <img src="{{ asset('assets/icons/icon_calendar.svg') }}" width="24">
                            <span class="zoom-date-white" id="zoomDateHeader"></span>
                        </div>
                    </div>

                    <div class="zoom-header-right d-flex flex-column align-items-end pt-4" style="margin-left:auto;">
                        <div class="zoom-card-detail-header d-flex flex-row gap-2" style="background:#D99F18;">
                            <div class="zoom-record-icon"></div>
                            <p style="margin:0;color:white;font-size:14px;">Kelas Zoom</p>
                        </div>

                        <img src="{{ Str::startsWith($zoom->tutor->lecturer->user->profilePicture, ['http://', 'https://']) 
                                ? $zoom->tutor->lecturer->user->profilePicture 
                                : ($zoom->tutor->lecturer->user->profilePicture 
                                ? Storage::disk('s3')->temporaryUrl($zoom->tutor->lecturer->user->profilePicture, now()->addDay())
                                : asset('assets/course/default_tutor_profile_zoom.png')) }}"
                            class="zoom-header-image">
                    </div>
                </div>
            </div>
            <div class="zoom-main-body">

                <p class="zoom-name" id="zoomName"></p>

                <div class="d-flex flex-row align-items-center" style="gap: 12px;">
                    <div class="progress" style="height: 6px; flex:1; background-color: #E5E5E5;">
                        <div class="progress-bar" id="zoomProgressBar"
                             style="background-color:#E92D62; width:100%;">
                        </div>
                    </div>

                    <p class="zoom-peserta-progress">
                        <span id="zoomCapacity"></span> Peserta
                    </p>
                </div>

                <p class="zoom-description" id="zoomDesc"></p>

                <div class="jadwal-zoom-section">
                    <div class="jadwal-list d-flex flex-row justify-content-between align-items-center mb-4">
                        
                        <div class="jadwal d-flex flex-row align-items-center gap-2">
                            <img src="{{ asset('assets/icons/icon_calendar_gradient.svg') }}" width="24">
                            <p id="zoomDate"></p>
                        </div>

                        <div class="jadwal d-flex flex-row align-items-center gap-2">
                            <img src="{{ asset('assets/icons/icon_clock_gradient.svg') }}" width="24">
                            <p id="zoomTime"></p>
                        </div>

                        <div class="jadwal d-flex flex-row align-items-center gap-2">
                            <img src="{{ asset('assets/icons/icon_link_gradient.svg') }}" width="24">
                            <a id="zoomJoinLink" class="text-dark"><p class="fw-bold">Zoom Meeting</p></a>
                        </div>

                    </div>
                </div>

                <div class="zoom-join-btn-wrapper">
                    <a id="zoomJoinLinkBtn" class="yellow-gradient-btn text-decoration-none">Join Sekarang</a>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    function openZoomPopup(button) {
        document.getElementById('zoomNameHeader').innerText = button.dataset.zoomName;
        document.getElementById('zoomName').innerText = button.dataset.zoomName;

        document.getElementById('zoomDesc').innerText = button.dataset.zoomDesc;

        document.getElementById('zoomDateHeader').innerText = button.dataset.zoomDate;
        document.getElementById('zoomDate').innerText = button.dataset.zoomDate;

        document.getElementById('zoomTime').innerText = button.dataset.zoomTime;

        document.getElementById('zoomCapacity').innerText = button.dataset.capacity;

        document.getElementById('zoomJoinLink').href = button.dataset.zoomLink;
        document.getElementById('zoomJoinLinkBtn').href = button.dataset.zoomLink;


        const total = parseInt(button.dataset.totalPeserta);
        const quota = parseInt(button.dataset.quota);

        const progress = Math.round((total / quota) * 100);

        document.getElementById("zoomProgressBar").style.width = progress + "%";

        const start = parseInt(button.dataset.start);
        const end   = parseInt(button.dataset.end);
        const now   = Math.floor(Date.now() / 1000);


        const joinBtn = document.getElementById('zoomJoinLinkBtn');

        if (now < start) {
            // Belum waktunya
            joinBtn.classList.add("disabled");
            joinBtn.style.pointerEvents = "none";
            joinBtn.innerText = "Belum Dimulai";
        } 
        else if (now > end) {
            // Sudah selesai
            joinBtn.classList.add("disabled");
            joinBtn.style.pointerEvents = "none";
            joinBtn.innerText = "Sesi Berakhir";
        } 
        else {
            // Join sekarang
            joinBtn.classList.remove("disabled");
            joinBtn.style.pointerEvents = "auto";
            joinBtn.innerText = "Join Sekarang";
        }

        new bootstrap.Modal(document.getElementById('zoomDetailModal')).show();
    }
</script>

<style>
    .modal-backdrop {
        z-index: 2000  !important;
    }

    .modal.show {
        z-index: 2100 !important;
    }

    .zoom-popup-container {
        border-radius: 40px;
        overflow: hidden;
    }

    .popup-close-btn {
        position: absolute;
        right: 25px;
        top: 25px;
        z-index: 20;
    }

    .zoom-card-detail{
        padding-inline: 40px;
        border-radius: 40px;
        box-shadow: 0px 4px 8px #43270033;
    }
    
    .zoom-title-big {
        font-size: var(--font-size-big);
        font-weight: 700;
        color: black;
        margin: 0;
    }

    .zoom-desc-small {
        font-size: var(--font-size-small);
        margin: 0;
        color: black;
        max-width: 420px;
    }

    .zoom-card-detail-header{
        display: flex;
        padding: 5px;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        width: max-content;
    }

    .course-time-container {
        background: white;
        padding: 15px;
        border-radius: 100px;
        width: max-content;
    }

    .zoom-date-white {
        font-size: var(--font-size-small);
        color: black;
    }

    .zoom-header-image {
        height: 176px;
    }

    .zoom-main-body {
        padding: 0px 48px 48px 48px;
    }

    .zoom-name {
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 12px 0;
    }

    .zoom-description {
        font-size: 15px;
        color: #444;
    }

    .zoom-peserta-progress {
        font-size: 14px;
        margin: 0;
    }

    .jadwal-zoom-section {
        padding-top: 10px;
    }

    .jadwal-list p {
        margin: 0;
    }

    .zoom-join-btn-wrapper {
        display: flex;
        justify-content: flex-end;
    }

    .zoom-join-btn {
        background: linear-gradient(90deg, #ffda47, #ffa900);
        padding: 12px 35px;
        border-radius: 30px;
        color: black;
        text-decoration: none;
        font-weight: 700;
    }

    #zoomJoinLinkBtn.disabled {
        background: #D0D0D0;
        color: #8F8F8F;
        cursor: not-allowed;
    }
</style>