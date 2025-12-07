@extends($layout)

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container-fluid d-flex flex-column justify-content-center px-5" style="margin-bottom: 75px; width: {{ $user->role == 'student' ? '100%' : 'calc(100% - 300px)' }}">

    <div class="navigation-prev d-flex flex-start sticky-top">
        <a class="page-link" href="javascript:void(0);" onclick="window.history.back()">
            <img src="{{ asset('assets/icons/icon_pagination_before.svg') }}" alt="">
        </a>
    </div>

    <div class="d-flex flex-row justify-content-evenly" style="width: 100%; gap: 24px; ">
        @if($user->role === 'student')
            <!-- <div style="width: 20%"> -->
                @include('profile.components.sidebar-profile')
            <!-- </div> -->
        @endif

        <div class="d-flex flex-column" style="width: {{ $user->role == 'student' ? '75%' : '100%' }}; gap: 32px">
            <div class="profile-banner-card d-flex flex-row justify-content-between">
                <div class="profile-banner-info justify-content-center align-items-center d-flex flex-row gap-4">
                    <div class="profile-image">
                        <img src="{{ $user->profilePicture ? asset('storage/' . $user->profilePicture) : asset('assets/default-profile.jpg') }}"
                        class="profile-picture rounded-circle object-fit"
                        alt="" width="120" height="120">

                        <form action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="button" class="edit-profile-btn" id="editProfileBtn">
                                <img src="{{ asset('assets/icons/icon_edit.svg') }}" alt="" width="16" height="16">
                            </button>
                            <input type="file" name="profilePicture" id="profilePicture" accept="image/*" class="d-none" onchange="this.form.submit()">
                        </form>


                    </div>
                    <div class="profile-detail-info d-flex flex-column gap-2">
                        <p class="profile-detail-name">{{ $user->name }}</p>
                        <p style="margin: 0">{{ $user->profession }}</p>
                        <div class="profile-detail-membership-container">
                            <p class="profile-detail-membership">
                                @if ($user->role === 'student')
                                    {{ $membershipStatus === 'active' ? 'Membership ' . $membershipTransaction->membership->membershipName : 'Belum Berlangganan' }}
                                @else
                                    Tutor {{ $user->lecturer->specialization ?? '-' }}
                                @endif
                            </p>

                        </div>

                    </div>

                </div>
                <div class="profile-logout d-flex flex-row gap-2 align-items-start justify-content-center">
                    <img src="{{ asset('assets/icons/icon_logout.svg') }}" alt="">
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-text" style="">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

            @include('profile.components.tab', ['firstTab' => 'portofolio', 'secondTab' => 'post','activeTab' => $activeTab])
            <div class="tab-content-container">
                <div class="tab-content {{ $activeTab == 'portofolio' ? 'active' : '' }}" data-tab-content="portofolio">
                    <div class="portfolio-section-container justify-content-center align-items-center gap-4">
                        @foreach($portfolios as $portfolio)
                            <div class="portfolio-card d-flex flex-column justify-content-center align-items-center position-relative" 
                                data-portfolio-id="{{ $portfolio->id }}">

                                <div class="dropdown position-absolute top-0 end-0 m-3">
                                    <button class="btn btn-link text-dark p-0" type="button" id="dropdownMenu{{ $portfolio->id }}"
                                        data-bs-toggle="dropdown" aria-expanded="false"
                                        onclick="event.stopPropagation()">
                                        <iconify-icon icon="qlementine-icons:menu-dots-16"></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $portfolio->id }}">
                                        <li>
                                            <a style="text-decoration: none" href="{{ route('portfolio.edit', $portfolio->id) }}">
                                                <button type="button" class="dropdown-item">Edit</button>
                                            </a>
                                        </li>
                                        <li>
                                            <button 
                                                type="button" 
                                                class="dropdown-item text-danger"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteConfirmModal{{ $portfolio->id }}"
                                                onclick="event.stopPropagation()">
                                                Hapus
                                            </button>
                                        </li>
                                    </ul>
                                </div>


                                @include('profile.components.portfolio-mockup', [
                                    'mockupType' => $portfolio->mockupType,
                                    'portoType' => Str::endsWith($portfolio->portfolioPath, '.mp4') ? 'video' : 'image',
                                    'mediaPath' => asset('storage/' . $portfolio->portfolioPath),
                                    'portfolioId' => $portfolio->id,
                                    'mockupSize' => 230,
                                    'animation' => true
                                ])
                                <p>{{ $portfolio->portfolioName }}</p>
                            </div>
                        @endforeach
        
                      
                    </div>
                    @if($portfolios->isEmpty())
                        <div class="d-flex flex-column align-items-center gap-3">
                            <p class="text-muted text-center" style="font-size: 18px">Belum ada portofolio</p>
                        </div>
                    @endif

                </div>

                <div class="tab-content {{ $activeTab == 'post' ? 'active' : '' }}" data-tab-content="post">
                    <div class="profile-post-content-container d-flex flex-column align-items-center gap-2 w-100">
                        @foreach($posts as $post)
                            @include('forum.components.post-card',['post'=>$post])
                        @endforeach
                    </div>

                    @if ($posts->isEmpty())
                    <div class="d-flex flex-column align-items-center gap-3">
                        
                        <p class="text-muted text-center">Belum ada postingan.</p>
                    </div>
                    
                    @endif
                </div>
            </div>


        </div>
       
    </div>

    <a href="{{ route('add-portfolio') }}"
        class="btn yellow-gradient-btn position-fixed end-0 m-4 shadow"
        style="bottom: {{ Auth::check() && Auth::user()->role === 'lecturer' ? '60px' : '0' }};">
        <iconify-icon icon="ic:round-plus"></iconify-icon>
        Tambah Portofolio
    </a>
    

    <!-- Pop up each porto -->
    @include('profile.components.portfolio-popup')  
    
    <!-- Pop up konfirmasi delete -->
    @foreach ($portfolios as $portfolio)
        @include('profile.components.popup-confirm-delete',['portfolio' => $portfolio])
    @endforeach

    <!-- Delete post pop up -->
    @foreach ($posts as $post)
        @include('forum.components.delete-post-pop-up', ['post' => $post])
    @endforeach

    <!-- Edit post pop up -->
    @foreach ($posts as $post)
        @include('forum.components.edit-post-pop-up', ['post' => $post])
    @endforeach

    
    
</div>

<style>
    .no-sticky {
        position: static !important;
    }

    .navigation-prev {
        position: sticky;
        top: 94px;
        z-index: 1020;
        padding-left: 8px;
    }

    .portfolio-card .dropdown button {
        color: var(--black-color);
        border: none;
        background: none;
    }

    .portfolio-card .dropdown button:hover {
        opacity: 0.7;
    }

    .portfolio-card .dropdown-menu{
        border-radius: 10px;
        background: white;
        border: none;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
    }
    
    .dropdown-item{
        font-size: 16px;

    }



    .profile-banner-card{
        height: max-content;
        width: 100%;
        padding-inline: 34px;
        padding-block: 28px;
        border-radius: 24px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);

    }

    .profile-image {
        position: relative;
        width: 120px;
        height: 120px;
    }

    .profile-image .profile-picture {
        border-radius: 50%;
        object-fit: cover;
        width: 100%;
        height: 100%;
        border: 3px solid #f8f8f8;
    }

    .edit-profile-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 40px;
        height: 40px;
        border: none;
        cursor: pointer;
        background: linear-gradient(180deg, #FFDE22 0%, #F4A700 100%);
        border-radius: 50rem;
        box-shadow: 0px 4px 8px 0px var(--brown-shadow-color);
        transition: all 0.3s ease;
        
    }

    .edit-profile-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(0,0,0,0.25);
    }

    .profile-detail-name{
        margin: 0;
        font-size: 24px;
        color: var(--black-color);
        font-weight: 600;
    }

    .profile-detail-membership-container{
        border-radius: 10px;
        display: flex;
        padding: 4px 20px;
        justify-content: center;
        align-items: center;
        font-size: var(--font-size-primary);
        background: #E7F6FE;

    }

    .profile-detail-membership{
        margin: 0;
        background: var(--blue-gradient-color);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    .logout-text{
        margin: 0;
        color: #FF2424;
        font-size: var(--font-size-primary);
        font-weight: 700;
        text-decoration: none;
        background:none; 
        border:none; 
        padding:0;
        cursor:pointer;
    }

    .portfolio-section-container{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        justify-items: center;

    }

    .profile-post-content-container{
        .post-card{
            min-width: 690px;
            max-width: 690px

        }
    }

    .portfolio-card{
        padding-inline: 30px;
        padding-block: 40px;
        border-radius: 32px;
        width: 100%;
        height: 300px;
        cursor: pointer;
    }

    .portfolio-card p{
        margin: 0;
        color: var(--black-color);
        font-size: var(--font-size-primary);
        font-weight: 700;
    }

    .yellow-gradient-btn{
        display: flex;
        justify-content: center;
        align-items:center;
        padding: 10px 20px;
        width: 238px;
        height: 56px;
        
    }

    .add-post-textarea{
        resize: none !important;
    }

    .add-post-textarea{
        background: white;
    }

    .add-post-textarea{
        resize: none !important;
    }

    .add-post-textarea{
        background: white;
    }

</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Hilangin sticky selama modal dibuka
    const stickyElements = [
        document.querySelector(".navigation-prev"),
        document.querySelector(".sidebar-profile"),
        document.querySelector(".sticky-top"),
    ];
    console.log("sticky elements: ", stickyElements);

    document.querySelectorAll(".modal").forEach(modal => {
        modal.addEventListener("shown.bs.modal", () => {
            stickyElements.forEach(el => el && el.classList.add("no-sticky"));
        });

        modal.addEventListener("hidden.bs.modal", () => {
            stickyElements.forEach(el => el && el.classList.remove("no-sticky"));
        });
    });

    // Change content based on clicked tab
    const activeTab = "{{ $activeTab }}"; 

    const tabLinks = document.querySelectorAll(".tab-link");
    const tabContents = document.querySelectorAll(".tab-content");

    tabLinks.forEach(link => {
        link.classList.toggle("active", link.getAttribute("data-tab") === activeTab);
    });

    tabContents.forEach(content => {
        content.classList.toggle("active", content.getAttribute("data-tab-content") === activeTab);
    });

    tabLinks.forEach(link => {
        link.addEventListener("click", () => {
            const target = link.getAttribute("data-tab");

            tabLinks.forEach(l => l.classList.remove("active"));
            link.classList.add("active");

            tabContents.forEach(content => {
                content.classList.toggle("active", content.getAttribute("data-tab-content") === target);
            });
        });
    });

    // Atur warna portofolio card
    const colors = ['#F9EEDB', '#FFE9E2'];
    const columns = 2; 

    document.querySelectorAll('.portfolio-card').forEach((card, index) => {
        const row = Math.floor(index / columns);
        const col = index % columns;
        const colorIndex = (row + col) % 2; 
        card.style.backgroundColor = colors[colorIndex];
    });

    document.querySelectorAll(".portfolio-card").forEach(card => {
        card.addEventListener("click", function (e) {
            const dropdown = e.target.closest(".dropdown");
            if (!dropdown) {
                const portfolioId = this.getAttribute("data-portfolio-id");
                const modal = document.querySelector(`#portoModal${portfolioId}`);
                const bootstrapModal = new bootstrap.Modal(modal);
                bootstrapModal.show();
            }
        });
    });

    document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.getElementById('profilePicture').click();
    });

    // Show preview added image or video in edit post
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

    // Toggle comment post
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

        // Kumpulin file yang mau didelete di edit modal
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
});
</script>


@endsection



