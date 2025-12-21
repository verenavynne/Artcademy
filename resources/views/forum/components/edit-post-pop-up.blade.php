<div class="modal fade edit-post-modal" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center flex-column text-center p-4" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
        
            <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
        
            <div class="d-flex flex-column justify-content-between gap-4">

                <div class="d-flex justify-content-between gap-2" style="height: max-content;">
                    
                    <div class="post-profile d-flex flex-row gap-3 justify-content-center align-items-center">
                        <img id="editPostAvatar" 
                            class="profile-picture rounded-circle"
                            alt="" width="74" height="74" style="object-fit: cover">
                        <p id="editPostUsername" class="fw-bold" style="margin: 0; font-size: 16px"></p>
                    </div>

                </div>

                <form id="editPostForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="deleted_files" id="deletedFilesInput">

                    <div class="w-100" style="min-height: 80px;">
                        <textarea
                            id="editPostText"
                            class="form-control border-0 shadow-none p-0 add-post-textarea"
                            name="caption"
                            rows="1"
                        ></textarea>

                        {{-- existing files --}}
                        <div id="existingFiles" class="post-image-video"></div>

                        <div id="preview-wrapper-edit" class="mt-3 preview-wrapper" style="display:none;">
                            <div id="preview-items-edit" class="preview-items"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3 align-items-center">
                        <div class="d-flex gap-3">
                            <label class="icon-btn" style="cursor: pointer">
                                <iconify-icon icon="icon-park:upload-picture"></iconify-icon>
                                <input type="file" name="images[]" hidden multiple>
                            </label>

                            <label class="icon-btn" style="cursor: pointer">
                                <iconify-icon icon="mingcute:video-line"></iconify-icon>
                                <input type="file" name="videos[]" hidden accept="video/*" multiple>
                            </label>
                        </div>
                       
                        <button type="submit" id="submitBtnEdit" class="btn text-dark yellow-gradient-btn px-4 d-flex align-items-center justify-content-center gap-2">
                            <div id="loadingSpinnerEdit" class="spinner-border spinner-border-sm text-dark d-none"></div>
                            <span id="btnTextEdit">Edit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const editForm = document.getElementById('editPostForm');
    const submitBtnEdit = document.getElementById('submitBtnEdit');
    const btnTextEdit = document.getElementById('btnTextEdit');
    const loadingSpinnerEdit = document.getElementById('loadingSpinnerEdit');

    editForm.addEventListener('submit', function () {
        submitBtnEdit.disabled = true;
        btnTextEdit.textContent = 'Memproses...';
        loadingSpinnerEdit.classList.remove('d-none');
    });
</script>