@php

    $course = $enrollment->course; 

    if (!$course) return;

    $backgroundColor = match($course->courseType) {
        'Seni Lukis & Digital Art' => 'var(--orange-gradient-color)',    
        'Seni Tari' => 'var(--pink-gradient-color)',         
        'Seni Fotografi' => 'var(--blue-gradient-color)',     
        'Seni Musik' => 'var(--yellow-gradient-color)', 
    };

    $backgroundCourseTypeText = match($course->courseType){
        'Seni Lukis & Digital Art' => '#D99F18',    
        'Seni Tari' => '#E24D77',         
        'Seni Fotografi' => '#4296CC',     
        'Seni Musik' => '#D5B91B', 
    };

    $backgroundCourseLevel= match($course->courseLevel){
        'dasar' => ' #FFEFDE',    
        'menengah' => '#E7F6FE',         
        'lanjutan' => '#FFEAF0', 
    };

    $backgroundCourseLevelText = match($course->courseLevel){
        'dasar' => 'var(--orange-gradient-color)',    
        'menengah' => 'var(--blue-gradient-color)',         
        'lanjutan' => 'var(--pink-gradient-color)', 
    };

    $jam = floor($course->courseDurationInMinutes / 60);
    $menit = $course->courseDurationInMinutes % 60;
@endphp

<a href="{{ route('course.detail', $course->id) }}" 
   class="text-decoration-none text-black">
    <div class="course-card card article-card" style="cursor: pointer; height: 100%;">
        <div class="course-card-header d-flex flex-column justify-content-between" style="background: {{ $backgroundColor }}">
            <div class="course-type-text-container mb-2" style="background: {{ $backgroundCourseTypeText }}">
                <p style="margin: 0; color: white; font-size: var(--font-size-mini)">
                    {{ $course->courseType }}
                </p>
            </div>
            <p style="margin: 0; color: black; font-size: var(--font-size-tiny); font-weight: 700">
                {{ $course->courseName }}
            </p>
            <div class="d-flex flex-row justify-content-center align-items-center gap-3">
                <div class="course-time-container d-flex flex-row gap-1 mb-2">
                    <img src="{{ asset('assets/icons/icon_clock.svg') }}" alt="Clock" height="18" width="18">
                    <p style="margin:0; color: black; font-size: var(--font-size-mini)">
                        {{ $jam }} Jam {{ $menit }} Menit
                    </p>
                </div>
                <img src="{{ asset($course->coursePicture) }}" alt="Course Picture" width="110" height="80">
            </div>
        </div>

        <div class="course-card-bottom d-flex flex-column align-items-start">
            <div class="d-flex flex-row justify-content-space-between gap-2">
                <p style="margin:0; font-size: var(--font-size-tiny); font-weight: 700">
                    {{ $course->courseName }}
                </p>
            </div>

            <div class="d-flex flex-row align-items-center gap-2">
                <div class="position-relative" style="width: 90px; height: 37px;">
                    @foreach ($course->courseLecturers->take(3) as $loopIndex => $courseLecturer)
                        <img src="{{ Str::startsWith($courseLecturer->lecturer->user->profilePicture, ['http://', 'https://']) 
                                    ? $courseLecturer->lecturer->user->profilePicture 
                                    : ($courseLecturer->lecturer->user->profilePicture 
                                        ? asset('storage/' . $courseLecturer->lecturer->user->profilePicture) 
                                        : asset('assets/default-profile.jpg')) }}" 
                             class="rounded-circle position-absolute tutor-image" 
                             width="37" height="37"
                             style="left: {{ 25 * $loopIndex }}px; z-index: {{ $loopIndex + 1 }};">
                    @endforeach
                </div>
                <p style="margin: 0; font-size: var(--font-size-mini); color: var(--dark-gray-color)">
                    Tutor: {{ $course->courseLecturers->take(3)->pluck('lecturer.user.name')->filter()->implode(', ') }}
                </p>
            </div>

            <div class="d-flex flex-row align-items-center gap-2" style=" width: 100%">
                
                <div class="progress" style="height: 3px; width: 100%; background-color: #E5E5E5;">
                    <div class="progress-bar" role="progressbar" 
                    style="width: {{ $enrollment->progress }}%; background-color: #E92D62;"
                    aria-valuenow="{{ $enrollment->progress }}" 
                    aria-valuemin="0" 
                    aria-valuemax="100">
                    </div>
                </div>
                <p style="margin: 0; font-size: 12px;">{{ $enrollment->progress }}%</p>
                
            </div>

            @if ($enrollment->progress === 100)
                <button class="btn px-4 py-2 yellow-gradient-btn text-dark w-100">
                   Lihat penilaian
                </button>
            
            @else
                <button class="btn px-4 py-2 yellow-gradient-btn text-dark w-100">
                    Lanjutkan Kursus
                </button>
            @endif

           
        </div>
    </div>
</a>

<style>
    .course-card-bottom{
        padding-bottom: 5px;
    }
</style>
