<div class="project-card d-flex flex-column">
  <div class="project-image">
    <img src="{{ $submission->projectSubmissionThumbnail 
          ? asset('storage/' . $submission->projectSubmissionThumbnail)
          : 'https://via.placeholder.com/150' }}" 
          alt="Project Thumbnail" 
          class="project-image">
  </div>

  <div class="project-content">
    <p class="project-title">{{ $submission->project->projectName }}</p>

    <div class="project-user">
      <img src="{{ $submission->student->user->profilePicture 
            ? asset('storage/' . $submission->student->user->profilePicture)
            : asset('assets/default-profile.jpg') }}"
            class="rounded-circle" 
            style="box-shadow: rgba(67, 39, 0, 0.2); object-fit: cover"
            width="25" height="25">

      <p class="user-name">{{ $submission->student->user->name }}</p>
    </div>

    <div class="project-deadline">
      <p class="deadline-label">Nilai Sebelum :</p>
      <span class= "deadline-date">
          <p class= "deadline-date-text">{{ $submission->project->created_at->addDays(7)->format('d M Y') }}</p>
      </span>
    </div>

    <a href="{{ route('lecturer.detail-nilai-projek', $submission->id) }}" 
      class="yellow-gradient-btn w-100 text-decoration-none text-dark d-flex justify-content-center">
      Nilai Sekarang
    </a>
  </div>
</div>
