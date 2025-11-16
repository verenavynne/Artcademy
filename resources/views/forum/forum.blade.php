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
                    <form action="{{ route('post.add') }}" method="POST" enctype="multipart/form-data">
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


</style>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.comment-toggle').forEach(btn => {
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
    }) 
</script>


