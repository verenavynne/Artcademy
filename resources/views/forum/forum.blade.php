@extends($user->role === 'student' ? 'layouts.master' : 'layouts.master-tutor')

@section('hide_footer')
@endsection

@if($user->role === 'lecturer')
    @section('hide_sidebar')
    @endsection
@endif

@section('content')

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px;">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning mt-3">{{ session('warning') }}</div>
    @endif
    <div class="d-flex align-items-center gap-4 pt-1 w-100" style="margin-bottom: 18px">
        @if($user->role === 'lecturer')
            <a class="page-link" href="{{ route('home') }}" onclick="window.history.back()">
                <div class="navigation-prev">
                    <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
                </div>
            </a>
        @endif
        <div class="position-relative flex-grow-1">
            <form class="d-flex w-100" method="GET" action="{{ route('forum') }}">
                <input 
                    type="text" 
                    class="custom-input-2 form-control rounded-pill" 
                    placeholder="Cari post apa hari ini?"
                    name="query"
                    value="{{ request('query') }}"
                >
    
                <button 
                    type="submit"
                    class="btn position-absolute end-0 top-50 p-0 pe-4 border-0 bg-transparent"
                    style="z-index: 5;"
                >
                    <iconify-icon 
                        icon="icon-park-outline:search" 
                        class="search-icon"
                        style="font-size: 22px;"
                    ></iconify-icon>
                </button>
            </form>
        </div>

    </div>
    <div class="row forum-row">
        <div class="col-3">
            @include('forum.components.sidebar-left-forum')
        </div>

        <!-- Form Side -->
        <div class="col-6 d-flex flex-column align-items-center gap-2">
            <div class="feed-wrapper d-flex flex-column gap-2">
                    
                    @include('forum.components.add-post-card')


                    <!-- All post -->
                    <div class="post-content-container d-flex flex-column gap-2" id="post-container">
                        @if($posts->isEmpty())
                            @if($totalPost == 0)
                                <div class="d-flex flex-column align-items-center gap-4" style="margin-top: 70px;">
                                    <img src="{{ asset('assets/course/empty.png') }}" alt="" style="width: 100px">
                                    <div>
                                        <h3 class="text-center fw-semibold" style="font-size: 20px; color: var(--black-color)">Belum ada diskusi di forum</h3>
                                        <p class="text-center" style="font-size: 18px; color: var(--dark-gray-color)">Jadilah yang pertama memulai diskusi dan berbagi ide!</p>
                                    </div>
                                </div>
                            @elseif(request('query'))
                                <div class="d-flex flex-column align-items-center gap-4" style="margin-top: 70px;">
                                    <img src="{{ asset('assets/course/empty.png') }}" alt="" style="width: 100px">
                                    <div>
                                        <h3 class="text-center fw-semibold" style="font-size: 20px; color: var(--black-color)">Yah, belum ketemu</h3>
                                        <p class="text-center" style="font-size: 18px; color: var(--dark-gray-color)">Belum ada postingan yang sesuai dengan pencarian ini</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            @include('forum.components.post-list', ['posts' => $posts])
                        @endif
                    </div>

                    <div class="d-flex justify-content-center my-4">
                        <button id="loading-btn" class="btn d-none" style="border: none" disabled>
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            
                        </button>
                    </div>
                </div>

        
        </div>

        <!-- Side Bar kanan -->
        <div class="col-3">
            @include('forum.components.sidebar-right-forum')
        
        </div>
    </div>

    <!-- Edit pop up -->
    @include('forum.components.edit-post-pop-up')
    <!-- Delete pop up -->
    @include('forum.components.delete-post-pop-up')
    
</div>

<style>

    #tutor-wrapper{
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .row {
        --bs-gutter-x: 1.5rem !important;
        gap: unset !important;
        flex-wrap: wrap !important;
    }

    .navigation-prev{
        margin-block-end: 0;
    }

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
        background: #F9EEDB !important;
        justify-content: center;
        border-radius: 100px;
        border: none;
        position: absolute;
        top: 16px;
        right: 16px;
        cursor: pointer;
        color: #E5C69B !important;
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
        // Global Variabel
        const editModal = document.getElementById('editPostModal');
        if (!editModal) return;

        const form = editModal.querySelector('#editPostForm');
        const editPostText = editModal.querySelector('#editPostText');
        const existingFiles = editModal.querySelector('#existingFiles');
        const deletedInput = editModal.querySelector('input[name="deleted_files"]');

        const imgInput = editModal.querySelector('input[name="images[]"]');
        const videoInput = editModal.querySelector('input[name="videos[]"]');
        const previewWrapper = editModal.querySelector('#preview-wrapper-edit');
        const previewItems = editModal.querySelector('#preview-items-edit');

        let deletedFiles = [];
        let imageInputs = [];
        let videoInputs = [];

        // For open edit pop up
        document.addEventListener('click', e => {
            const btn = e.target.closest('.btn-edit-post');
            if (!btn) return;

            const postText = btn.dataset.postText;
            const updateUrl = btn.dataset.updateUrl;
            const userName = btn.dataset.userName;
            const userAvatar = btn.dataset.userAvatar;
            const files = JSON.parse(btn.dataset.files || '[]');

            editPostText.value = postText;
            editModal.querySelector('#editPostUsername').textContent = userName;
            editModal.querySelector('#editPostAvatar').src = userAvatar;

            form.action = updateUrl;

            existingFiles.innerHTML = '';
            deletedFiles = [];
            deletedInput.value = '';

            files.forEach(file => {
                const div = document.createElement('div');
                div.className = 'grid-item position-relative';

                div.innerHTML = `
                    <button type="button"
                        class="btn-close bg-white p-1 btn-sm position-absolute top-0 end-0 m-1 delete-existing-file"
                        data-file-id="${file.id}">
                    </button>

                    ${
                        file.fileType === 'image'
                            ? `<img src="/storage/${file.filePath}" class="media-item">`
                            : `<video controls class="media-item">
                                <source src="/storage/${file.filePath}">
                            </video>`
                    }
                `;

                existingFiles.appendChild(div);
            });
        });

        // For delete existing file yang ada di post
        editModal.addEventListener('click', e => {
            const btn = e.target.closest('.delete-existing-file');
            if (!btn) return;

            deletedFiles.push(btn.dataset.fileId);
            deletedInput.value = JSON.stringify(deletedFiles);

            btn.closest('.grid-item').remove();
        });

        // Preview image dan video
        function cloneFileInput(originalInput, file) {
            const clone = originalInput.cloneNode();
            const dt = new DataTransfer();
            dt.items.add(file);
            clone.files = dt.files;
            originalInput.insertAdjacentElement('afterend', clone);
            return clone;
        }

        function addPreview(html, onRemove) {
            previewWrapper.style.display = 'block';
            const div = document.createElement('div');
            div.className = 'preview-item';
            div.innerHTML = html;

            div.querySelector('.btn-close').onclick = () => {
                onRemove();
                div.remove();
                if (!previewItems.children.length) {
                    previewWrapper.style.display = 'none';
                }
            };

            previewItems.appendChild(div);
        }

        imgInput.addEventListener('change', e => {
            [...e.target.files].forEach(file => {
                const clone = cloneFileInput(imgInput, file);
                imageInputs.push(clone);

                const reader = new FileReader();
                reader.onload = ev => {
                    addPreview(
                        `<img src="${ev.target.result}">
                        <button class="btn-close position-absolute top-0 end-0 m-1 bg-white p-1 rounded-circle"></button>`,
                        () => clone.remove()
                    );
                };
                reader.readAsDataURL(file);
            });

            imgInput.value = '';
        });

        videoInput.addEventListener('change', e => {
            [...e.target.files].forEach(file => {
                const clone = cloneFileInput(videoInput, file);
                videoInputs.push(clone);

                const url = URL.createObjectURL(file);
                const id = 'plyr-' + Math.random().toString(36).slice(2);

                addPreview(
                    `<video id="${id}" playsinline controls>
                        <source src="${url}">
                    </video>
                    <button class="btn-close position-absolute top-0 end-0 m-1 bg-white p-1 rounded-circle"></button>`,
                    () => clone.remove()
                );

                new Plyr('#' + id);
            });

            videoInput.value = '';
        });

        // Reset modal
        editModal.addEventListener('hidden.bs.modal', () => {
            previewItems.innerHTML = '';
            previewWrapper.style.display = 'none';
            existingFiles.innerHTML = '';

            deletedFiles = [];
            imageInputs = [];
            videoInputs = [];
            deletedInput.value = '';
        });

        // Delete modal
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-delete-post');
            if (!btn) return;

            const deleteUrl = btn.dataset.deleteUrl;
            console.log('vyn deleteUrl', deleteUrl)
            const deleteForm = document.getElementById('deletePostForum');
            if(!deleteForm){
                console.error('Delete post form not found!');
                return;
            }

            deleteForm.action = deleteUrl;
        });

        // infinite scroll
        let page = 1;
        let loading = false;
        const lastPage = {{ $posts->lastPage() }};
        const loadingBtn = document.getElementById('loading-btn');

        window.addEventListener('scroll', () => {
            if (loading) return;
            if (window.innerHeight + window.scrollY < document.body.offsetHeight - 300) return;
            if (page >= lastPage) return;

            page++;
            loading = true;
            loadingBtn.classList.remove('d-none');

            fetch(`?page=${page}&query={{ request('query') }}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById('post-container')
                    .insertAdjacentHTML('beforeend', html);
            })
            .finally(() => {
                loading = false;
                loadingBtn.classList.add('d-none');
            });
        });
        
        // Buka section comment and reply
        document.addEventListener('click', function (e) {
        // Toggle post comment
            const commentToggle = e.target.closest('.comment-toggle');
            if (commentToggle) {
                const targetSelector = commentToggle.dataset.target;
                const target = document.querySelector(targetSelector);
                if (!target) return;

                const iconHolder = commentToggle.querySelector('.icon-holder');
                const isOpen = target.style.display === 'block';

                target.style.display = isOpen ? 'none' : 'block';

                // Icon swap
                if (isOpen) {
                    iconHolder.innerHTML = `<iconify-icon icon="${commentToggle.dataset.defaultIcon}" style="font-size:20px"></iconify-icon>`;
                } else {
                    iconHolder.innerHTML = `<img src="${commentToggle.dataset.activeIcon}" height="20" width="20">`;
                }

                return;
            }

            // Toggle reply post
            const replyToggle = e.target.closest('.reply-toggle');
            if (replyToggle) {
                const targetSelector = replyToggle.dataset.target;
                const target = document.querySelector(targetSelector);
                if (!target) return;

                const iconHolder = replyToggle.querySelector('.icon-holder');
                const isOpen = target.style.display === 'block';

                target.style.display = isOpen ? 'none' : 'block';

                if (isOpen) {
                    iconHolder.innerHTML = `<iconify-icon icon="${replyToggle.dataset.defaultIcon}" style="font-size:20px"></iconify-icon>`;
                } else {
                    iconHolder.innerHTML = `<img src="${replyToggle.dataset.activeIcon}" height="20" width="20">`;
                }
            }
        });

        // Typing effect for chatbot
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


