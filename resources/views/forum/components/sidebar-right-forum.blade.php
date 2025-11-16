<div class="rekomendasi-profil-card position-fixed d-flex flex-column justify-content-start">
    <p class="fw-bold " style="font-size: 18px; margin: 0">Rekomendasi Profil</p>
    <hr class="divider w-100">
    <ul class="d-flex flex-column w-100 justify-content-around" style="gap: 22px; padding-left: 0px">
        @foreach($otherProfile as $profile)
        <li class="profil-item">
            <div class="d-flex flex-row gap-2">
                <img src="{{ $profile->profilePicture ? asset('storage/' . $profile->profilePicture) : asset('assets/default-profile.jpg') }}" alt="" height="42" width="42"
                class="profile-picture rounded-circle"
                style="object-fit: cover">
                <div class="d-flex flex-column">
                    <p class="fw-bold" style="font-size: 16px; margin: 0">{{ $profile->name }}</p>
                    <p class="" style="font-size: 12px; margin: 0">
                        @if($profile->lecturer)
                            Tutor {{ $profile->lecturer->specialization }}
                        @elseif($profile->student)
                            {{ $profile->student->profession ?? 'Pelajar'}}
                        @endif
                    </p>

                </div>

            </div>
            <a href="#" style="text-decoration: none">
                <p class="text-pink-gradient fw-bold" style="margin: 0">Kunjungi Profil</p>
            </a>
        </li>
        @endforeach
    </ul>

</div>

<style>

    .divider{
        margin-block: 22px;
    }

    .profil-item{
        display: flex;
        flex-direction: row;
        gap: 2;
        justify-content: space-between;
    }

    .rekomendasi-profil-card{
        width: 22%;
        padding: 25px;
        justify-content: center;
        border-radius: 20px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        min-height: 600px;
    }

</style>