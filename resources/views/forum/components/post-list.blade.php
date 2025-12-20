@foreach($posts as $post)
    @include('forum.components.post-card',['post'=>$post])
@endforeach