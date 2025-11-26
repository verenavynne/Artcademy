@extends($user->role === 'student' ? 'layouts.master' : 'layouts.master-tutor')

@section('hide_footer')
@endsection

@if($user->role === 'lecturer')
    @section('hide_sidebar')
    @endsection
@endif

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center px-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="d-flex align-items-center gap-4 pt-1 w-100" style="margin-bottom: 18px">
        @if($user->role === 'lecturer')
            <div class="navigation-prev">
                <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
                    <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
                </a>
            </div>
        @endif
        <div class="position-relative flex-grow-1">
            <input type="text" class="custom-input-2 form-control rounded-pill" placeholder="Mau belajar apa hari ini?">
            <iconify-icon icon="icon-park-outline:search" class="search-icon position-absolute">
            </iconify-icon>
        </div>

        @if($user->role === 'student')
            @include('components.notification-panel')
        @endif


    </div>
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

    <!-- Delete pop up -->
    @foreach ($posts as $post)
        @include('forum.components.delete-post-pop-up', ['post' => $post])
    @endforeach

    <!-- Edit pop up -->
    @foreach ($posts as $post)
        @include('forum.components.edit-post-pop-up', ['post' => $post])
    @endforeach

    
</div>

<style>

    .default-min-height{
        min-height: unset;
    }
    .feed-wrapper{
        width: 100%;
    }

    .form-search{
        box-shadow: 0px 4px 8px 0px rgba(67, 39, 0, 0.20);
        border-radius: 1000px ;
        background-color: white;
        height: 56px;
        padding-left: 30px;
        padding-right: 30px;

    }

    .icon-search{
        margin-inline-end: 30px;
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
        if (chatbot) {
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

        }

    }) 
</script>
@endsection


