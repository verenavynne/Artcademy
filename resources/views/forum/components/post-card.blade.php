@php
$autoOpen = $post->comments->whereNotNull('chatbotId')->isNotEmpty();
@endphp

<div class="post-card d-flex flex-column gap-3  position-relative" id="post-{{ $post->id }}">
    <div class="post-card-header d-flex flex-row justify-content-between w-100 gap-3">
        @if($post->userId === Auth::id())
            <div class="dropdown position-absolute top-0 end-0 m-3">
                <button class="btn btn-link text-dark p-0" type="button" id="dropdownMenu{{ $post->id }}"
                    data-bs-toggle="dropdown" aria-expanded="false"
                    >
                    <iconify-icon icon="qlementine-icons:menu-dots-16"></iconify-icon>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $post->id }}">
                    @if(!$autoOpen)
                    <li>
                        <button type="button" 
                            class="dropdown-item"
                            data-bs-toggle="modal"
                            data-bs-target="#editPostModal{{ $post->id }}">
                            Edit
                        </button>
                    </li>
                    @endif
                    <li>
                        <button 
                            type="button" 
                            class="dropdown-item text-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deletePostConfirmModal{{ $post->id }}"
                            >
                            Hapus
                        </button>
                    </li>
                </ul>
            </div>
        @endif
        
        <div class="d-flex flex-row gap-2">
            <img src="{{  $post->user->profilePicture ? asset('storage/' . $post->user->profilePicture) : asset('assets/default-profile.jpg') }}" alt="" height="42" width="42"
            class="profile-picture rounded-circle"
            style="object-fit: cover">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row gap-2">
                    <p class="fw-bold" style="font-size: 16px; margin: 0">{{ $post->user->name }}</p>
                    <p class="text-muted">2 hari yang lalu</p>
                </div>
                @if($post->triggerChatbot)
                    <div class="d-flex flex-row align-items-center  gap-2">
                        <img src="{{ asset('assets/icons/icon_apollo.svg') }}" alt="" width="16" height="16">
                        <p class="fw-bold" style="margin: 0">Apollo Aktif</p>
                    </div>
                @endif

            </div>
        </div>
        <div class="d-flex flex-row">
            @if($post->userId !== Auth::id())
                <a href="{{ route('forum.visit-profile', $post->userId) }}" style="text-decoration: none">
                    <p class="text-pink-gradient fw-bold" style="margin: 0">Kunjungi Profil</p>
                </a>
            @endif

        </div>

    </div>

    <div class="post-card-content">
        <p>{{ $post->postText }}</p>

    </div>

    @if($post->files->count())
        <div class="post-image-video">
            @foreach($post->files as $file)
                <div class="grid-item">

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

    <div class="chat-icon d-flex flex-row gap-2 align-items-center comment-toggle"
        data-target="#comment-{{ $post->id }}"
        data-default-icon="iconamoon:comment-dots"
        data-active-icon="{{ asset('assets/icons/icon_comment_gradient.svg') }}"
        data-open="{{ $autoOpen ? '1' : '0' }}"
        style="cursor:pointer">

        <span class="icon-holder">
            @if($autoOpen)
                <img src="{{ asset('assets/icons/icon_comment_gradient.svg') }}" height="20" width="20">
            @else
                <iconify-icon icon="iconamoon:comment-dots" style="font-size:20px"></iconify-icon>
            @endif
        </span>

        <p>{{ $post->allComments->count() }} balasan</p>
    </div>

    <!-- Comment Section -->
    <div id="comment-{{ $post->id }}" class="comment-section w-100" style="display: {{ $autoOpen ? 'block' : 'none' }};">
        <hr class="divider w-100">
    
        <div class="balas-komen-section d-flex flex-row gap-2 w-100">
            <img src="{{  auth()->user()->profilePicture ? asset('storage/' .  auth()->user()->profilePicture) : asset('assets/default-profile.jpg') }}" alt="" height="42" width="42"
            class="profile-picture rounded-circle"
            style="object-fit: cover">
    
            <form action="{{ route('comment.add') }}" class="w-100" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="postId" value="{{ $post->id }}">
                <div class="balas-text-area d-flex flex-column w-100">
                    <div class="d-flex justify-content-between flex-grow-1">
                        <textarea 
                            class="form-control border-0 shadow-none p-0 balas-post-textarea"
                            name="caption"
                            placeholder="Apa yang kamu pikirkan?"
                            rows="1"
                        ></textarea>
                    </div>
                    <div class="mt-3 preview-wrapper" style="display:none;">
                        <div class="preview-items"></div>
                    </div>
            
                    <div class="d-flex justify-content-between mt-3 align-items-center">
                        <div class="d-flex gap-3 flex-row justify-content-end align-self-end">
                            <label class="icon-btn">
                                <iconify-icon icon="icon-park:upload-picture" style="font-weight: 24px"></iconify-icon>
                                <input type="file" name="images[]" hidden multiple>
                            </label>
            
                            <label class="icon-btn">
                                <iconify-icon icon="mingcute:video-line" style="font-weight: 24px"></iconify-icon>
                                <input type="file" name="videos[]" hidden accept="video/*" multiple>
                            </label>
                        </div>
            
                        <button class="btn py-2 px-4 text-dark yellow-gradient-btn align-items-center d-flex flex-row gap-2">
                            Balas
                        </button>
                    </div>
                </div>
            </form>
        </div>
    
        @if($post->allComments->count())
        <div class="d-flex flex-column gap-2 mt-3">

            @foreach ($post->comments as $comment )
            
                <div class="komen-container mb-3">
                    <div class="d-flex flex-column gap-3">
                        <div class="komen-header">
                            <div class="d-flex flex-row gap-2">
                                <img src="{{
                                        $comment->user
                                            ? ($comment->user->profilePicture
                                                ? asset('storage/' . $comment->user->profilePicture)
                                                : asset('assets/default-profile.jpg'))
                                            : asset('assets/default-profile.jpg')
                                    }}" 
                                    alt="" height="42" width="42"
                                class="profile-picture rounded-circle"
                                style="object-fit: cover">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row gap-2">
                                        <p class="fw-bold" style="font-size: 16px; margin: 0">{{  optional($comment->user)->name ?? $comment->chatbot->chatbotName }}</p>
                                        <p class="text-muted">2 hari yang lalu</p>
                                    </div>
                                    
                                    <p>Membalas <span class="fw-bold">@ {{ $comment->post->user->name }}</span></p>
                                </div>
                            </div>
            
                        </div>
            
                        <div class="komen-content" id="comment-{{ $comment->id }}"  data-comment-id="{{ $comment->id }}"
                            data-post-id="{{ $comment->postId }}">
                            @if (session('chatbot_comment_id') == $comment->id)
                                <div id="chatbot-comment" data-text="{{ $comment->commentText }}"></div>
                            @else
                                <p>{{ $comment->commentText }}</p>
                            @endif
                            
                        </div>

                        @if($comment->files->count())
                            <div class="post-image-video">
                                @foreach($comment->files as $file)
                                    <div class="grid-item">

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
                            <div class="chat-icon d-flex flex-row gap-2 align-items-center reply-toggle"
                                data-target="#reply-{{ $comment->id }}"
                                data-default-icon="iconamoon:comment-dots"
                                data-active-icon="/assets/icons/icon_comment_gradient.svg"
                                style="cursor:pointer;">
                                <span class="icon-holder">
                                    <iconify-icon icon="iconamoon:comment-dots" style="font-size: 20px"></iconify-icon>
                                </span>
                                <p>{{ $comment->replies->count() }} balasan</p>

                            </div>
                        

                            <!-- Replies section -->
                            <div id="reply-{{ $comment->id }}" class="comment-section w-100 ps-4" style="display: none">
                                <hr class="divider w-100">
                            
                                <div class="balas-komen-section d-flex flex-row gap-2 w-100">
                                    <img src="{{
                                        $comment->user
                                            ? ($comment->user->profilePicture
                                                ? asset('storage/' . $comment->user->profilePicture)
                                                : asset('assets/default-profile.jpg'))
                                            : asset('assets/default-profile.jpg')
                                    }}" 
                                    alt="" height="42" width="42"
                                    class="profile-picture rounded-circle"
                                    style="object-fit: cover">
                            
                                    <form action="{{ route('comment.reply') }}" class="w-100" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <input type="hidden" name="postId" value="{{ $comment->postId }}">
                                        <input type="hidden" name="parentId" value="{{ $comment->id }}">
                                        <div class="balas-text-area d-flex flex-column w-100">
                                            <div class="d-flex justify-content-between flex-grow-1">
                                                <textarea 
                                                    class="form-control border-0 shadow-none p-0 balas-post-textarea"
                                                    name="caption"
                                                    placeholder="Apa yang kamu pikirkan?"
                                                    rows="1"
                                                ></textarea>
                                            </div>
                                            <div class="mt-3 preview-wrapper" style="display:none;">
                                                <div class="preview-items"></div>
                                            </div>
                                    
                                            <div class="d-flex justify-content-between mt-3 align-items-center">
                                                <div class="d-flex gap-3 flex-row justify-content-end align-self-end">
                                                    <label class="icon-btn">
                                                        <iconify-icon icon="icon-park:upload-picture" style="font-weight: 24px"></iconify-icon>
                                                        <input type="file" name="images[]" hidden multiple>
                                                    </label>
                                    
                                                    <label class="icon-btn">
                                                        <iconify-icon icon="mingcute:video-line" style="font-weight: 24px"></iconify-icon>
                                                        <input type="file" name="videos[]" hidden accept="video/*" multiple>
                                                    </label>
                                                </div>
                                    
                                                <button class="btn py-2 px-4 text-dark yellow-gradient-btn align-items-center d-flex flex-row gap-2">
                                                    Balas
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            
                                @if($comment->replies->count())
                                <div class="d-flex flex-column gap-2">

                                    @foreach ($comment->replies as $replies )
                                        <div class="komen-container mb-3">
                                            <div class="d-flex flex-column gap-3">
                                                <div class="komen-header">
                                                    <div class="d-flex flex-row gap-2">
                                                        <img src="{{  $replies->user->profilePicture ? asset('storage/' . $replies->user->profilePicture) : asset('assets/default-profile.jpg') }}" alt="" height="42" width="42"
                                                        class="profile-picture rounded-circle"
                                                        style="object-fit: cover">
                                                        <div class="d-flex flex-column">
                                                            <div class="d-flex flex-row gap-2">
                                                                <p class="fw-bold" style="font-size: 16px; margin: 0">{{ $replies->user->name }}</p>
                                                                <p class="text-muted">2 hari yang lalu</p>
                                                            </div>
            
                                                            <p>Membalas <span class="fw-bold">@ {{ optional($replies->parent->user)->name ?? $replies->parent->chatbot->chatbotName }}</span></p>
                                                        </div>
                                                    </div>
                                    
                                                </div>
                                    
                                                <div class="komen-content" id="comment-{{ $replies->id }}" 
                                                    data-comment-id="{{ $replies->id }}"
                                                    data-post-id="{{ $replies->postId }}"
                                                    data-parent-id="{{ $comment->id }}">
                                                    <p>{{ $replies->commentText }}</p>
                                    
                                                </div>
                                                @if($replies->files->count())
                                                    <div class="post-image-video">
                                                        @foreach($replies->files as $fileReply)
                                                            <div class="grid-item">

                                                                @if($fileReply->fileType === 'image')
                                                                    <img 
                                                                        src="{{ asset('storage/'.$fileReply->filePath) }}"
                                                                        class="media-item"
                                                                        alt=""
                                                                    >
                                                                @endif

                                                                @if($fileReply->fileType === 'video')
                                                                    <video
                                                                        class="media-item video-player"
                                                                        playsinline
                                                                        controls
                                                                    >
                                                                        <source src="{{ asset('storage/'.$fileReply->filePath) }}" type="video/mp4">
                                                                    </video>
                                                                @endif

                                                            </div>
                                                        @endforeach
                                                    </div>

                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                @endif
        
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
    
</div>

<style>

    .divider{
        margin-block: 10px;
    }

    .post-card {
        padding: 25px 23px 31px 23px;
        justify-content: center;
        align-items: flex-start;
        border-radius: 20px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
    }
    .post-card  p{
        margin: 0;
    }

    .balas-post-textarea{
        resize: none !important;
        background-color:  #FAFAFA;
    }

    .form-control:focus{
        background-color:  #FAFAFA;
    }

    .balas-text-area{
        padding: 20px;
        border-radius: 20px;
        background-color:  #FAFAFA;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
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

    /* Preview image/video */
    .preview-items {
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

    
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const players = [];

        document.querySelectorAll('.video-player').forEach((el) => {
            const player = new Plyr(el, {
                clickToSeek: true,
                controls: [
                    'play-large', 'play', 'progress', 'current-time',
                    'mute', 'volume', 'settings', 'fullscreen'
                ],
            });

            players.push(player);
        });


       document.querySelectorAll(".balas-komen-section").forEach(card => {
            const imgInput = card.querySelector('input[name="images[]"]');
            const videoInput = card.querySelector('input[name="videos[]"]');
            const previewWrapper = card.querySelector('.preview-wrapper');
            const previewItems = card.querySelector('.preview-items');

            if (!imgInput || !videoInput) return;

            let imageInputs = [];
            let videoInputs = [];

            function cloneFileInput(originalInput, file) {
                const clone = originalInput.cloneNode();
                const dt = new DataTransfer();
                dt.items.add(file);
                clone.files = dt.files;
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
                    previewWrapper.style.display = "block";
                };
                reader.readAsDataURL(file);
            }

            function addVideoPreview(file, inputClone) {
                const url = URL.createObjectURL(file);
                const id = "plyr-" + Math.random().toString(36).slice(2);

                const div = document.createElement('div');
                div.classList.add('preview-item');
                div.innerHTML = `
                    <video id="${id}" playsinline controls>
                        <source src="${url}">
                    </video>
                    <button class="btn-close position-absolute top-0 end-0 m-1 bg-white p-1 rounded-circle"></button>
                `;
                previewItems.appendChild(div);
                new Plyr("#" + id);

                div.querySelector(".btn-close").onclick = () => {
                    inputClone.remove();
                    videoInputs = videoInputs.filter(i => i !== inputClone);
                    div.remove();
                };

                previewWrapper.style.display = "block";
            }

            imgInput.addEventListener("change", e => {
                [...e.target.files].forEach(file => {
                    const clone = cloneFileInput(imgInput, file);
                    imageInputs.push(clone);
                    addImagePreview(file, clone);
                });
                imgInput.value = "";
            });

            videoInput.addEventListener("change", e => {
                [...e.target.files].forEach(file => {
                    const clone = cloneFileInput(videoInput, file);
                    videoInputs.push(clone);
                    addVideoPreview(file, clone);
                });
                videoInput.value = "";
            });

        });


    });
</script>