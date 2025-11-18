@extends($user->role === 'student' ? 'layouts.master' : 'layouts.master-tutor')

@section('hide_footer')
@endsection

@if($user->role === 'lecturer')
    @section('hide_sidebar')
    @endsection
@endif

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-4" style="margin-bottom: 75px;">
    <div class="row">
        <div class="col-3">
            @include('forum.components.sidebar-left-forum')
        </div>

        <!-- Form Side -->
        <div class="col-6 d-flex flex-column align-items-center gap-2">
            <div class="feed-wrapper d-flex flex-column gap-2">
                    <form action="{{ route('post.add') }}" method="POST" enctype="multipart/form-data" id="postForm">
                    @csrf
                        @include('forum.components.add-post-card')
                    </form>


                    <!-- All post -->
                    <div class="post-content-container d-flex flex-column gap-2">
                        @foreach($posts as $post)
                            @include('forum.components.post-card',['post'=>$post])
                        @endforeach
                    </div>
                </div>

        
        </div>

        <!-- Side Bar kanan -->
        <div class="col-3">
            @include('forum.components.sidebar-right-forum')
        
        </div>
    </div>

    <!-- Pop up konfirmasi delete -->
    @foreach ($posts as $post)
        <div class="modal fade" id="deleteConfirmModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteConfirmModalLabel{{ $post->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content d-flex justify-content-center flex-column text-center p-4" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
                
                    <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                
                    <img src="{{ asset('assets/portfolio/portfolio_hapus.png') }}" alt="Konfirmasi Hapus" class="mb-3" width="80" style="align-self: center">
                
                    <h5 class="fw-bold mb-2" style="font-size: var(--font-size-title)">Hapus Post ini?</h5>
                    <p class="mb-4" style="margin: 0; font-size: var(--font-size-primary); color: var(--dark-gray-color)">
                        Setelah dihapus, kamu tidak bisa memulihkannya lagi
                    </p>

                    <div class="d-flex justify-content-center align-items-center gap-3" style="width: 100%">
                        <button type="button" style ="width: 50%; align-self: center" class="btn rounded-pill pink-cream-btn px-4" data-bs-dismiss="modal">
                            <p class="text-pink-gradient" style="margin: 0">Kembali</p>
                        </button>
                        
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="width: 50%; margin-block-end: 0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn w-100 text-white red-btn px-4">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    <!-- Edit pop up -->
    @foreach ($posts as $post)
        <div class="modal fade edit-post-modal" id="editPostModal{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel{{ $post->id }}" aria-hidden="true" data-post-id="{{ $post->id }}">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content d-flex justify-content-center flex-column text-center p-4" style="border-radius: 24px; box-shadow: 0 4px 8px 0 var(--brown-shadow-color);">
                
                    <button type="button" class="btn-close close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                
                    <div class="d-flex flex-column justify-content-between gap-4">

                        <div class="d-flex justify-content-between gap-2" style="height: max-content;">
                            
                            <div class="post-profile d-flex flex-row gap-3 justify-content-center align-items-center">
                                <img src="{{  $post->user->profilePicture ? asset('storage/' . $post->user->profilePicture) : asset('assets/default-profile.jpg') }}" 
                                    class="profile-picture rounded-circle"
                                    alt="" width="74" height="74" style="object-fit: cover">
                                <p class="fw-bold" style="margin: 0; font-size: 16px">{{ $post->user->name }}</p>
                            </div>
    
                        </div>
                        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="deleted_files" id="deletedFilesInput-{{ $post->id }}">
                        <div class="w-100" style="min-height: 80px;">
                            <textarea 
                                class="form-control border-0 shadow-none p-0 add-post-textarea  @error('caption') is-invalid @enderror"
                                name="caption"
                                placeholder="Apa yang kamu pikirkan?"
                                rows="1"
                            >{{ $post->postText }}</textarea>
                          
                            @if($post->files->count())
                                <div class="post-image-video">
                                    @foreach($post->files as $file)
                                        <div class="grid-item position-relative">
                                            
                                            <button type="button"
                                                class="btn-close bg-white p-1 btn-sm position-absolute top-0 end-0 rounded-circle m-1 delete-existing-file"
                                                data-file-id="{{ $file->id }}">
                                            </button>

                                            @if($file->fileType === 'image')
                                                <img 
                                                    src="{{ asset('storage/'.$file->filePath) }}"
                                                    class="media-item"
                                                    alt=""
                                                >
                                            @endif

                                            @if($file->fileType === 'video')
                                                <video
                                                    class="media-item video-player"
                                                    playsinline
                                                    controls
                                                >
                                                    <source src="{{ asset('storage/'.$file->filePath) }}" type="video/mp4">
                                                </video>
                                            @endif

                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div id="preview-wrapper-edit-{{ $post->id }}" class="mt-3 preview-wrapper" style="display:none;">
                                <div id="preview-items-edit-{{ $post->id }}" class="preview-items"></div>
                            </div>
                        </div>
    
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
    
                            <button type="submit" class="btn py-2 px-4 text-dark yellow-gradient-btn d-flex flex-row gap-2">
                                Edit
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    
</div>

<style>
    .feed-wrapper{
        width: 100%;
        /* height: calc(100vh - 100px); */
        /* overflow-y: auto; */
    }

    /* .form-check-input:checked{
        background: var(--orange-gradient-color);
        border: var(--orange-gradient-color);
    } */

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

    .post-image-video {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        width: 100%;
    }

    .grid-item {
        width: 100%;
        display: block;
    }

    .delete-existing-file{
        position: absolute;
        z-index: 20;
    }

    .media-item {
        width: 100%;
        height: auto;
        max-height: 260px;
        border-radius: 12px;
        object-fit: cover;
        display: block;
    }

    .plyr.plyr--full-ui.plyr--video{
        border-radius: 12px;
    }


    .toggle-wrapper {
        min-width: 150px; 
    }

    .typing-effect {
        white-space: pre-wrap;
        font-family: inherit;
        border-right: 2px solid #ccc;
        animation: blink .7s infinite;
    }

    @keyframes blink {
        50% { border-color: transparent; }
    }


</style>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.edit-post-modal').forEach(modal => {
            modal.addEventListener('shown.bs.modal', () => {
                const imgInput = modal.querySelector('input[name="images[]"]');
                const videoInput = modal.querySelector('input[name="videos[]"]');
                const previewWrapper = modal.querySelector(`#preview-wrapper-edit-${modal.dataset.postId}`);
                const previewItems = modal.querySelector(`#preview-items-edit-${modal.dataset.postId}`);
                const form = modal.querySelector("form");
        
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
            })
        })
        document.querySelectorAll('.comment-toggle').forEach(btn => {
                const target = document.querySelector(btn.dataset.target);
                const iconHolder = btn.querySelector('.icon-holder');

                const defaultIcon = btn.dataset.defaultIcon;
                const activeIcon  = btn.dataset.activeIcon;

                btn.addEventListener('click', () => {
                    const isOpen = target.style.display === 'block';

                    target.style.display = isOpen ? 'none' : 'block';

                    iconHolder.innerHTML = isOpen
                        ? `<iconify-icon icon="${defaultIcon}" style="font-size:20px"></iconify-icon>`
                        : `<img src="${activeIcon}" height="20" width="20">`;
                });
        });

        document.querySelectorAll('.reply-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = document.querySelector(btn.dataset.target);
                if (!target) return;

                const isOpen = target.style.display === "block";
                target.style.display = isOpen ? "none" : "block";

                btn.classList.toggle('active', !isOpen);

                const iconHolder = btn.querySelector('.icon-holder');
                const defaultIcon = btn.dataset.defaultIcon;
                const activeIcon = btn.dataset.activeIcon;

                if (!isOpen) {
                    iconHolder.innerHTML = `
                        <img src="${activeIcon}" height="20" width="20">
                    `;
                } else {
                    
                    iconHolder.innerHTML = `
                        <iconify-icon icon="${defaultIcon}" style="font-size: 20px"></iconify-icon>
                    `;
                }
                
            });
        });

        let deletedFiles = [];

        document.querySelectorAll('.delete-existing-file').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.fileId;
                deletedFiles.push(id);

                const form = this.closest('.modal-content').querySelector('form');

                const hiddenInput = form.querySelector('input[name="deleted_files"]');

                hiddenInput.value = JSON.stringify(deletedFiles);

                this.closest('.grid-item').remove();
            });
        });

        // Kasi typing effect chatbot
        const chatbot = document.getElementById('chatbot-comment');
        if (!chatbot) return; 

        let text = chatbot.getAttribute('data-text') || "";
        let i = 0;

        chatbot.textContent = '';

        function type() {
            if (i < text.length) {
                chatbot.textContent += text.charAt(i);
                i++;
                setTimeout(type, 20);
            }
        }

        type();

        

    }) 
</script>



