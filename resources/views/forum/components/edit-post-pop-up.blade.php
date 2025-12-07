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

                    <button type="submit" class="btn text-dark yellow-gradient-btn d-flex flex-row gap-2">
                        Edit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
