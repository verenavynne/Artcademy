<div class="project-card d-flex flex-column">
  <img src="{{ $submission->projectSubmissionThumbnail 
          ? Storage::disk('s3')->temporaryUrl($submission->projectSubmissionThumbnail, now()->addDay())
          : 'https://via.placeholder.com/150' }}" 
          alt="Project Thumbnail" 
          class="project-image">

  <div class="project-content">
    <p class="project-title">{{ $submission->project->projectName }}</p>

    <div class="project-user">
      <img src="{{ asset('assets/default-profile.jpg') }}" class="rounded-circle" style="box-shadow: rgba(67, 39, 0, 0.2); object-fit: cover" alt="Profile Icon" width="25" height="25">
      <p class="user-name">{{ $submission->student->user->name }}</p>
    </div>

    <hr style="margin: 0; border: 1px solid; border-radius: 100px; width:100%; opacity: 1; color: #F9EEDB;">
    
    @php
      $icons = [
          'Kreativitas' => 'mage:light-bulb',
          'Keterbacaan' => 'mingcute:eye-line',
          'Kesesuaian Tema' => 'tabler:photo-spark',
      ];
    @endphp

    <div id="container-info" class="nilai-wrapper">
        @foreach($submission->lecturerGrades as $grade)
          <div class="nilai">
              <div class="nilai-icon-text">
                  <iconify-icon icon="{{ $icons[$grade->projectCriteria->criteria->criteriaName] ?? 'material-symbols:help-outline' }}" class="nilai-icon"></iconify-icon>
                  <span class="nilai-text">{{ $grade->projectCriteria->criteria->criteriaName }}</span>
              </div>
              <span style="color: var(--dark-gray-color); font-weight: 700;">
                  {{ $grade->score }}
              </span>
          </div>
      @endforeach
    </div>
  </div>
</div>
