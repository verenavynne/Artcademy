<div class="add-post-card d-flex flex-column" id="buat-post">
    <div class="d-flex justify-content-between flex-grow-1">
        <textarea 
            class="form-control border-0 shadow-none p-0 add-post-textarea  @error('caption') is-invalid @enderror"
            name="caption"
            placeholder="Apa yang kamu pikirkan?"
            rows="1"
        ></textarea>
        

        <div class="toggle-wrapper text-end d-flex align-items-start">
            <div class="form-check form-switch justify-content-center align-items-center">
                <input class="form-check-input" type="checkbox" id="apolloSwitch" name="triggerChatbot">
                <label class="form-check-label ms-1" for="apolloSwitch">
                    <img src="{{ asset('assets/icons/icon_apollo.svg') }}" width="16" height="16" class="me-1">
                    Apollo aktif
                </label>
            </div>
        </div>

    </div>
    @error('caption')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
    <div id="preview-wrapper" class="mt-3" style="display:none;">
        <div id="preview-items" class=""></div>
    </div>
    @if ($errors->has('images.*'))
        <div class="invalid-feedback d-block">
            {{ $errors->first('images.*') }}
        </div>
    @endif

    @if ($errors->has('videos.*'))
        <div class="invalid-feedback d-block">
            {{ $errors->first('videos.*') }}
        </div>
    @endif

    <div class="d-flex justify-content-between mt-3 align-items-center">

        <div class="d-flex gap-3">
            <label class="icon-btn">
                <iconify-icon icon="icon-park:upload-picture" style="font-weight: 24px"></iconify-icon>
                <input type="file" name="images[]" hidden multiple>
            </label>

            <label class="icon-btn">
                <iconify-icon icon="mingcute:video-line" style="font-weight: 24px"></iconify-icon>
                <input type="file" name="videos[]" hidden accept="video/*" multiple>
            </label>
        </div>

        <button type="submit" class="btn py-2 px-4 text-dark yellow-gradient-btn align-items-center d-flex flex-row gap-2">
            Post
        </button>
    </div>
</div>


<style>
    /* For add post input */
    .add-post-card{
        border-radius: 20px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        padding: 20px;
        
    }

    .add-post-textarea{
        resize: none !important;
    }

    .add-post-textarea{
        background: white;
    }

    #preview-items {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .preview-item {
        position: relative;
        width: 100%;
    }

    .preview-item img,
    .preview-item video {
        position: relative;
        width: 100%;
        height: auto;           
        max-height: 250px;       
        object-fit: cover;
        border-radius: 12px;
        display: block;
        z-index: 1;    
    }

    .preview-item .btn-close {
        position: absolute;
        z-index: 5;
        padding: 10px;
    }


    .toggle-wrapper {
        min-width: 150px; 
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const imgInput = document.querySelector('input[name="images[]"]');
    const videoInput = document.querySelector('input[name="videos[]"]');
    const previewWrapper = document.getElementById('preview-wrapper');
    const previewItems = document.getElementById('preview-items');
    const form = document.querySelector("form");

    let imageInputs = [];
    let videoInputs = [];

    function cloneFileInput(originalInput, file) {
        const clone = originalInput.cloneNode();
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);

        clone.files = dataTransfer.files;
        originalInput.insertAdjacentElement("afterend", clone);

        return clone;
    }

    function addImagePreview(file, inputClone) {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.classList.add('preview-item');

            div.innerHTML = `
                <img src="${e.target.result}">
                <button class="btn-close position-absolute top-0 end-0 m-1 bg-white p-1 rounded-circle"></button>
            `;

            div.querySelector(".btn-close").onclick = () => {
                inputClone.remove();
                imageInputs = imageInputs.filter(i => i !== inputClone);
                div.remove();
            };

            previewItems.appendChild(div);
        };
        reader.readAsDataURL(file);
    }

    function addVideoPreview(file, inputClone) {
        const url = URL.createObjectURL(file);
        const randomId = "plyr-" + Math.random().toString(36).substring(2, 10);

        const div = document.createElement('div');
        div.classList.add('preview-item');

        div.innerHTML = `
            <video id="${randomId}" playsinline controls>
                <source src="${url}">
            </video>
            <button class="btn-close position-absolute top-0 end-0 m-1 bg-white p-1 rounded-circle"></button>
        `;

        previewItems.appendChild(div);
        new Plyr('#' + randomId);

        div.querySelector(".btn-close").onclick = () => {
            inputClone.remove();
            videoInputs = videoInputs.filter(i => i !== inputClone);
            div.remove();
        };
    }

    imgInput.addEventListener("change", e => {
        previewWrapper.style.display = "block";

        [...e.target.files].forEach(file => {
            const clone = cloneFileInput(imgInput, file);
            imageInputs.push(clone);
            addImagePreview(file, clone);
        });

        imgInput.value = "";
    });

    videoInput.addEventListener("change", e => {
        previewWrapper.style.display = "block";

        [...e.target.files].forEach(file => {
            const clone = cloneFileInput(videoInput, file);
            videoInputs.push(clone);
            addVideoPreview(file, clone);
        });

        videoInput.value = "";
    });

});
</script>

