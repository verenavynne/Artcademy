<div class="position-relative d-flex gap-4 fs-4">
    @if($unreadCount > 0)
        <div class="position-relative" style="cursor:pointer;" id="notifToggle">
            <img src="{{ asset('assets/icons/icon_notif_gradient.svg') }}" 
                 alt="notif" width="28" height="28">

            <span class="notif-badge-count">
                {{ $unreadCount }}
            </span>
        </div>
    @else
        <iconify-icon icon="solar:bell-linear" id="notifToggle" style="cursor:pointer"></iconify-icon>
    @endif

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
                            <p class="text-muted small" style="font-size: var(--font-size-mini)">2 hari yang lalu</p>
                        </div>
                        
                    </li> 
                </a>
                
            @endforeach
            @if($notifications->isEmpty())
                <p class="text-muted" style="margin: 0; font-size:var(--font-size-tiny) ;">Belum ada notifikasi</p>
            @endif
        </ul>
    </div>
</div>

<style>

    .notif-badge-count {
        position: absolute;
        top: 2px;
        right: -4px;

        background: var(--red-gradient-color);
        color: #fff;
        font-size: 12px;
        font-weight: bold;

        width: 18px;
        height: 18px;

        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;

        line-height: 1;
        padding: 0;
    }

    .notif-link{
        text-decoration: none !important;
        color: inherit !important;
    }

    .notif-link:hover {
        color: inherit !important;
    }
    .notification-panel{
        width: 385px; 
        z-index: 999; 
        max-height: 476px; 
        overflow-y: auto;
        padding: 28px 27px;
        border-radius: 40px 0 40px 40px;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);

        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    .notification-panel.show {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
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