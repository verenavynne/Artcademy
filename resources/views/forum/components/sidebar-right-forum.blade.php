
<div class="d-flex flex-column gap-2 sidebar-right">

    <div class="rekomendasi-profil-card d-flex flex-column justify-content-start">
        <p class="fw-bold " style="font-size: 18px; margin: 0">Rekomendasi Profil</p>
        <hr class="divider w-100">
        <ul class="d-flex flex-column w-100 justify-content-around" style="gap: 22px; padding-left: 0px">
            @foreach($otherProfile as $profile)
            <li class="profil-item">
                <div class="d-flex flex-row gap-2" style="min-width: 0;">
                    <img src="{{ $profile->profilePicture ? asset('storage/' . $profile->profilePicture) : asset('assets/default-profile.jpg') }}" alt="" height="42" width="42"
                    class="profile-picture rounded-circle"
                    style="object-fit: cover">
                    <div class="d-flex flex-column" style="max-width: 80%;">
                        <p class="fw-bold" style="font-size: 16px; margin: 0 ">{{ $profile->name }}</p>
                        <p class="" style="font-size: 12px; margin: 0">
                            @if($profile->lecturer)
                                Tutor {{ $profile->lecturer->specialization }}
                            @elseif($profile->student)
                                {{ $profile->student->profession ?? 'Pelajar'}}
                            @endif
                        </p>
                    </div>
    
                </div>
                <a href="{{ route('forum.visit-profile', $profile->id) }}" style="text-decoration: none; white-space: nowrap; margin-left: 12px; flex-shrink: 0;">
                    <p class="text-pink-gradient fw-bold" style="margin: 0; white-space: nowrap;">Kunjungi Profil</p>
                </a>
            </li>
            @endforeach
        </ul>
    
    </div>
    <div class="forum-footer d-flex flex-column">
        <p style="white-space: pre">Kebijakan Privasi   |   Kontak kami   |   FAQ   |   Lainnya...</p>
        <div class="d-flex flex-row gap-1">
            <img src="{{ asset('assets/logo.png') }}" alt="" height="20">
            <p>© Artcademy 2025.</p>
    
        </div>
    
    </div>
</div>

<style>

    .divider{
        margin-block: 22px;
    }

    .profil-item{
        display: flex;
        flex-direction: row;
        gap: 16px;
        justify-content: space-between;
    }

    .sidebar-right{
        position: sticky;
        top: 91px;

    }

    .rekomendasi-profil-card{
        padding: 25px;
        justify-content: center;
        border-radius: 20px;
        background: white;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        min-height: 500px;
    }

    .forum-footer p{
        margin: 0;
        color: #B89E74;
        font-size: 14px;
    }

</style>