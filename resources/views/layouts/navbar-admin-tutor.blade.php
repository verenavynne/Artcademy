<nav class="navbar-admin d-flex justify-content-between align-items-center px-4 py-3">
    <div class="d-flex align-items-center">
        <a href="">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="153px" height="38px">
        </a>
    </div>

    <div class="d-flex align-items-center gap-4"> 
        @if(auth()->user()->role === 'lecturer')
        <button class="btn btn-link p-0 position-relative" id="notifToggle" style="cursor:pointer">
           <iconify-icon icon="solar:bell-linear" class="notif-icon"></iconify-icon>
        </button>

        <div id="notifPanel"
            class="notification-panel position-absolute end-0 mt-5 shadow-sm bg-white">
            <p class="fw-bold text-center" style="margin: 0; font-size: var(--font-size-primary)">Notifikasi</p>
            <hr class="divider" style="margin-block-start: 10px; margin-block-end: 22px">
            <ul class="notification-list list-unstyled d-flex flex-column gap-2 m-0 p-0">
                @foreach ($notifications as $notification)
                    @php
                        $commentDetail = null;
                    
                        if ($notification->referenceType === 'comment') {
                            $comments = \App\Models\Comment::find($notification->referenceId);
                            $commentDetail = $comments->commentText;
                        
                        }else if($notification->referenceType === 'post'){
                            $comments = \App\Models\Comment::find($notification->referenceId);
                            $commentDetail = $comments->commentText;

                        }else if($notification->referenceType === 'membership'){
                            $commentDetail = 'Yuk segera perpanjang membershipmu!';
                        }else if($notification->referenceType === 'project'){
                            $submission = \App\Models\ProjectSubmission::find($notification->referenceId);
                            $commentDetail = $submission->project->projectName;
                        }
                    @endphp
                    
                    <a href="{{ route('notification.show', $notification->id) }}" class="notif-link d-flex flex-column gap-2" style="text-decoration: none">
                        <li class="notification-item d-flex align-items-center mb-3 pb-3 border-bottom gap-3">
                            <div class="d-flex flex-row align-items-center gap-2">
                                
                                <div class="unread-icon" style="{{ $notification->status === 'unread' ? '' : 'visibility: hidden' }}" ></div>
                                
                                @if($notification->status === 'unread')
                                    <div class="notif-badge-unread">
                                        <img src="{{ asset('assets/icons/icon_notif_gradient.svg') }}" alt="" height="24" width="24">
                                    </div>
                                @else
                                    <div class="notif-badge">
                                        <iconify-icon icon="solar:bell-bold" style="font-size: 24px"></iconify-icon>
                                    </div>
            
                                @endif
        
                            </div>
                            
                            <div class="notif-detail d-flex flex-column">
                                <p class="notif-message fw-bold" style="font-size: var(--font-size-tiny)">{{ $notification->notificationMessage }}</p>
                                <p style="font-size: var(--font-size-tiny)">{{ $commentDetail }}</p>
                                <p class="text-muted small" style="font-size: var(--font-size-mini)"> {{ \Carbon\Carbon::parse($notification->notificationDate)->diffForHumans() }}</p>
                            </div>
                            
                        </li> 
                    </a>
                    
                @endforeach
                @if($notifications->isEmpty())
                    <p class="text-muted" style="margin: 0; font-size:var(--font-size-tiny) ;">Belum ada notifikasi</p>
                @endif
            </ul>
        </div>
        @endif

        <div class="dropdown">
            <a class="profil d-flex align-items-center text-decoration-none text-dark " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img 
                    src="{{ Str::startsWith(Auth::user()->profilePicture, ['http://', 'https://']) 
                        ? Auth::user()->profilePicture 
                        : (Auth::user()->profilePicture 
                            ? asset('storage/' . Auth::user()->profilePicture) 
                            : asset('assets/default-profile.jpg')) }}"
                    class="rounded-circle" 
                    style="box-shadow: rgba(67, 39, 0, 0.2); object-fit: cover" 
                    alt="Profile Icon" width="54" height="54">

                <div class="d-flex flex-column text-start">
                    <span class="fw-medium" style= "font-size: 18px">{{ Auth::user()->name }}</span>
                    <small class="text-muted" style="font-size: 14px;">
                        {{ Auth::user()->role === 'lecturer' ? 'Tutor' : ucfirst(Auth::user()->role) }}
                    </small>
                </div>
                <iconify-icon icon="mdi:chevron-down" class="dropdown-icon ms-2"></iconify-icon>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" style="z-index: 9999;">
                <li><a class="dropdown-item" href="{{ Auth::user()->role === 'admin' ? route('profile.info') : route('my-profile') }}">Profil</a></li>
                <li>
                    <a href="#" class="dropdown-item text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Keluar
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


<style>
    .navbar-admin {
        background-color: var(--cream-color);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding-top: 12px;
        padding-bottom: 12px;
        border-bottom: none;
    }

    .navbar-admin h5 {
        font-family: 'Afacad', sans-serif;
    }

    .notif-icon{
        color: #1B1B1B;
        display: flex;
        width: 57px;
        height: 56px;
        padding: 2px 3px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        border-radius: 100px;
        background: #FFF;
        transition: all 0.2s ease;
        box-shadow: 0 4px 8px 0 rgba(67, 39, 0, 0.20);
    }

    .notif-icon:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(67, 39, 0, 0.2);
    }

    .profil{
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
    }

    .dropdown-icon {
        align-self: flex-start; 
        margin-top: 4px; 
        color: #333;
        transition: transform 0.3s ease;
    }

    .dropdown.show .dropdown-icon {
        transform: rotate(180deg);
    }

    a[aria-expanded="true"] .dropdown-icon {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        font-size: 18px;
        border: none;
        box-shadow: 0 6px 12px rgba(67, 39, 0, 0.2);
        margin-top: 12px !important;
        padding: 12px 12px;
    }

    .dropdown-item:hover{
        background: var(--cream-color);
        border-radius: 4px;
    }

    .notification-panel{
        width: 385px; 
        z-index: 999; 
        max-height: 476px; 
        overflow-y: auto;
        padding: 28px 27px;
        border-radius: 40px 0 40px 40px;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        pointer-events: none;
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.25s ease, transform 0.25s ease;
        top: 50%;
        left: 60%;
    }

    .notification-panel.show {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .notif-detail p{
        margin: 0
    }

    .notif-message{
        font-size: 14px;

    }

    ul.notification-list li:last-child {
        border-bottom: none !important ;
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }

    
    .notif-link{
        text-decoration: none !important;
        color: inherit !important;
    }

    .notif-link:hover {
        color: inherit !important;
    }

    .notif-badge-unread,
    .notif-badge{
        height: 56px;
        width: 56px;
        border-radius: 50%;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .notif-badge{
        background: #EDEDED;
    }

    .notif-badge-unread{
        background: var(--cream2-color)
    }

    .unread-icon{
        width: 5px;
        height: 5px;
        background: var(--orange-gradient-color);
        border-radius: 100%;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        const toggle = document.getElementById("notifToggle")
        const panel = document.getElementById("notifPanel")

        toggle.addEventListener("click", function(event){
            event.stopPropagation();
            panel.classList.toggle("show");
        });

        document.addEventListener("click", function(event){
            if(!panel.contains(event.target) && !toggle.contains(event.target)){
                panel.classList.remove("show");
            }
        })
        
    })
</script>